<?php

namespace App\Repositories\Contracts;

interface RestaurantRepository
{
    public function all();

    public function create(array $attributes);

    public function findByUlid(string $restaurantUlid);

    public function getRestaurantMenu(string $restaurantUlid, int $perPage);
}
