<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Wishlist as WishlistModel;
use Illuminate\Support\Facades\Log;

class Wishlist extends Component
{
    public $product;
    public $wishlist;
    public $refreshComponent = false;
    public $item;

  
    public function emitWishlistUpdated()
    {
        $this->emit($this->refreshComponent);
    }

    public static function addToAuthenticatedUserWishlist($productID)
    {
        try {

            $user = Auth::user();
            $wishlistItem = WishlistModel::where('user_id', $user->id)
                ->where('product_id', $productID)
                ->first();

            if (!$wishlistItem) {
                $wishlistItem = new WishlistModel();
                $wishlistItem->user_id = $user->id;
                $wishlistItem->product_id = $productID;
                $wishlistItem->save();

                $wishlistComponent = new self($productID);
                $wishlistComponent->emitWishlistUpdated();
                
                session()->flash('add-wishlist');
                session()->flash('success_message', 'Item added to wishlist successfully');
            } else {
                session()->flash('error_message', 'Item already in your wishlist');
            }
        } catch (Exception $e) {
            return 'An error occured';
        }
    }

    public function removeFromWishlist($productID)
    {

        // if (Auth::check()) {
        //    $wishlistItem = $this->wishlist[$productID];
        //     $wishlistItem->delete();
        //     $this->emitWishlistUpdated();

        //     session()->flash('item_removed');
        //     session()->flash('success_message', 'Item removed from wishlist successfully');
        // } else {
        //     session()->flash('error_message', 'You need to log in to remove item from wishlist');
        // }

       

    }


    public function moveWishlistItemToCart($product_id)
    {
        $user = Auth::user();


        // Retrieve the user's wishlist item by product_id
        $userWishlist = WishlistModel::where('product_id', $product_id)->where('user_id', $user->id)->first();

        // Retrieve the user's cart
        $userCart = Cart::where('user_id', $user->id)->first();
        if (!$userCart) {
            // Create a new cart for the user if it doesn't exist
            $userCart = new Cart();
            $userCart->user_id = $user->id;
            $userCart->status = 'User';
            $userCart->save();
        }

        // Prepare data for the cart item
        $data = [
            'cart_id' => $userCart->id,
            'product_id' => $userWishlist->product_id,
            'quantity' => 1,
            'price' => $userWishlist->product->amount,
            'size' => 'medium',
        ];

        // Create the cart item
        CartItem::create($data);

        // Delete the wishlist item since it has been moved to the cart
        $userWishlist->delete();

        // Emit the event to update the UI
        // $this->emit('wishlistUpdated');

        return redirect()->route('web.shop.cart')->with('success_message', 'Item moved to cart successfully');
    }




    public function render()
    {
        return view('livewire.wishlist');
    }
}
