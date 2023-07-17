<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $total_money_paid_through_wallet = Transaction::select('amount')->where('type', 'deduction')->get();
        $account_balance = $total_money_paid_through_wallet->sum(function ($transaction) {
            return $transaction->amount;
        });
        return view('dashboard.admin.overview', [
            'account_balance' => $account_balance,
        ]);
    }
}
