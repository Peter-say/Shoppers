<?php

namespace App\Http\Livewire;
use Livewire\Component;

class CartCounter extends Component
{
    public $cartItemCount;

    protected $listeners = ['cartItemAdded' => 'updateCartItemCount'];

    public function mount()
    {
        $this->updateCartItemCount();
    }

    public function updateCartItemCount()
    {
        $this->cartItemCount = session('cart_item_count', 0);
    }

    public function render()
    {
        return view('livewire.cart-counter');
    }
}
