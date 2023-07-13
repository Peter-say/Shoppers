<?php

namespace App\Services;

use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentService
{
    public function deductFunds(Request $request)
    {
        $user = Auth::user();
        $wallet = $user->wallet;
        if ($wallet->balance < $request->input('amount')) {
           return back()->with('error_message', 'Insufficient balance');
        }
        $wallet->balance -= $request->input('amount');
        $wallet->save();
        return back()->with('success_message', 'Your payment has been made successfully');
    }

}
