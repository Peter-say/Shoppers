<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
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
        $request = request();

        if (Auth::check()) {
            // User is authenticated
            $user = Auth::user();
            $userCart = Cart::where('user_id', $user->id)->first();

            $userCart = $userCart ?? new Cart();
            $userCart->user_id = $user->id;
            $userCart->status = 'User';
            $userCart->save();

            if (!Auth::viaRemember()) {
                // User is not logged in via "Remember Me" option
                $guestCartItems = session()->get('cartItems');
                if ($guestCartItems) {
                    // Associate the guest cart items with the authenticated user
                    foreach ($guestCartItems as $cartItemData) {
                        $data = [
                            'cart_id' => $userCart->id,
                            'product_id' => $cartItemData['product_id'],
                            'quantity' => $cartItemData['quantity'],
                            'price' => $cartItemData['price'],
                            'size' => $cartItemData['size'],
                        ];
                        CartItem::create($data);
                    }
                    // Clear the guest cart items from the session
                    session()->forget('cartItems');
                }
            }
        } else {
            // User is not authenticated (guest)
            $userCart = $this->getGuestCart();
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
        return redirect()->back();
    }



    private function resetInput()
    {
        $this->quantity = null;
        $this->size = null;
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

    public function mount($id)
    {
        $this->product = Product::where('status', 'active')->where('id', $id)->first();
        $this->related_products = Product::where('category_id', $this->product->category_id)
            ->where('status', 'active')
            ->where('id', '!=', $this->product->id)
            ->get();
    }

    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
