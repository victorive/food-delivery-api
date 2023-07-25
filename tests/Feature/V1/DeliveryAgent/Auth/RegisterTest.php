<?php

namespace Tests\Feature\V1\DeliveryAgent\Auth;

use App\Models\DeliveryAgent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    private array $registrationData;

    private string $url = 'api/v1/delivery-agent/register';

    protected function setUp(): void
    {
        parent::setUp();

        $this->registrationData = DeliveryAgent::factory()->raw();
    }

    public function testDeliveryAgentCanRegisterWithValidCredentials()
    {
        $response = $this->withHeader('Accept', 'application/json')
            ->postJson($this->url, $this->registrationData);

        $response->assertCreated()
            ->assertJsonFragment([
                'status' => true,
                'access_token' => $response->json('access_token'),
            ]);
    }

    public function testDeliveryAgentCannotRegisterWithInvalidCredentials()
    {
        $invalidCredentials = array_fill_keys(array_keys($this->registrationData), '');

        $response = $this->withHeader('Accept', 'application/json')
            ->postJson($this->url, $invalidCredentials);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors([
                'name', 'email', 'password', 'phone', 'address', 'country_id', 'state_id', 'city_id'
            ]);
    }
}
