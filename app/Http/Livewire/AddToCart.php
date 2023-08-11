<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Wishlist as LivewireWishlist;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Wishlist;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

            // Check if the product is already in the cart
            $existingCartItem = CartItem::where('cart_id', $userCart->id)
                ->where('product_id', $id)
                ->first();

            $this->product->cartItem = $existingCartItem ? true : false;
        } else {
            // User is not authenticated (guest)
            $userCart = $this->getGuestCart();

            // Check if the product is already in the guest cart
            $cartItems = session()->get('cartItems', []);
            $existingCartItem = collect($cartItems)->first(function ($item) use ($id) {
                return $item['product_id'] == $id;
            });

            $this->product->cartItem = $existingCartItem ? true : false;

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

    public function removeFromCart($id)
    {
        $cartItem = CartItem::where('product_id', $this->product->id)
            ->first();
        if ($cartItem) {
            $cartItem->delete();
            session()->flash('item_removed');
            session()->flash('success_message', 'Item added to cart successfully');
        } else {
            session()->flash('error_message', 'Can not remove cart');
        }
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
        // $this->related_products = Product::where('category_id', $this->product->category_id)
        //     ->where('status', 'active')
        //     ->where('id', '!=', $this->product->id)
        //     ->get();
    }


    public function addToWishlist()
    {
        if (Auth::check()) {
            $this->addToAuthenticatedUserWishlist();
        } else {
            return back()->with('error_message', 'You need to log in to save item to wishlist');
        }
    }

    private function addToAuthenticatedUserWishlist()
    {
        try {
            $user = Auth::user();
            $wishlistItem = Wishlist::where('user_id', $user->id)
                ->where('product_id', $this->product->id)
                ->first();

            if (!$wishlistItem) {
                $wishlistItem = new Wishlist();
                $wishlistItem->user_id = $user->id;
                $wishlistItem->product_id = $this->product->id;
                $wishlistItem->save();

                // Flash a message to the user
                return back()->with('success_message', 'Item added to wishlist successfully');
            }
        } catch (Exception $e) {
            return 'An error occured' . $e->getMessage();
        }
    }

    public function removeFromWishlist()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $wishlistItem = Wishlist::where('user_id', $user->id)
                ->where('product_id', $this->product->id)
                ->first();

            $wishlistItem->delete();

            session()->flash('success_message', 'Item removed from wishlist successfully');
        } else {
            session()->flash('error_message', 'You need to log in to remove item from wishlist');
        }
    }


    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
