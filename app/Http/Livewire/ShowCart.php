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
    
    public function updateCartItems()
    {
        if (Auth::check()) {
            // User is authenticated
            $user = Auth::user();
            $cart = $user->cart;

            if ($cart) {
                $this->cartItems = $cart->cartItems;
            } else {
                $this->cartItems = [];
            }
        } else {
            // User is not authenticated (guest)
            $sessionId = session()->getId();
            $cart = Cart::where('session_id', $sessionId)->first();

            if ($cart) {
                $this->cartItems = $cart->cartItems;
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
        session()->flash('success_message', 'Item removed from cart successfully');
    }

    public function calculateTotalPrice()
    {
        if ($this->cartItems) {
            $this->totalPrice = collect($this->cartItems)->sum(function ($cartItem) {
                return $cartItem->price * $cartItem->quantity;
            });
        } else {
            $this->totalPrice = 0;
        }
    }

    public function render()
    {
        return view('livewire.show-cart');
    }
}
