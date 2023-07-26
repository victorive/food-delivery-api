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

        return response()->json([
            'status' => true,
            'message' => 'States retrieved successfully',
            'data' => $states,
        ], Response::HTTP_OK);
    }
}
