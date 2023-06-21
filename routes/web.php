<?php

use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\ProductCategoryController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Web\ShopController;
use App\Http\Controllers\Web\WelcomeController;
use App\Models\Product;
use App\Models\ProductCategory;
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

Route::prefix('web')->as('web.')->group(function () {
    Route::get('welcome', [WelcomeController::class, 'welcome'])->name('welcome');
    Route::prefix('shop')->as('shop.')->group(function () {
        Route::get('index', [ShopController::class, 'index'])->name('index');
        Route::get('product/{id}/details', [ShopController::class, 'details'])->name('product.details');
    });
});

Route::prefix('dashboard')->as('dashboard.')->middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::resource('product', ProductController::class);
    Route::resource('product-category', ProductCategoryController::class);
});
