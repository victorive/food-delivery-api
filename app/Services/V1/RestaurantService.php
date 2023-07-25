<?php

namespace App\Services\V1;

use App\Repositories\Contracts\RestaurantRepository;

class RestaurantService
{
    public function __construct(private RestaurantRepository $restaurantRepository)
    {
    }

    public function getRestaurantsByArea(string $country = null, string $state = null, string $city = null)
    {
        return $this->restaurantRepository->all($country, $state, $city);
    }

    public function getRestaurantMenu(string $restaurantUlid, int $perPage)
    {
        return $this->restaurantRepository->getRestaurantMenu($restaurantUlid, $perPage);
    }
}
