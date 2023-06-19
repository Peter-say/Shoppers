<?php

use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Web\ShopController;
use App\Http\Controllers\Web\WelcomeController;
use App\Models\Product;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('web')->as('web.')->group(function () {
    Route::get('welcome', [WelcomeController::class, 'welcome'])->name('welcome');
    Route::get('shop', [ShopController::class, 'index'])->name('shop');
});

Route::prefix('dashboard')->as('dashboard')->middleware('auth')->group(function () {
    Route::get('home', [HomeController::class, 'home'])->name('home');
    Route::resources([
        'product', Product::class,
        'product-category', ProductController::class,
    ]);
});
