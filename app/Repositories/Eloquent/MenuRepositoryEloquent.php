<?php

namespace App\Repositories\Eloquent;

use App\Models\Menu;
use App\Repositories\Contracts\MenuRepository;

class MenuRepositoryEloquent implements MenuRepository
{

    public function all()
    {
        return Menu::all();
    }

    public function create(array $attributes)
    {
        return Menu::query()->create($attributes);
    }

    public function update(array $attributes, string $menuUlid)
    {
        return tap($this->findByUlid($menuUlid), function ($menu) use ($attributes) {
            $menu->update($attributes);
        });
    }

    public function findByUlid(string $menuUlid)
    {
        return Menu::query()->where('ulid', $menuUlid)->first();
    }

    public function findByRestaurantId(int $restaurantId, int $perPage)
    {
        return Menu::query()->find($restaurantId)->paginate($perPage);
    }

    public function delete(string $menuUlid)
    {
        return Menu::query()->where('ulid', $menuUlid)->delete();
    }
}
