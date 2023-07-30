<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;



class AddToCart extends Component
{
    protected $listeners = [
        'cartUpdated' => 'updateCartItemCount',
    ];

    public $product;
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

            $userCart = $userCart ?? new Cart();
            $userCart->user_id = $user->id;
            $userCart->status = 'User';
            $userCart->save();
        } else {
            // User is not authenticated (guest)
            $userCart = $this->getGuestCart();

            // Store the new item in the guest cart session
            $cartItems = session()->get('cartItems', []);
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
        return redirect()->back()->with('success_message', 'Item added to cart successfully');
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
        $this->related_products = Product::where('category_id', $this->product->category_id)
            ->where('status', 'active')
            ->where('id', '!=', $this->product->id)
            ->get();
            
    }

    public function removeFromCart($productId)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $cart = Cart::where('user_id', $user->id)->first();
        } else {
            // User is not authenticated (guest)
            $sessionId = session()->getId();
            $cart = Cart::where('session_id', $sessionId)->first();
        }
    
        if ($cart) {
            // Find the cart item for the given product ID and fetch its associated product
            $cartItem = CartItem::where('cart_id', $cart->id)->where('product_id', $productId)->first();
            if ($cartItem) {
                // Fetch the associated product before deleting the cart item
                $product = $cartItem->product;
    
                // Delete the cart item
                $cartItem->delete();
    
                // Set the $this->product variable to the fetched product
                $this->product = $product;
            }
        }
    
        // Update the cart items after removal
        $this->emit('updateCartItems');
        session()->flash('item_removed', true);
        session()->flash('success_message', 'Item removed from cart successfully');
    }
    



    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
