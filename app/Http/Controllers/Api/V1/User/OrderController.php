<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\User\OrderRequest;
use App\Services\V1\User\Auth\OrderService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService)
    {
    }

    public function createOrder(OrderRequest $request): JsonResponse
    {
        $customerId = auth('customer')->user()->id;

        $order = $this->orderService->createOrder($request->validated(), $customerId);

        OrderCreated::dispatch($order);

        return response()->json([
            'status' => true,
            'message' => 'Order created successfully',
            'data' => $order,
        ], Response::HTTP_CREATED);
    }
}
