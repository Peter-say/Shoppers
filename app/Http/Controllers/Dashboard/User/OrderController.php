<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function placeOrder(Request $request, PaymentService $paymentService)
    {
        OrderService::processOrder($request, $paymentService);
        return redirect()->route('user.dashboard.home')->with('success_message', 'Your order has been made successfuly');
    }
}
