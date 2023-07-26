<?php

namespace App\Repositories\Contracts;

interface RestaurantRepository
{
    public function all(int $perPage, string $country, string $state, string $city);

    public function create(array $attributes);

    public function findById(int $restaurantId);

    public function findByUlid(string $restaurantUlid);

    public function getRestaurantMenus(string $restaurantUlid, int $perPage);

    public function getRestaurantOrderItems(int $restaurantId);

    public function update(array $attributes, $restaurantId);
}
