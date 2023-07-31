<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Wishlist extends Component
{
    public $product;


    public function addToWishlist()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $userWishlist = Wishlist::where('user_id', $user->id)->first();

            $userWishlistItems = $userWishlist ?? new Wishlist();
            $userWishlistItems->user_id = $user->id;
            $userWishlistItems->product_id = $this->product->id;
            $userWishlistItems->save();
            session()->flash('success_message', 'Item added to wishlist successfully');
        } else {
            return redirect()->route('login')->with('error_message', 'Please log in to add items to your wishlist.');
        }
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
