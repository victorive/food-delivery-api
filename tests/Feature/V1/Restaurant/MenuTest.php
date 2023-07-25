<?php

namespace Tests\Feature\V1\Restaurant;

use App\Models\Menu;
use App\Models\Restaurant;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class MenuTest extends TestCase
{
    private string $url = 'api/v1/restaurant/menu-item';

    private $restaurant;

    protected function setUp(): void
    {
        parent::setUp();

        $this->restaurant = Restaurant::factory()->create();
    }

    public function testRestaurantCanCreateAMenuItem(): void
    {
        $menuItem = Menu::factory()->for($this->restaurant)->raw();

        $this->withToken(JWTAuth::fromUser($this->restaurant))
            ->postJson($this->url, $menuItem)
            ->assertCreated()
            ->assertJsonFragment([
                'status' => true,
                'message' => 'Menu item created successfully',
            ]);
    }

    public function testRestaurantCannotCreateAMenuItemWithInvalidData(): void
    {
        $menuItem = Menu::factory()->for($this->restaurant)->raw();

        $invalidData = array_fill_keys(array_keys($menuItem), '');

        $response = $this->withToken(JWTAuth::fromUser($this->restaurant))
            ->postJson($this->url, $invalidData);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors([
                'name', 'description', 'price', 'quantity', 'is_available'
            ]);
    }

    public function testRestaurantCanUpdateAMenuItem(): void
    {
        $menuItem = Menu::factory()->for($this->restaurant)->create();

        $updatedMenuItem = [
            'name' => 'Updated menu item name',
            'description' => 'Updated menu item description',
            'price' => 105,
            'quantity' => 1000,
            'is_available' => true,
        ];

        $this->withToken(JWTAuth::fromUser($this->restaurant))
            ->put($this->url . '/'. $menuItem->ulid, $updatedMenuItem)
            ->assertOk()
            ->assertJsonFragment([
                'status' => true,
                'message' => 'Menu item updated successfully',
            ]);
    }

    public function testRestaurantCanDeleteAMenuItem(): void
    {
        $menuItem = Menu::factory()->for($this->restaurant)->create();

        $this->withToken(JWTAuth::fromUser($this->restaurant))
            ->delete($this->url . '/'. $menuItem->ulid)
            ->assertOk()
            ->assertJsonFragment([
                'status' => true,
                'message' => 'Menu item deleted successfully',
            ]);
    }

    public function testRestaurantCanListMenuItems(): void
    {
        Menu::factory()->count(10)->for($this->restaurant)->create();

        $this->withToken(JWTAuth::fromUser($this->restaurant))
            ->get($this->url)
            ->assertOk()
            ->assertJsonFragment([
                'status' => true,
                'message' => 'Menu items retrieved successfully',
            ]);
    }

    public function testRestaurantCanPaginateMenuItems(): void
    {
        Menu::factory()->count(30)->for($this->restaurant)->create();

        $this->withToken(JWTAuth::fromUser($this->restaurant))
            ->get($this->url . '?perPage=25')
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'current_page',
                    'data',
                    'links',
                    'per_page',
                ],
            ])->assertJsonFragment([
                'status' => true,
                'message' => 'Menu items retrieved successfully',
            ]);
    }
}
