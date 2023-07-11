<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function showBalance()
    {
        $user = Auth::user();
        $wallet = $user->wallet;

        return view('wallet.balance', ['wallet' => $wallet]);
    }
    public function addFunds(Request $request)
    {
        $user = Auth::user();
        $wallet = $user->wallet;

        // Perform validation on the request data

        // Update the wallet balance
        $wallet->balance += $request->input('amount');
        $wallet->save();

        // Redirect or display success message
    }

    public function deductFunds(Request $request)
    {
        $user = Auth::user();
        $wallet = $user->wallet;

        // Perform validation on the request data

        // Check if the wallet has sufficient balance
        if ($wallet->balance < $request->input('amount')) {
            // Display an error message or redirect with an error
        }

        // Deduct the funds from the wallet balance
        $wallet->balance -= $request->input('amount');
        $wallet->save();

        // Redirect or display success message
    }
}
