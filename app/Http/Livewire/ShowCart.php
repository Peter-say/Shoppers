<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowCart extends Component
{

    protected $listeners = ['updateCartItems' => 'updateCartItems'];

    public $cartItems;
    public $totalPrice;

    public function mount()
    {
        $this->updateCartItems();
        $this->calculateTotalPrice();
    }

    public function incrementQuantity($item)
    {
        $cartItem = $this->cartItems[$item];
        $cartItem->quantity++;
        $cartItem->save();
        $this->calculateTotalPrice();
    }

    public function decrementQuantity($item)
    {
        $cartItem = $this->cartItems[$item];
        if ($cartItem->quantity > 1) {
            $cartItem->quantity--;
            $cartItem->save();
            $this->calculateTotalPrice();
        }
    }


    public function updateCartItems()
    {
        if (Auth::check()) {
            // User is authenticated
            $user = Auth::user();

            // Retrieve guest cart items from the session
            $guestCartItems = session()->get('cartItems');

            // Ensure $guestCartItems is an array
            $guestCartItems = $guestCartItems ?: [];

            $cart = Cart::where('user_id', $user->id)->first();

            if ($cart) {

                // Merge guest cart items with the user's cart items
                if (!empty($guestCartItems)) {
                    $this->mergeGuestCartItems($cart, $guestCartItems); // Swap arguments
                    session()->forget('cartItems');
                }

                // Retrieve updated cart items associated with the user's cart
                $this->cartItems = $cart->cartItems;
            } else {
                $this->cartItems = [];
            }
        } else {
            // User is not authenticated (guest)
            $sessionId = session()->getId();
            $cart = Cart::where('session_id', $sessionId)->first();

            // Retrieve cart items associated with the guest cart
            $this->cartItems = $cart ? $cart->cartItems : [];
        }
    }

    private function mergeGuestCartItems($userCart, $guestCartItems)
    {
        foreach ($guestCartItems as $cartItemData) {
            $existingCartItem = CartItem::where('cart_id', $userCart->id)
                ->where('product_id', $cartItemData['product_id'])
                ->first();

            if ($existingCartItem) {
                // Update the quantity of the existing cart item
                $existingCartItem->quantity += $cartItemData['quantity'];
                $existingCartItem->save();
            } else {
                // Create a new cart item
                $data = [
                    'cart_id' => $userCart->id,
                    'product_id' => $cartItemData['product_id'],
                    'quantity' => $cartItemData['quantity'],
                    'price' => $cartItemData['price'],
                    'size' => $cartItemData['size'],
                ];
                CartItem::create($data);
            }
        }
    }


    public function removeFromCart($item)
    {
        $cartItem = $this->cartItems[$item];
        $cartItem->delete();
        $this->updateCartItems();
        $this->calculateTotalPrice();
        return back()->with('success_message', 'Item removed from cart successfully');
    }


    public function calculateTotalPrice()
    {
        $this->totalPrice = collect($this->cartItems)->sum(function ($cartItem) {
            return $cartItem->price * $cartItem->quantity;
        });
    }

    public function render()
    {
        return view('livewire.show-cart');
    }
}
