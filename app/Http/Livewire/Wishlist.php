<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Wishlist extends Component
{
    public $product;


    public function addToWishlist()
    {
        
    }

    public function removeFromWishlist()
    {
        //
    }
    public function render()
    {
        return view('livewire.wishlist');
    }
}
