<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use Livewire\Component;

class CartCounter extends Component
{
    protected $cartItemCount;

    protected $listeners = ['itemAdded' => 'updateCartItemCount'];

    public function mount()
    {
        $this->updateCartItemCount();
    }

    public function updateCartItemCount()
    {
        $this->cartItemCount = Cart::countItems();
    }

    public function render()
    {
        return view('livewire.cart-counter');
    }
}
