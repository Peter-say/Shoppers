<?php

use App\Http\Controllers\Dashboard\Admin\HomeController;
use App\Http\Controllers\Dashboard\User\IndexController;
use App\Http\Controllers\Dashboard\Admin\ProductCategoryController;
use App\Http\Controllers\Dashboard\Admin\ProductController;
use App\Http\Controllers\Dashboard\Admin\SubcategoryController;
use App\Http\Controllers\Dashboard\AdminProductController;
use App\Http\Controllers\Dashboard\User\AddressController;
use App\Http\Controllers\Dashboard\User\Cart\CheckOutController;
use App\Http\Controllers\Dashboard\User\OrderController;
use App\Http\Controllers\Dashboard\User\Payment\PayPalController;
use App\Http\Controllers\Dashboard\User\ProfileController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\CatController;
use App\Http\Controllers\Web\ShopController;
use App\Http\Controllers\Web\WelcomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Auth::routes();

Route::get('/', [WelcomeController::class, 'welcome']);
Route::prefix('web')->as('web.')->group(function () {
    Route::prefix('shop')->as('shop.')->group(function () {
        Route::get('index', [ShopController::class, 'index'])->name('index');
        Route::get('product/{id}/details', [ShopController::class, 'details'])->name('product.details');
        Route::post('/add-to-cart/{id}', [CartController::class, 'index'])->name('cart.store');
        Route::get('/cat', [CartController::class, 'cartList'])->name('cart');
    });
});


Route::prefix('admin')->as('admin.')->group(function () {
    Route::prefix('dashboard')->as('dashboard.')->middleware(['auth', 'admin'])->group(function () {
        Route::get('home', [HomeController::class, 'home'])->name('home');
        Route::resource('product', ProductController::class);
        Route::resource('product-category', ProductCategoryController::class);

        Route::get('create/subcategory/{id}', [SubcategoryController::class , 'createSubcategory'])->name('create.subcategory');
        Route::resource('subcategory', SubcategoryController::class);

    });
});



Route::prefix('user')->as('user.')->group(function () {
    Route::prefix('dashboard')->as('dashboard.')->middleware(['auth'])->group(function () {
        Route::get('home', [IndexController::class, 'home'])->name('home');
        Route::get('thank-you', [IndexController::class, 'thankYou'])->name('thank-you');
        Route::get('checkout', [CheckOutController::class, 'checkout'])->name('checkout');
        Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('place.order');

        // payment method with paypal
        Route::get('/paypal/checkout', [PayPalController::class, 'checkout'])->name('paypal.checkout');


        Route::prefix('profile')->as('profile.')->group(function () {
            Route::get('index', [ProfileController::class, 'index'])->name('index');
            Route::put('update', [ProfileController::class, 'update'])->name('update');

            Route::post('address', [AddressController::class, 'saveAddress'])->name('address.save');
            Route::put('address', [AddressController::class, 'saveAddress'])->name('address.update');
        });
    });
});
