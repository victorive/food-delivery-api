<?php

namespace App\Policies;

use App\Models\OrderItem;
use App\Models\Restaurant;

class OrderItemPolicy
{
    public function update(Restaurant $restaurant, OrderItem $orderItem): bool
    {
        return $restaurant->id === $orderItem->restaurant_id;
    }
}
