<?php

namespace App\Policies\V1;

use App\Models\Menu;
use App\Models\Restaurant;

class MenuPolicy
{
    public function update(Restaurant $restaurant, Menu $menu): bool
    {
        return $restaurant->id === $menu->restaurant_id;
    }

    public function delete(Restaurant $restaurant, Menu $menu): bool
    {
        return $restaurant->id === $menu->restaurant_id;
    }
}
