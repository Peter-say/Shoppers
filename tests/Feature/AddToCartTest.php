<?php

namespace Tests\Feature;

use App\Http\Livewire\AddToCart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;
use Tests\TestCase;

class AddToCartTest extends TestCase
{
    // use RefreshDatabase;

    /** @test */
    // public function it_adds_item_to_cart(): void
    // {
    //     $product = Product::where('id', '5')->first();
    //     // Simulate user interaction with the component
    //     Livewire::test(AddToCart::class, ['id' => $product->id])
    //         ->set('quantity', 2)
    //         ->set('size', 'M')
    //         ->set('price', '$20')
    //         ->call('addToCart', $product->id);

    //     $this->assertDatabaseHas('cart_items', [
    //         'product_id' => $product->id,
    //     ]);
    // }

    /** @test */
    // public function it_removes_item_from_cart()
    // {
    //     // find a product in the cart
    //     $cartItem = CartItem::where('product_id', '5')->where('cart_id', 4)->first();
    //     $user = User::first();
    //     Auth::login($user);

    //     // Simulate user interaction with the component
    //     Livewire::test(AddToCart::class, ['id' => $cartItem->id])
    //         ->call('removeFromCart', $cartItem->id);

    //     // Assert that the item is removed from the cart
    //     $this->assertDatabaseMissing('cart_items', [
    //         'product_id' => $cartItem->id,
    //     ]);

    // }
}
