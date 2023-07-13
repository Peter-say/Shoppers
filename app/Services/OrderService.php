<?php

namespace App\Services;

use App\Mail\OrderShipped;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderService
{
    public static function processOrder(Request $request, PaymentService $paymentService)
    {

        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->first();
        $cartItems = null;
        $total = 0;

        if ($cart) {
            $cartItems = $cart->cartItems;
            $total = $cartItems->count();
        } else {
            return back()->with('error_message', 'No Items found in your cart. Kindly add items to continue');
        }

        // Check if the user has a shipping address
        if (!Address::where('user_id', $user->id)->exists()) {
            return back()->with('error_message', 'Please update your shipping address before placing an order.');
        }

        // Retrieve the existing address
        $address = Address::where('user_id', $user->id)->where('mark_as_default', '1')->findOrFail(1);
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $total,
            'status' => 'Pending',
            'shipping_address_id' => $address->id,
            'tracking_number' => Order::generateTrackingNumber(),
        ]);

        foreach ($cartItems as $cartItemData) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItemData['product_id'],
                'quantity' => $cartItemData['quantity'],
                'price' => $cartItemData['price'],
            ]);
        }

         // clear the carts from database
        $cart->cartItems()->delete();
        $cart->delete();

        // process the payment here //
        $paymentService->deductFunds($request);

        // create new transaction instance //
        $payment_method = $request->input('payment_method');

        $transaction = Transaction::create([
            'user_id' => $user->id,
            'order_id' => $order->id,
            'payment_method' => $payment_method,
            'amount' => $request->input('amount'),
            'type' => 'Purchase',
            'reference_no' => Transaction::generateTransactionReference(),
        ]);

        // Update the transaction status if the payment was successful
        $transaction->status = 'Completed';
        $transaction->save();

        // Update the Order status if the order was successful
        $order->status = 'Completed';
        $order->save();

        // send mail to user
        $buyerEmail = $user->email;
        Mail::to($buyerEmail)->send(new OrderShipped($order));

        return redirect()->route('user.dashboard.home')->with('success_message', 'Your order has been made successfuly');
    }
}
