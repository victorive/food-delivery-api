<?php

use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\LogoutController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\MenuController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\RestaurantController;
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

Route::prefix('customer')->group(function () {

    Route::post('register', [RegisterController::class, 'registerCustomer']);
    Route::post('login', [LoginController::class, 'loginCustomer']);
    Route::post('logout', LogoutController::class);

    Route::middleware('auth:customer')->group(function () {

        Route::get('restaurants', [RestaurantController::class, 'getRestaurants']);
        Route::get('restaurants/{ulid}/menu', [RestaurantController::class, 'getRestaurantMenu']);

        Route::post('order', [OrderController::class, 'createOrder']);
    });
});

Route::prefix('restaurant')->group(function () {

    Route::post('register', [RegisterController::class, 'registerRestaurant']);
    Route::post('login', [LoginController::class, 'loginRestaurant']);
    Route::post('logout', LogoutController::class);

    Route::middleware('auth:restaurant')->group(function () {

        Route::prefix('menu-item')->group(function () {
            Route::get('/', [MenuController::class, 'getMenuItems']);
            Route::post('/', [MenuController::class, 'createMenuItem']);
            Route::put('{ulid}', [MenuController::class, 'updateMenuItem']);
            Route::delete('{ulid}', [MenuController::class, 'deleteMenuItem']);
        });
    });
});

Route::prefix('delivery-agent')->group(function () {

    Route::post('register', [RegisterController::class, 'registerDeliveryAgent']);
    Route::post('login', [LoginController::class, 'loginDeliveryAgent']);
    Route::post('logout', LogoutController::class);

    Route::middleware('auth:delivery-agent')->group(function () {
    });
});
