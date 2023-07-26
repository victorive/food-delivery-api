<?php

namespace App\Repositories\Eloquent;

use App\Models\OrderItem;
use App\Repositories\Contracts\OrderItemRepository;

class OrderItemRepositoryEloquent implements OrderItemRepository
{

    public function update(array $attributes, string $orderItemUlid)
    {
        return tap($this->findByUlId($orderItemUlid), function ($orderItem) use ($attributes) {
            $orderItem->update($attributes);
        });
    }

    public function findByUlid(string $orderItemUlid)
    {
        return OrderItem::query()->where('ulid', $orderItemUlid)->first();
    }
}
