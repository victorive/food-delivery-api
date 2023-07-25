<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $countryIds = Country::query()->pluck('id')->toArray();
        $stateIds = State::query()->pluck('id')->toArray();
        $cityIds = City::query()->pluck('id')->toArray();

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => 'password',
            'phone' => fake()->unique()->e164PhoneNumber(),
            'address' => fake()->address(),
            'country_id' => fake()->randomElement($countryIds),
            'state_id' => fake()->randomElement($stateIds),
            'city_id' => fake()->randomElement($cityIds),
        ];
    }
}
