<?php

namespace App\Http\Controllers\Api\V1\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\User\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function loginCustomer(LoginRequest $request): JsonResponse
    {
        return $this->loginAndRespondWithToken('customer', $request->validated());
    }

    public function loginRestaurant(LoginRequest $request): JsonResponse
    {
        return $this->loginAndRespondWithToken('restaurant', $request->validated());
    }

    public function loginDeliveryAgent(LoginRequest $request): JsonResponse
    {
        return $this->loginAndRespondWithToken('delivery-agent', $request->validated());
    }

    public function loginAndRespondWithToken(string $guard, array $credentials): JsonResponse
    {
        if (!$token = auth($guard)->attempt($credentials)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'status' => true,
            'access_token' => $token,
            'message' => 'Login successful',
        ], Response::HTTP_OK);
    }
}
