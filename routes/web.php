<?php

use App\Http\Controllers\Auth\FacebookAuthController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Dashboard\Account\AddressController;
use App\Http\Controllers\Dashboard\Account\ProfileController;
use App\Http\Controllers\Dashboard\Admin\BrandController;
use App\Http\Controllers\Dashboard\Admin\HomeController;
use App\Http\Controllers\Dashboard\User\IndexController;
use App\Http\Controllers\Dashboard\Admin\ProductCategoryController;
use App\Http\Controllers\Dashboard\Admin\ProductController;
use App\Http\Controllers\Dashboard\Admin\SubcategoryController;
use App\Http\Controllers\Dashboard\User\Cart\CheckOutController;
use App\Http\Controllers\Dashboard\User\OrderController;
use App\Http\Controllers\Dashboard\User\Payment\FlutterwaveController;
use App\Http\Controllers\Dashboard\User\Payment\PayPalController;
use App\Http\Controllers\Dashboard\User\Payment\StripeController;
use App\Http\Controllers\Dashboard\User\Payment\StripeWebhookController;
use App\Http\Controllers\Dashboard\User\WishlistController;
use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\Category\CategoryController;
use App\Http\Controllers\Web\ShopController;
use App\Http\Controllers\Web\WelcomeController;
use App\Http\Livewire\Wishlist;
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
    Route::get('privacy-policy', [WelcomeController::class, 'privacy-policy'])->name('privacy-policy');
    Route::prefix('shop')->as('shop.')->group(function () {
        Route::get('index', [ShopController::class, 'index'])->name('index');
        Route::get('search/category/{name}/products', [ShopController::class, 'fetchProductsByCategory'])->name('search.category.products');
        Route::get('product/{id}/details', [ShopController::class, 'details'])->name('product.details');
        Route::post('/add-to-cart/{id}', [CartController::class, 'index'])->name('cart.store');
        Route::get('/cat', [CartController::class, 'cartList'])->name('cart');
        Route::get('category', [CategoryController::class, 'category'])->name('category');
        Route::get('category/{subcategory}', [CategoryController::class, 'subcategory'])->name('category.sucategory')->where('subcategory', '[A-Za-z0-9\-]+');
        Route::get('category/{subcategory}/{name}/products', [CategoryController::class, 'categoryProducts'])->name('category.products');
    });
});


Route::prefix('admin')->as('admin.')->group(function () {
    Route::prefix('dashboard')->as('dashboard.')->middleware(['auth', 'admin'])->group(function () {
        Route::get('home', [HomeController::class, 'home'])->name('home');
        Route::resource('product', ProductController::class);
        Route::put('/products/{id}/update-featured', [ProductController::class, 'updateFeatured'])->name('product.featured');
        Route::resource('product-category', ProductCategoryController::class);

        Route::get('create/subcategory/{id}', [SubcategoryController::class, 'createSubcategory'])->name('create.subcategory');
        Route::resource('subcategory', SubcategoryController::class);

        Route::resource('brand', BrandController::class);
    });
});



Route::prefix('user')->as('user.')->group(function () {
    Route::prefix('dashboard')->as('dashboard.')->middleware(['auth'])->group(function () {
        Route::get('home', [IndexController::class, 'home'])->name('home');
        Route::get('thank-you', [IndexController::class, 'thankYou'])->name('thank-you');
        Route::get('checkout', [CheckOutController::class, 'checkout'])->name('checkout');
        Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('place-order');
        Route::get('/orders', [OrderController::class, 'orders'])->name('orders');
        Route::get('/order/{id}/products', [OrderController::class, 'orderProducts'])->name('order.products');
        Route::get('/wishlist', [WishlistController::class, 'wishlist'])->name('wishlist');

        Route::post('/stripe/checkout', [StripeController::class, 'initiatePayment'])->name('stripe.checkout');
        Route::get('/stripe/transaction/webhook', [StripeWebhookController::class, 'handleTransactionWebhook'])->name('stripe.transaction.webhook');
        // Route::get('/store-stripe-payment-info', [PaymentController::class, 'storePaymentInfo'])->name('store.stripe-payment.info');

        // payment method with flutterwave moveWishlistItemToCart
        // Route::get('/flutterwave/payment/initiate', [FlutterwaveController::class, 'initiatePayment'])->name('flutterwave.payment.initiate');
        // Route::get('/flutterwave/payment/callback', [FlutterwaveControprocessPaymentller::class, 'paymentCallback'])->name('flutterwave.payment.callback');
    });
});

Route::prefix('account')->as('account.')->group(function () {
    Route::get('profile/index', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('address', [AddressController::class, 'saveAddress'])->name('address.save');
    Route::put('address', [AddressController::class, 'saveAddress'])->name('address.update');
});

Route::prefix('auth')->as('auth.')->group(function () {
    Route::get('/login/facebook', [FacebookAuthController::class, 'redirectToFacebook'])->name('login.facebook');
    Route::get('/login/facebook/callback', [FacebookAuthController::class, 'handleFacebookCallback'])->name('login.facebook.callback');

    Route::get('/login/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('/login/google/callback', [GoogleAuthController::class, 'handleGoogleCallback'])->name('login.google.callback');
});
