<?php

namespace App\Repositories\Eloquent;

use App\Models\Order;
use App\Repositories\Contracts\OrderRepository;

class OrderRepositoryEloquent implements OrderRepository
{
    public function create(array $attributes)
    {
        return Order::query()->create($attributes);
    }

    public function update(array $attributes, string $orderUlid)
    {
        return tap($this->findByUlId($orderUlid), function () use ($attributes) {
            Order::query()->update($attributes);
        });
    }

    public function findByUlid(string $orderUlid)
    {
        return Order::query()->where('ulid', $orderUlid)->first();
    }

    public function delete(string $orderUlid)
    {
        return Order::query()->where('ulid', $orderUlid)->delete();
    }
}
