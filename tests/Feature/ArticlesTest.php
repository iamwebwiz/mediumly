<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticlesTest extends TestCase
{
    use RefreshDatabase;

    public function authenticateAdmin()
    {
        return factory(User::class)->states('admin')->create();
    }

    public function articlesPage()
    {
        return route('admin.articles.index');
    }

    public function newArticlePage()
    {
        return route('admin.articles.create');
    }

    public function testShowArticles()
    {
        $admin = $this->authenticateAdmin();

        $response = $this->actingAs($admin)->get($this->articlesPage());

        $response->assertViewHas('articles');

        $response->assertStatus(200);
    }
}
