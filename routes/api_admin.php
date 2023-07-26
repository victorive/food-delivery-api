<?php

use App\Http\Controllers\Api\V1\Admin\Auth\LoginController;
use App\Http\Controllers\Api\V1\Admin\Auth\LogoutController;
use App\Http\Controllers\Api\V1\Admin\Restaurant\MenuController;
use App\Http\Controllers\Api\V1\Admin\Restaurant\RestaurantController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin API Routes
|--------------------------------------------------------------------------
*/

Route::post('login', LoginController::class);
Route::post('logout', LogoutController::class);

Route::middleware('auth:admin')->group(function () {

    Route::prefix('restaurants')->group(function () {

        Route::get('/', [RestaurantController::class, 'getRestaurants']);

        Route::post('{restaurant_ulid}/menus', [MenuController::class, 'createMenuItem']);
        Route::put('{restaurant_ulid}/menus/{menu_ulid}', [MenuController::class, 'updateMenuItem']);
        Route::delete('{restaurant_ulid}/menus/{menu_ulid}', [MenuController::class, 'deleteMenuItem']);
    });
});
