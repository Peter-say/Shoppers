<?php

namespace App\Providers;

use App\Http\Livewire\AddToCart;
use App\Models\Cart;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $cartItemCount = AddToCart::countCartItems();
            $view->with('cartItemCount', $cartItemCount);

            $wishlistCount = AddToCart::countWishlistItems();
            $view->with('wishlistCount', $wishlistCount);
        });
    }
}
