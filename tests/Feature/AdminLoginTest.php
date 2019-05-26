<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{
    use RefreshDatabase;

    public function testAdminLogin()
    {
        $admin = factory(User::class)->states('admin')->create();

        $response = $this->actingAs($admin)->get('/admin');

        $response->assertSuccessful();

        $this->assertAuthenticatedAs($admin);
    }
}
