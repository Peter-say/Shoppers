<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use Livewire\Component;

class NavigationCounter extends Component
{
    public $cartItemCount;

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
        return view('livewire.navigation-counter');
    }

    protected $listeners = ['cart.itemAdded' => 'updateCartItemCount'];
}
