<?php

namespace App\Http\Controllers\Api\V1\Admin\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Admin\MenuRequest;
use App\Services\V1\Admin\MenuService;
use App\Services\V1\Admin\RestaurantService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestaurantController extends Controller
{
    public function __construct(private RestaurantService $restaurantService)
    {
    }

    public function getRestaurants(Request $request): JsonResponse
    {
        $perPage = $request->query('perPage', 15);

        $restaurants = $this->restaurantService->getRestaurants($perPage);

        if (!$restaurants) {
            return response()->json([
                'status' => true,
                'message' => 'No restaurant found',
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => true,
            'message' => 'Restaurants retrieved successfully',
            'data' => $restaurants,
        ], Response::HTTP_OK);
    }
}
