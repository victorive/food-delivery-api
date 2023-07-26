<?php

namespace Tests\Feature\V1\Admin\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function testAdminHasBeCreated()
    {
        $this->assertDatabaseHas('admins', [
            'name' => 'Admin',
            'email' => 'admin@admin.com',
        ]);
    }
}
