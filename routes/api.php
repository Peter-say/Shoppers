<?php

use App\Http\Controllers\Api\V1\Auth\ForgetPasswordController;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\Product\ProductCategoryController;
use App\Http\Controllers\Api\V1\Product\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    Route::middleware('auth:sanctum', 'admin')->group(function () {
        // Protected routes that require authentication
        Route::apiResource('product', ProductController::class)->except(['index', 'show']);
        Route::apiResource('productCategory', ProductCategoryController::class)->except(['index', 'show']);
    });

    // Public routes that do not require authentication
    Route::apiResource('product', ProductController::class)->only(['index', 'show']);
    Route::apiResource('productCategory', ProductCategoryController::class)->only(['index', 'show']);

    // authentication routes
    Route::prefix('auth')->group(function () {
        Route::post('register', [RegisterController::class, 'register']);
        Route::post('login', [LoginController::class, 'login']);
        Route::post('password/forget', [ForgetPasswordController::class, 'forgetPassword']);
        Route::post('password/reset', [ForgetPasswordController::class, 'ResetUserPassword']);
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
