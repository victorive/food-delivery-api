<?php

namespace Tests\Feature\V1\Admin\Auth;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class LogoutTest extends TestCase
{
    private string $url = 'api/v1/admin/logout';

    private $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = Admin::query()->first();
    }

    public function testAdminCanLogout(): void
    {
        $this->withToken(JWTAuth::fromUser($this->admin))
            ->post($this->url)
            ->assertOk()
            ->assertJsonFragment([
                'status' => true,
                'message' => 'Logout successful',
            ]);
    }
}
