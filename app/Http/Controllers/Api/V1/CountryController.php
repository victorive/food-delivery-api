<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Symfony\Component\HttpFoundation\Response;

class CountryController extends Controller
{
    public function __invoke()
    {
        $countries = Country::all();

        if (!$countries) {
            return response()->json([
                'status' => true,
                'message' => 'No country found',
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => true,
            'message' => 'Countries retrieved successfully',
            'data' => $countries,
        ], Response::HTTP_OK);
    }
}
