<?php

namespace Tests\Feature\V1\Customer;

use App\Models\City;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\Restaurant;
use App\Models\State;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class RestaurantTest extends TestCase
{
    private string $url = 'api/v1/customer/restaurants';

    private $customer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->customer = Customer::factory()->create();
    }

    public function testCustomerCanViewRestaurantsInTheirCountry(): void
    {
        $country = Country::factory()->create();
        $restaurant = Restaurant::factory()->create(['country_id' => $country->id]);

        $this->withToken(JWTAuth::fromUser($this->customer))
            ->get($this->url . '?country=' . $country->name)
            ->assertOk()
            ->assertJsonFragment([
                'name' => $restaurant->name,
            ]);
    }

    public function testCustomerCanViewRestaurantsInTheirState(): void
    {
        $state = State::factory()->create();
        $restaurant = Restaurant::factory()->create(['state_id' => $state->id]);

        $this->withToken(JWTAuth::fromUser($this->customer))
            ->get($this->url . '?state=' . $state->name)
            ->assertOk()
            ->assertJsonFragment([
                'name' => $restaurant->name,
            ]);
    }

    public function testCustomerCanViewRestaurantsInTheirCity(): void
    {
        $city = City::factory()->create();
        $restaurant = Restaurant::factory()->create(['city_id' => $city->id]);

        $this->withToken(JWTAuth::fromUser($this->customer))
            ->get($this->url . '?city=' . $city->name)
            ->assertOk()
            ->assertJsonFragment([
                'name' => $restaurant->name,
            ]);
    }

    public function testCustomerCanViewMenuItemsInAParticularRestaurant(): void
    {
        $restaurant = Restaurant::factory()->create();
        $menuItem = Menu::factory()->create(['restaurant_id' => $restaurant->id]);

        $this->withToken(JWTAuth::fromUser($this->customer))
            ->get($this->url . '/' . $restaurant->ulid . '/menus')
            ->assertOk()
            ->assertJsonFragment([
                'name' => $menuItem->name,
            ]);
    }
}
