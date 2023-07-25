<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\V1\RestaurantService;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function __construct(private RestaurantService $restaurantService)
    {
    }
    public function getRestaurants(Request $request)
    {
        $country = $request->has('country') ? $request->query('country') : null;
        $state = $request->has('state') ? $request->query('state') : null;
        $city = $request->has('city') ? $request->query('city') : null;

        return $this->restaurantService->getRestaurantsByArea($country, $state, $city);
    }

    public function getRestaurantMenu(Request $request, string $ulid)
    {
        $perPage = $request->query('perPage', 15);

        return $this->restaurantService->getRestaurantMenu($ulid, $perPage);
    }
}
