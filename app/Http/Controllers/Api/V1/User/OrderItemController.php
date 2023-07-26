<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Events\OrderItemStatusUpdated;
use App\Http\Controllers\Controller;
use App\Services\V1\User\Auth\OrderItemService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderItemController extends Controller
{
    public function __construct(private OrderItemService $orderItemService)
    {
    }

    public function getRestaurantOrderItems(Request $request): JsonResponse
    {
        $restaurantId = auth('restaurant')->user()->id;

        $orders = $this->orderItemService->getRestaurantOrderItems($restaurantId);

        return response()->json([
            'status' => true,
            'message' => 'Orders retrieved successfully',
            'data' => $orders,
        ], Response::HTTP_OK);
    }

    /**
     * @throws AuthorizationException
     */
    public function acceptOrderItem(string $orderItemUlid): JsonResponse
    {
        $order = $this->orderItemService->findOrderItemByUlid($orderItemUlid);

        $this->authorize('update', $order);

        $acceptedOrder = $this->orderItemService->acceptOrderItem($orderItemUlid);

        OrderItemStatusUpdated::dispatch($acceptedOrder);

        return response()->json([
            'status' => true,
            'message' => 'Order accepted',
            'data' => $acceptedOrder,
        ], Response::HTTP_OK);
    }

    /**
     * @throws AuthorizationException
     */
    public function rejectOrderItem(string $orderItemUlid): JsonResponse
    {
        $order = $this->orderItemService->findOrderItemByUlid($orderItemUlid);

        $this->authorize('update', $order);

        $rejectedOrder = $this->orderItemService->rejectOrderItem($orderItemUlid);

        OrderItemStatusUpdated::dispatch($rejectedOrder);

        return response()->json([
            'status' => true,
            'message' => 'Order rejected',
            'data' => $rejectedOrder,
        ], Response::HTTP_OK);
    }
}
