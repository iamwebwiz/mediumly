<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminLoginTest extends TestCase
{
    use RefreshDatabase;

    public function testAdminLogin()
    {
        $admin = factory(User::class)->states('admin')->create();

        $response = $this->actingAs($admin)->get('/admin');

        $response->assertStatus(200);

        $this->assertAuthenticatedAs($admin);
    }
}
