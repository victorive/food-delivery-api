<?php

namespace App\Repositories\Contracts;

interface RestaurantRepository
{
    public function all(int $perPage, string $country, string $state, string $city);

    public function create(array $attributes);

    public function findByUlid(string $restaurantUlid);

    public function getRestaurantMenu(string $restaurantUlid, int $perPage);
}
