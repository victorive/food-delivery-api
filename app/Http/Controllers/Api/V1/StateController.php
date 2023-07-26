<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\State;
use Symfony\Component\HttpFoundation\Response;

class StateController extends Controller
{
    public function __invoke()
    {
        $states = State::all();

        if (!$states) {
            return response()->json([
                'status' => true,
                'message' => 'No state found',
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => true,
            'message' => 'States retrieved successfully',
            'data' => $states,
        ], Response::HTTP_OK);
    }
}
