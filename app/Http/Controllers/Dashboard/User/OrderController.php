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
        $result = OrderService::processOrder($request, $paymentService);
        if ($result == true) {
            return redirect()->route('user.dashboard.thank-you');
        } else {
            return back()->with('error_message', 'Something went wrong');
        }
    }
}
