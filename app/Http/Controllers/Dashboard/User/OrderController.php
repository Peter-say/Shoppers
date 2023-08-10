<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\OrderService;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function placeOrder(Request $request, PaymentService $paymentService)
    {
        $result = OrderService::processOrder($request, $paymentService);
        if ($result == true) {
            return redirect()->route('user.dashboard.thank-you');
        } else {
            return back()->with('error_message', 'Something went wrong');
        }
    }

    public function orders()
    {
        $user = auth()->user();
        $orders = Order::where('user_id', $user->id)->latest()->get();
        $totalOrderCount = Order::where('user_id', $user->id)->count();
        return view('dashboard.user.orders.index', [
            'orders' => $orders,
            'totalOrderCount' => $totalOrderCount,
        ]);
    }


    public function orderProducts($id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);
        $orderItems = $order->orderItems;
        // $products = [];
        // foreach ($orderItems as $orderItem) {
        //     $products[] = $orderItem->product;
        // }
        return view('dashboard.user.orders.orderItems', [
            'orderItems' => $orderItems,
            // 'products' => $products,
            'order' => $order
        ]);
    }
}
