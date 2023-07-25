<?php

namespace Tests\Feature\V1\DeliveryAgent\Auth;

use App\Models\DeliveryAgent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class LogoutTest extends TestCase
{
    private string $url = 'api/v1/delivery-agent/logout';

    private $deliveryAgent;

    protected function setUp(): void
    {
        parent::setUp();

        $this->deliveryAgent = DeliveryAgent::factory()->create();
    }

    public function testDeliveryAgentCanLogout(): void
    {
        $this->withToken(JWTAuth::fromUser($this->deliveryAgent))
            ->post($this->url)
            ->assertOk()
            ->assertJsonFragment([
                'status' => true,
                'message' => 'Logout successful',
            ]);
    }
}
