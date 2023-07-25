<?php

namespace App\Services\V1;

use App\Repositories\Contracts\MenuRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MenuService
{
    public function __construct(private MenuRepository $menuRepository)
    {
    }

    public function getMenuItems(int $restaurantId, int $perPage)
    {
        return $this->menuRepository->all($restaurantId, $perPage);
    }

    public function createMenuItem(array $formData, int $restaurantId)
    {
        $formData = collect($formData)->merge(['restaurant_id' => $restaurantId])
            ->toArray();

        return $this->menuRepository->create($formData);
    }

    public function updateMenuItem(array $formData, string $menuUlid)
    {
        return $this->menuRepository->update($formData, $menuUlid);
    }

    public function deleteMenuItem(string $menuUlid)
    {
        return $this->menuRepository->delete($menuUlid);
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
