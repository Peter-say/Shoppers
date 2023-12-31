<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
   public function home()
   {
      $user = auth()->user();
      $wallet = $user->wallet;
      $transactions = Transaction::with('order')->where('type', 'purchase')->where('user_id', $user->id)->paginate(10);
      $orders = Order::where('user_id', $user->id)->latest()->limit(2)->get();
      $totalOrderCount = Order::where('user_id', $user->id)->count();
      return view('dashboard.user.index', [
         'user' => $user,
         'wallet' => $wallet,
         'transactions' => $transactions,
         'orders' => $orders,
         'totalOrderCount' => $totalOrderCount,
      ]);
   }

   public function thankYou()
   {
      return view('dashboard.user.cart.thank');
   }
}
