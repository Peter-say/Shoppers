<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShowCart extends Component
{

    protected $listeners = ['updateCartItems' => 'updateCartItems'];

    public $cartItems;
    public $totalPrice;
    public $item;
    public $sizeOptions = ['Small', 'Meduim', 'Large', 'Extra large'];

    public function __construct($item)
{
    $this->item = $item;
}

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
                    $this->mergeGuestCartItems($cart, $guestCartItems);
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

    public static function mergeGuestCartItems($userCart, $guestCartItems)
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
        try {
            DB::beginTransaction();

            $cartItem = $this->cartItems[$item];
            $cartItem->delete();
            $this->updateCartItems();
            $this->calculateTotalPrice();

            DB::commit();

            return back()->with('success_message', 'Item removed from cart successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error_message', 'An error occurred while removing the item from the cart.');
        }
    }


    public function calculateTotalPrice()
    {
        $this->totalPrice = collect($this->cartItems)->sum(function ($cartItem) {
            return $cartItem->price * $cartItem->quantity;
        });
    }

    // edit, update, and cancel cart size //



    public function updateSize($item)
    {
        $cartItem = $this->cartItems[$item];
        $selectedSize = $this->sizeOptions[$item]; // Get the selected size for the specific cart item
        $cartItem->size = $selectedSize;
        $cartItem->save();
    
    }
    

   


    public function render()
    {
        
        return view('livewire.show-cart', [
        ]);
    }
}
