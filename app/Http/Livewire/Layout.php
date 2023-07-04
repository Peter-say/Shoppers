<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Layout extends Component
{
    public $cartItemCount;

    public function mount()
    {
        // Retrieve the cart item count from the user model or session
        $this->cartItemCount = $this->getCartItemCount();
    }

    public function render()
    {
        return view('web.layouts.app');
    }
}
