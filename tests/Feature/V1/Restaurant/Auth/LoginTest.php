<?php

namespace Tests\Feature\V1\Restaurant\Auth;

use App\Models\Restaurant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    private $restaurant;

    private string $url = 'api/v1/restaurant/login';

    protected function setUp(): void
    {
        parent::setUp();

        $this->restaurant = Restaurant::factory()->create();
    }

    public function testRestaurantCanLoginWithValidCredentials()
    {
        $response = $this->withHeader('Accept', 'application/json')
            ->postJson($this->url, [
                'email' => $this->restaurant->email,
                'password' => 'password'
            ]);

        $response->assertOk()
            ->assertJsonFragment([
                'status' => true,
                'access_token' => $response->json('access_token'),
            ]);
    }

    public function testRestaurantCannotLoginWithInvalidCredentials()
    {
        $response = $this->withHeader('Accept', 'application/json')
            ->postJson($this->url, [
                'email' => $this->restaurant->email,
                'password' => ''
            ]);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors('password');
    }
}
