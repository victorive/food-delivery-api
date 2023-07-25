<?php

namespace Tests\Feature\V1\Customer\Auth;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    private $customer;

    private string $url = 'api/v1/customer/login';

    protected function setUp(): void
    {
        parent::setUp();

        $this->customer = Customer::factory()->create();
    }

    public function testCustomerCanLoginWithValidCredentials()
    {
        $response = $this->withHeader('Accept', 'application/json')
            ->postJson($this->url, [
                'email' => $this->customer->email,
                'password' => 'password'
            ]);

        $response->assertOk()
            ->assertJsonFragment([
                'status' => true,
                'access_token' => $response->json('access_token'),
            ]);
    }

    public function testCustomerCannotLoginWithInvalidCredentials()
    {
        $response = $this->withHeader('Accept', 'application/json')
            ->postJson($this->url, [
                'email' => $this->customer->email,
                'password' => ''
            ]);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors('password');
    }
}
