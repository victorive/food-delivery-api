<?php

namespace Tests\Feature\V1\Restaurant\Auth;

use App\Models\Restaurant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class LogoutTest extends TestCase
{
    private string $url = 'api/v1/restaurant/logout';

    private $restaurant;

    protected function setUp(): void
    {
        parent::setUp();

        $this->restaurant = Restaurant::factory()->create();
    }

    public function testRestaurantCanLogout(): void
    {
        $this->withToken(JWTAuth::fromUser($this->restaurant))
            ->post($this->url)
            ->assertOk()
            ->assertJsonFragment([
                'status' => true,
                'message' => 'Logout successful',
            ]);
    }
}
