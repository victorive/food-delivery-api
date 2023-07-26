<?php

namespace App\Services\V1\Admin;

use App\Repositories\Contracts\MenuRepository;
use App\Repositories\Contracts\RestaurantRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MenuService
{
    public function __construct(private MenuRepository       $menuRepository,
                                private RestaurantRepository $restaurantRepository)
    {
    }

    public function createMenuItem(array $formData, string $restaurantUlid)
    {
        $restaurant = $this->findRestaurantByUlid($restaurantUlid);

        $formData = collect($formData)->merge(['restaurant_id' => $restaurant->id])
            ->toArray();

        return $this->menuRepository->create($formData);
    }

    public function updateMenuItem(array $formData, string $restaurantUlid, string $menuUlid)
    {
        $restaurant = $this->findRestaurantByUlid($restaurantUlid);

        $this->findMenuItemByUlid($menuUlid);

        $formData = collect($formData)->merge(['restaurant_id' => $restaurant->id])
            ->toArray();

        return $this->menuRepository->update($formData, $menuUlid);
    }

    public function deleteMenuItem(string $restaurantUlid, string $menuUlid)
    {
        $this->findRestaurantByUlid($restaurantUlid);

        $this->findMenuItemByUlid($menuUlid);

        return $this->menuRepository->delete($menuUlid);
    }

    public function findRestaurantByUlid(string $restaurantUlid)
    {
        $restaurant = $this->restaurantRepository->findByUlid($restaurantUlid);

        if (!$restaurant) {
            throw new NotFoundHttpException;
        }

        return $restaurant;
    }

    public function findMenuItemByUlid(string $menuUlid)
    {
        $menuItem = $this->menuRepository->findByUlid($menuUlid);

        if (!$menuItem) {
            throw new NotFoundHttpException;
        }

        return $menuItem;
    }
}
