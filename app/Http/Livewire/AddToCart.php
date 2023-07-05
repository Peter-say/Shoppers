<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class AddToCart extends Component
{
    public $product;
    public $related_products;
    public $quantity;
    public $size;
    public $price;
    public $showPopup = false;

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
            $cart = $user->cart;
        } else {
            // User is not authenticated (guest)
            $cart = $this->getGuestCart();
        }

        // Create a new cart item
        $data = [
            'cart_id' => $cart->id,
            'product_id' => $id,
            'quantity' => $this->quantity,
            'price' => $this->product->amount,
            'size' => $this->size,
        ];
        CartItem::create($data);


        $this->resetInput(); // Reset the input field
        session()->flash('success_message', 'Item added to cart successfully');
        return redirect()->back();
        $this->showPopup = true;
        // Re-render the component after 4 seconds to hide the pop-up message
        $this->dispatchBrowserEvent('refresh-popup');
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
        $this->showPopup = false;
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
