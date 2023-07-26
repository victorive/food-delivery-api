<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CityController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $cities = City::all();

        if (!$cities) {
            return response()->json([
                'status' => true,
                'message' => 'No city found',
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => true,
            'message' => 'Cities retrieved successfully',
            'data' => $cities,
        ], Response::HTTP_OK);
    }
}
