<?php

namespace Tests\Feature\V1\DeliveryAgent\Auth;

use App\Models\DeliveryAgent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    private $deliveryAgent;

    private string $url = 'api/v1/delivery-agent/login';

    protected function setUp(): void
    {
        parent::setUp();

        $this->deliveryAgent = DeliveryAgent::factory()->create();
    }

    public function testDeliveryAgentCanLoginWithValidCredentials()
    {
        $response = $this->withHeader('Accept', 'application/json')
            ->postJson($this->url, [
                'email' => $this->deliveryAgent->email,
                'password' => 'password'
            ]);

        $response->assertOk()
            ->assertJsonFragment([
                'status' => true,
                'access_token' => $response->json('access_token'),
            ]);
    }

    public function testDeliveryAgentCannotLoginWithInvalidCredentials()
    {
        $response = $this->withHeader('Accept', 'application/json')
            ->postJson($this->url, [
                'email' => $this->deliveryAgent->email,
                'password' => ''
            ]);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors('password');
    }
}
