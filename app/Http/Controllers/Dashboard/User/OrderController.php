<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        // Retrieve the necessary data from the request
        $user_id = Auth::id();
        $total = $request->input('total');
        $paymentId = $request->input('payment_id');
        $cartItems = session()->get('cartItems');

        // Create a new order
        $order = Order::create([
            'user_id' => $user_id,
            'total' => $total,
            'payment_id' => $paymentId,
        ]);

        // Create order items
        foreach ($cartItems as $cartItemData) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItemData['product_id'],
                'quantity' => $cartItemData['quantity'],
                'price' => $cartItemData['price'],
            ]);
        }
    }
}
