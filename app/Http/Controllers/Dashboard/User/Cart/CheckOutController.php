<?php

namespace App\Http\Controllers\Dashboard\User\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckOutController extends Controller
{
   public function checkout()
   {
      $user = auth()->user();
    return view('dashboard.user.cart.checkout', [
      'user' => $user,  
    ]);
   }
}
