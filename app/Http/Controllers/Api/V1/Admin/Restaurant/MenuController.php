<?php

namespace App\Http\Controllers\Api\V1\Admin\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Admin\MenuRequest;
use App\Services\V1\Admin\MenuService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class MenuController extends Controller
{
    public function __construct(private MenuService $menuService)
    {
    }

    public function createMenuItem(MenuRequest $request, string $restaurantUlid): JsonResponse
    {
        $menuItem = $this->menuService->createMenuItem($request->validated(), $restaurantUlid);

        return response()->json([
            'status' => true,
            'message' => 'Menu item created successfully',
            'data' => $menuItem,
        ], Response::HTTP_CREATED);
    }

    public function updateMenuItem(MenuRequest $request, string $restaurantUlid, string $menuUlid): JsonResponse
    {
        $menuItem = $this->menuService->updateMenuItem($request->validated(), $restaurantUlid, $menuUlid);

        return response()->json([
            'status' => true,
            'message' => 'Menu item updated successfully',
            'data' => $menuItem,
        ], Response::HTTP_OK);
    }

    public function deleteMenuItem(string $restaurantUlid, string $menuUlid): JsonResponse
    {
        $this->menuService->deleteMenuItem($restaurantUlid, $menuUlid);

        return response()->json([
            'status' => true,
            'message' => 'Menu item deleted successfully',
        ], Response::HTTP_OK);
    }
}
