<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    public $cartItemCount = 0;

    use HasFactory;

    protected $guarded = [];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'cart_id');
    }

    public static function countItems()
    {
        $count = 0;

        if (Auth::check()) {
            // User is authenticated
            $user = Auth::user();
            $count = $user->cart->cartItems->count();
        } else {
            // User is not authenticated (guest)
            $sessionId = session()->getId();
            $cart = Cart::where('session_id', $sessionId)->first();
            if ($cart) {
                $count = $cart->cartItems->count();
            }
        }

        return $count;
    }


    private function incrementCartItemCount()
    {
        if (Auth::check()) {
            // User is authenticated
            $user = Auth::user();
            $this->cartItemCount = $user->cartItems->sum('quantity');
        } else {
            // User is not authenticated (guest)
            $this->cartItemCount = $this->cartItems->sum('quantity');
        }
    }
}