<?php

namespace App\Http\Controllers\Dashboard\User\Cart;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class CheckOutController extends Controller
{
  public function checkout()
  {
    $user = auth()->user();
    if (!empty($shipping_address = Address::where('user_id', $user->id)
      ->first()));
   
    return view('dashboard.user.cart.checkout', [
      'user' => $user,
      'shipping_address' => $shipping_address,
    ]);
  }
}
