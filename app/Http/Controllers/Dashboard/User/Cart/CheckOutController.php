<?php

namespace App\Http\Controllers\Dashboard\User\Cart;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use Illuminate\Http\Request;

class CheckOutController extends Controller
{
  public function checkout()
  {
    $user = auth()->user();
    $shipping_address = Address::where('user_id', $user->id)->first();
    $cart = Cart::where('user_id', $user->id)->first();
    $cart = Cart::where('user_id', $user->id)->first();
    if ($cart) {
      $cartItems = $cart->cartItems;
      $totalPrice = $cart->calculateTotalPrice() ?? 0;
    } else {
      $cartItems = [];
      $totalPrice = 0;
    }

    $wallet = $user->wallet;

    return view('dashboard.user.cart.checkout', [
      'user' => $user,
      'shipping_address' => $shipping_address,
      'cartItems' => $cartItems,
      'totalPrice' => $totalPrice,
      'wallet' => $wallet,
    ]);
  }
}
