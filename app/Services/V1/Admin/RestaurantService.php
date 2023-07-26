<?php

namespace App\Services\V1\Admin;

use App\Repositories\Contracts\RestaurantRepository;

class RestaurantService
{
    public function __construct(private RestaurantRepository $restaurantRepository)
    {
    }

    public function getRestaurants(int $perPage)
    {
        return $this->restaurantRepository->all($perPage);
    }
}
