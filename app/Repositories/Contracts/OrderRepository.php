<?php

namespace App\Repositories\Contracts;

interface OrderRepository
{
    public function create(array $attributes);

    public function update(array $attributes, string $orderUlid);

    public function delete(string $orderUlid);

    public function findByUlid(string $orderUlid);
}
