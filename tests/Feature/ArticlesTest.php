<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ArticlesTest extends TestCase
{
    use RefreshDatabase;

    public function authenticatedAdmin()
    {
        return factory(User::class)->states('admin')->create();
    }

    public function articlesRoute()
    {
        return route('admin.articles.index');
    }

    public function newArticleRoute()
    {
        return route('admin.articles.create');
    }

    public function storeArticleRoute()
    {
        return route('admin.articles.store');
    }

    public function testShowArticles()
    {
        $response = $this->actingAs($this->authenticatedAdmin())
            ->get($this->articlesRoute());

        $response->assertViewIs('admin.articles.index');

        $response->assertViewHas('articles');

        $response->assertSuccessful();
    }

    public function testShowNewArticlePage()
    {
        $response = $this->actingAs($this->authenticatedAdmin())
            ->get($this->newArticleRoute());

        $response->assertViewIs('admin.articles.create');

        $response->assertViewHas('tags');

        $response->assertSuccessful();
    }

    public function testStoreNewArticle()
    {
        $this->actingAs($this->authenticatedAdmin())
            ->get($this->newArticleRoute());

        $file = UploadedFile::fake()->image('image.png');

        $response = $this->post($this->storeArticleRoute(), [
            'title' => 'Test title',
            'content' => 'Test content',
            'user_id' => $this->authenticatedAdmin()->id,
            'tags' => ['hello', 'fuck', 'shit'],
            'featured_image' => $file,
        ]);

        $response->assertSessionHas('success');
    }
}
