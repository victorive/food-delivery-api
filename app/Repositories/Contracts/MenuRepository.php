<?php

namespace App\Repositories\Contracts;

interface MenuRepository
{
    public function all(int $restaurantId, int $perPage);

    public function create(array $attributes);

    public function update(array $attributes, string $menuUlid);

    public function findByUlid(string $menuUlid);

    public function delete(string $menuUlid);
}
