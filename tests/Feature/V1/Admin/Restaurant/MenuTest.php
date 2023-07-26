<?php

namespace Tests\Feature\V1\Admin\Restaurant;

use App\Models\Admin;
use App\Models\Menu;
use App\Models\Restaurant;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class MenuTest extends TestCase
{
    private string $url = 'api/v1/admin/restaurants';

    private $admin;

    private $restaurant;

    protected function setUp(): void
    {
        parent::setUp();

        $this->restaurant = Restaurant::factory()->create();

        $this->admin = Admin::query()->first();
    }

    public function testAdminCanCreateAMenuItemForARestaurant(): void
    {
        $menuItem = Menu::factory()->for($this->restaurant)->raw();

        $this->withToken(JWTAuth::fromUser($this->admin))
            ->postJson($this->url . '/' . $this->restaurant->ulid . '/menus', $menuItem)
            ->assertCreated()
            ->assertJsonFragment([
                'status' => true,
                'message' => 'Menu item created successfully',
            ]);
    }

    public function testAdminCanUpdateAMenuItemForARestaurant(): void
    {
        $menuItem = Menu::factory()->for($this->restaurant)->create();

        $updatedMenuItem = [
            'name' => 'Updated menu item name',
            'description' => 'Updated menu item description',
            'price' => 105,
            'quantity' => 1000,
            'is_available' => true,
        ];

        $this->withToken(JWTAuth::fromUser($this->admin))
            ->put($this->url . '/' . $this->restaurant->ulid . '/menus' . '/' . $menuItem->ulid, $updatedMenuItem)
            ->assertOk()
            ->assertJsonFragment([
                'status' => true,
                'message' => 'Menu item updated successfully',
            ]);
    }

    public function testAdminCanDeleteAMenuItemForARestaurant(): void
    {
        $menuItem = Menu::factory()->for($this->restaurant)->create();

        $this->withToken(JWTAuth::fromUser($this->admin))
            ->delete($this->url . '/' . $this->restaurant->ulid . '/menus' . '/' . $menuItem->ulid)
            ->assertOk()
            ->assertJsonFragment([
                'status' => true,
                'message' => 'Menu item deleted successfully',
            ]);
    }
}
