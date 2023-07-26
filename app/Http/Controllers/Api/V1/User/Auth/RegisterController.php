<?php

namespace App\Http\Controllers\Api\V1\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\User\Auth\RegisterCustomerRequest;
use App\Http\Requests\V1\User\Auth\RegisterDeliveryAgentRequest;
use App\Http\Requests\V1\User\Auth\RegisterRestaurantRequest;
use App\Services\V1\User\Auth\RegisterService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    public function __construct(private RegisterService $registerService)
    {
    }

    public function registerCustomer(RegisterCustomerRequest $request): JsonResponse
    {
        $result = $this->registerService->registerCustomer($request->validated());

        return $this->authenticateAndRespondWithToken($request, $result, 'customer');
    }

    public function registerRestaurant(RegisterRestaurantRequest $request): JsonResponse
    {
        $result = $this->registerService->registerRestaurant($request->validated());

        return $this->authenticateAndRespondWithToken($request, $result, 'restaurant');
    }

    public function registerDeliveryAgent(RegisterDeliveryAgentRequest $request): JsonResponse
    {
        $result = $this->registerService->registerDeliveryAgent($request->validated());

        return $this->authenticateAndRespondWithToken($request, $result, 'delivery-agent');
    }

    private function authenticateAndRespondWithToken(object $request, object $result, string $guard): JsonResponse
    {
        if (!$token = auth($guard)->attempt($request->safe()->only('email', 'password'))) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'status' => true,
            'access_token' => $token,
            'data' => $result,
            'message' => 'Registration successful',
        ], Response::HTTP_CREATED);
    }
}
