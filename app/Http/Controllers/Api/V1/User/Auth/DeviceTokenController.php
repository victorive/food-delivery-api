<?php

namespace App\Http\Controllers\Api\V1\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\User\Auth\DeviceTokenRequest;
use App\Services\V1\User\Auth\DeviceTokenService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeviceTokenController extends Controller
{
    public function __construct(private DeviceTokenService $deviceTokenService)
    {
    }

    public function updateCustomerDeviceToken(DeviceTokenRequest $request): JsonResponse
    {
        $customerId = auth('customer')->user()->id;

        $result = $this->deviceTokenService->updateCustomerDeviceToken($request->validated(), $customerId);

        return $this->respondWithToken($result);
    }

    public function updateRestaurantDeviceToken(DeviceTokenRequest $request): JsonResponse
    {
        $restaurantId = auth('restaurant')->user()->id;

        $result = $this->deviceTokenService->updateRestaurantDeviceToken($request->validated(), $restaurantId);

        return $this->respondWithToken($result);
    }

    public function updateDeliveryAgentDeviceToken(DeviceTokenRequest $request): JsonResponse
    {
        $deliveryAgentId = auth('delivery-agent')->user()->id;

        $result = $this->deviceTokenService->updateDeliveryAgentDeviceToken($request->validated(), $deliveryAgentId);

        return $this->respondWithToken($result);
    }

    public function respondWithToken($result): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => 'Device token updated successfully',
            'data' => $result,
        ], Response::HTTP_OK);
    }
}
