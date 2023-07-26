<?php

namespace App\Repositories\Eloquent;

use App\Models\Restaurant;
use App\Repositories\Contracts\RestaurantRepository;

class RestaurantRepositoryEloquent implements RestaurantRepository
{

    public function all(int $perPage, string $country = null, string $state = null, string $city = null)
    {
        $query = Restaurant::query()
            ->join('countries', 'restaurants.country_id', '=', 'countries.id')
            ->join('states', 'restaurants.state_id', '=', 'states.id')
            ->join('cities', 'restaurants.city_id', '=', 'cities.id');

        if ($country) {
            $query->where('countries.name', 'LIKE', '%' . $country . '%');
        }

        if ($state) {
            $query->where('states.name', 'LIKE', '%' . $state . '%');
        }

        if ($city) {
            $query->where('cities.name', 'LIKE', '%' . $city . '%');
        }

        return $query->select('restaurants.*')->paginate($perPage);
    }

    public function create(array $attributes)
    {
        return Restaurant::query()->create($attributes);
    }

    public function findByUlid(string $restaurantUlid)
    {
        return Restaurant::query()->where('ulid', $restaurantUlid)->first();
    }

    public function getRestaurantMenu(string $restaurantUlid, int $perPage)
    {
        return Restaurant::query()->where('ulid', $restaurantUlid)
            ->with('menus')->paginate($perPage);
    }
}
