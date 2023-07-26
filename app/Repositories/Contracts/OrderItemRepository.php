<?php

namespace App\Repositories\Contracts;

interface OrderItemRepository
{
    public function update(array $attributes, string $orderItemUlid);

    public function findByUlid(string $orderItemUlid);
}
