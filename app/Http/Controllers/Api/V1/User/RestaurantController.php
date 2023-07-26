<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Services\V1\User\RestaurantService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestaurantController extends Controller
{
    public function __construct(private RestaurantService $restaurantService)
    {
    }
    public function getRestaurants(Request $request)
    {
        $perPage = $request->query('perPage', 15);

        $country = $request->has('country') ? $request->query('country') : null;
        $state = $request->has('state') ? $request->query('state') : null;
        $city = $request->has('city') ? $request->query('city') : null;

        $restaurants = $this->restaurantService->getRestaurantsByArea($perPage, $country, $state, $city);

        return response()->json([
            'status' => true,
            'message' => 'Restaurants retrieved successfully',
            'data' => $restaurants,
        ], Response::HTTP_OK);
    }

    public function getRestaurantMenu(Request $request, string $ulid)
    {
        $perPage = $request->query('perPage', 15);

        return $this->restaurantService->getRestaurantMenu($ulid, $perPage);
    }
}
