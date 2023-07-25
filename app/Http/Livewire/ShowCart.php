<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowCart extends Component
{
    public $cartItems;
    public $totalPrice;

    public function mount()
    {
        $this->updateCartItems();
        $this->calculateTotalPrice();
    }

    public function incrementQuantity($item)
    {
        $cartItem = $this->cartItems[$item];
        $cartItem->quantity++;
        $cartItem->save();
        $this->calculateTotalPrice();
    }

    public function decrementQuantity($item)
    {
        $cartItem = $this->cartItems[$item];
        if ($cartItem->quantity > 1) {
            $cartItem->quantity--;
            $cartItem->save();
            $this->calculateTotalPrice();
        }
    }

    public function updateCartItems()
    {
        if (Auth::check()) {
            // User is authenticated
            $user = Auth::user();
            $cart = Cart::where('user_id', $user->id)->first();
            if ($cart) {
                $sessionId = session()->getId();
                $userCart = $cart->cartItems()->get();
                $this->cartItems = $userCart ?? [];
            } else {
                $this->cartItems = [];
            }
        } else {
            // User is not authenticated (guest)
            $sessionId = session()->getId();
            $cart = Cart::where('session_id', $sessionId)->first();

            if ($cart) {
                $this->cartItems = $cart->cartItems()->get();
            } else {
                $this->cartItems = [];
            }
        }
    }

    public function removeFromCart($item)
    {
        $cartItem = $this->cartItems[$item];
        $cartItem->delete();
        $this->updateCartItems();
        $this->calculateTotalPrice();
        return back()->with('success_message', 'Item removed from cart successfully');
    }


    public function calculateTotalPrice()
    {
        $this->totalPrice = collect($this->cartItems)->sum(function ($cartItem) {
            return $cartItem->price * $cartItem->quantity;
        });
    }

    public function render()
    {
        return view('livewire.show-cart');
    }
}
