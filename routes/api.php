<?php

use App\Http\Controllers\Api\V1\CityController;
use App\Http\Controllers\Api\V1\CountryController;
use App\Http\Controllers\Api\V1\StateController;
use App\Http\Controllers\Api\V1\User\Auth\DeviceTokenController;
use App\Http\Controllers\Api\V1\User\Auth\LoginController;
use App\Http\Controllers\Api\V1\User\Auth\LogoutController;
use App\Http\Controllers\Api\V1\User\Auth\RegisterController;
use App\Http\Controllers\Api\V1\User\MenuController;
use App\Http\Controllers\Api\V1\User\OrderController;
use App\Http\Controllers\Api\V1\User\OrderItemController;
use App\Http\Controllers\Api\V1\User\RestaurantController;
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

        Route::patch('device-token', [DeviceTokenController::class, 'updateCustomerDeviceToken']);

        Route::get('restaurants', [RestaurantController::class, 'getRestaurants']);
        Route::get('restaurants/{restaurant_ulid}/menus', [RestaurantController::class, 'getRestaurantMenus']);

        Route::post('order', [OrderController::class, 'createOrder']);
    });
});

Route::prefix('restaurant')->group(function () {

    Route::post('register', [RegisterController::class, 'registerRestaurant']);
    Route::post('login', [LoginController::class, 'loginRestaurant']);
    Route::post('logout', LogoutController::class);

    Route::middleware('auth:restaurant')->group(function () {

        Route::patch('device-token', [DeviceTokenController::class, 'updateRestaurantDeviceToken']);

        Route::prefix('menus')->group(function () {
            Route::get('/', [MenuController::class, 'getMenuItems']);
            Route::post('/', [MenuController::class, 'createMenuItem']);
            Route::put('{menu_ulid}', [MenuController::class, 'updateMenuItem']);
            Route::delete('{menu_ulid}', [MenuController::class, 'deleteMenuItem']);
        });

        Route::prefix('orders')->group(function () {
            Route::get('/', [OrderItemController::class, 'getRestaurantOrderItems']);
            Route::patch('/{order_item_ulid}/accept', [OrderItemController::class, 'acceptOrderItem']);
            Route::patch('/{order_item_ulid}/reject', [OrderItemController::class, 'rejectOrderItem']);
        });
    });
});

Route::prefix('delivery-agent')->group(function () {

    Route::post('register', [RegisterController::class, 'registerDeliveryAgent']);
    Route::post('login', [LoginController::class, 'loginDeliveryAgent']);
    Route::post('logout', LogoutController::class);

    Route::middleware('auth:delivery-agent')->group(function () {
        Route::patch('device-token', [DeviceTokenController::class, 'updateDeliveryAgentDeviceToken']);
    });
});

Route::get('countries', CountryController::class);
Route::get('states', StateController::class);
Route::get('cities', CityController::class);
