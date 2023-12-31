<?php

namespace App\Services\V1\User;

use App\Repositories\Contracts\RestaurantRepository;

class RestaurantService
{
    public function __construct(private RestaurantRepository $restaurantRepository)
    {
    }

    public function getRestaurantsByArea(int $perPage, string $country = null, string $state = null, string $city = null)
    {
        return $this->restaurantRepository->all($perPage, $country, $state, $city);
    }

    public function getRestaurantMenus(string $restaurantUlid, int $perPage)
    {
        return $this->restaurantRepository->getRestaurantMenus($restaurantUlid, $perPage);
    }
}
