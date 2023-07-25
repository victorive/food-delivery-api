<?php

namespace Tests\Feature\V1\Customer\Auth;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class LogoutTest extends TestCase
{
    private string $url = 'api/v1/customer/logout';

    private $customer;

    protected function setUp(): void
    {
        parent::setUp();

        $this->customer = Customer::factory()->create();
    }

    public function testCustomerCanLogout(): void
    {
        $this->withToken(JWTAuth::fromUser($this->customer))
            ->post($this->url)
            ->assertOk()
            ->assertJsonFragment([
                'status' => true,
                'message' => 'Logout successful',
            ]);
    }
}
