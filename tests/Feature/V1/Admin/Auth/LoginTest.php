<?php

namespace Tests\Feature\V1\Admin\Auth;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    private $admin;

    private string $url = 'api/v1/admin/login';

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = Admin::query()->first();
    }

    public function testAdminCanLoginWithValidCredentials()
    {
        $response = $this->withHeader('Accept', 'application/json')
            ->postJson($this->url, [
                'email' => $this->admin->email,
                'password' => 'password'
            ]);

        $response->assertOk()
            ->assertJsonStructure([
                'status',
                'access_token'
            ]);
    }

    public function testAdminCannotLoginWithInvalidCredentials()
    {
        $response = $this->withHeader('Accept', 'application/json')
            ->postJson($this->url, [
                'email' => $this->admin->email,
                'password' => ''
            ]);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors('password');
    }
}
