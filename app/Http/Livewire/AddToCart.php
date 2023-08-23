<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Wishlist as LivewireWishlist;
use App\Models\Wishlist;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;



class AddToCart extends Component
{
    protected $listeners = [
        'cartUpdated' => 'updateCartItemCount',
        'addToWishlist'
    ];
    public $product;
    public $productId;
    public $related_products;
    public $quantity;
    public $size;
    public $price;
    protected $addToWishlist;



    protected $rules = [
        'quantity' => 'required|numeric|min:1',
        'size' => 'required',
    ];

    protected $messages = [
        'quantity.required' => 'Please enter a quantity.',
        'quantity.numeric' => 'Quantity must be a number.',
        'quantity.min' => 'Quantity must be at least 1.',
        'size.required' => 'Please select a size.',
    ];

    public function __construct()
    {
        $this->addToWishlist = new LivewireWishlist();
    }



    public function incrementQuantity()
    {
        $this->quantity++;
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart($id)
    {
        $this->validate();

        if (Auth::check()) {
            $user = Auth::user();
            $userCart = Cart::where('user_id', $user->id)->first();

            if (!$userCart) {
                $userCart = new Cart();
                $userCart->user_id = $user->id;
                $userCart->status = 'User';
                $userCart->save();
            }
        } else {
            // User is not authenticated (guest)
            $userCart = $this->getGuestCart();

            // Store the new item in the guest cart session
            $cartItems[] = [
                'product_id' => $id,
                'quantity' => $this->quantity,
                'price' => $this->product->amount,
                'size' => $this->size,
            ];
            session()->put('cartItems', $cartItems);
        }

        // Create a new cart item
        $data = [
            'cart_id' => $userCart->id,
            'product_id' => $id,
            'quantity' => $this->quantity,
            'price' => $this->product->amount,
            'size' => $this->size,
        ];
        CartItem::create($data);

        $this->resetInput(); // Reset the input field

        session()->flash('success_message', 'Item added to cart successfully');
    }



    private function getGuestCart()
    {
        $sessionId = session()->getId();

        // Find or create a guest cart based on the session ID
        $guestCart = Cart::where('session_id', $sessionId)->first();

        if (!$guestCart) {
            $guestCart = new Cart();
            $guestCart->session_id = $sessionId;
            $guestCart->status = 'guest';
            $guestCart->save();
        }

        return $guestCart;
    }
    private function resetInput()
    {
        $this->quantity = null;
        $this->size = null;
    }


    public function mount($id)
    {
        $this->product = Product::with('cartItem')->where('status', 'active')->where('id', $id)->first();
        $this->countCartItems();
    }


    public function addToWishlist($productID)
    {
        if (Auth::check()) {
            LivewireWishlist::addToAuthenticatedUserWishlist($productID);
        } else {
            return back()->with('error_message', 'You need to log in to save item to wishlist');
        }
    }



    public function removeFromWishlist($productID)
    {
        LivewireWishlist::removeFromWishlist($productID);
    }

    public static function countCartItems()
    {
        $count = 0;

        if (Auth::check()) {
            // User is authenticated
            $user = Auth::user();
            $cart = $user->cart()->first();
            if ($cart) {
                $count = $cart->cartItems()->count();
            }
            // Retrieve guest cart items from the session
            $guestCartItems = session()->get('cartItems');
            if ($guestCartItems) {
                $count += count($guestCartItems);
            }
        } else {
            // User is not authenticated (guest)
            $sessionId = session()->getId();
            $cart = Cart::where('session_id', $sessionId)->first();

            if ($cart) {
                $count = $cart->cartItems()->count();
            }
        }

        return  $count;
    }

    public static function countWishlistItems()
    {
        $count = 0;

        if (Auth::check()) {
            $user = Auth::user();
            $wishlist = Wishlist::with('product')->where('user_id', $user->id)->get();
            if ($wishlist) {
                $count = $wishlist->count();
            }
            // dd($count, $wishlist);
        }

        return $count;
    }


    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
