<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\User\MenuRequest;
use App\Services\V1\User\MenuService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MenuController extends Controller
{
    public function __construct(private MenuService $menuService)
    {
    }

    public function getMenuItems(Request $request): JsonResponse
    {
        $perPage = $request->query('perPage', 15);
        $restaurantId = auth('restaurant')->user()->id;

        $menuItems = $this->menuService->getMenuItems($restaurantId, $perPage);

        if (!$menuItems) {
            return response()->json([
                'status' => true,
                'message' => 'No menu item found',
            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => true,
            'message' => 'Menu items retrieved successfully',
            'data' => $menuItems,
        ], Response::HTTP_OK);
    }

    public function createMenuItem(MenuRequest $request): JsonResponse
    {
        $restaurantId = auth('restaurant')->user()->id;

        $menuItem = $this->menuService->createMenuItem($request->validated(), $restaurantId);

        return response()->json([
            'status' => true,
            'message' => 'Menu item created successfully',
            'data' => $menuItem,
        ], Response::HTTP_CREATED);
    }

    /**
     * @throws AuthorizationException
     */
    public function updateMenuItem(MenuRequest $request, string $ulid): JsonResponse
    {
        $item = $this->menuService->findMenuItemByUlid($ulid);

        $this->authorize('update', $item);

        $menuItem = $this->menuService->updateMenuItem($request->validated(), $ulid);

        return response()->json([
            'status' => true,
            'message' => 'Menu item updated successfully',
            'data' => $menuItem,
        ], Response::HTTP_OK);
    }

    /**
     * @throws AuthorizationException
     */
    public function deleteMenuItem(string $ulid): JsonResponse
    {
        $item = $this->menuService->findMenuItemByUlid($ulid);

        $this->authorize('delete', $item);

        $this->menuService->deleteMenuItem($ulid);

        return response()->json([
            'status' => true,
            'message' => 'Menu item deleted successfully',
        ], Response::HTTP_OK);
    }
}
