<?php

namespace App\Http\Controllers\Api\V1\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class LogoutController extends Controller
{
    public function __invoke(): JsonResponse
    {
        auth()->logout();

        return response()->json([
            'status' => true,
            'message' => 'Logout successful',
        ], Response::HTTP_OK);
    }
}
