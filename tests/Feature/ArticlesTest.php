<?php

namespace Tests\Feature;

use App\User;
use App\Article;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticlesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function authenticatedAdmin(): User
    {
        return factory(User::class)->states('admin')->create();
    }

    public function articlesRoute(): string
    {
        return route('admin.articles.index');
    }

    public function newArticleRoute(): string
    {
        return route('admin.articles.create');
    }

    public function storeArticleRoute(): string
    {
        return route('admin.articles.store');
    }

    public function showArticleRoute(Article $article): string
    {
        return route('admin.articles.show', $article);
    }

    public function editArticleRoute(Article $article): string
    {
        return route('admin.articles.edit', $article);
    }

    public function updateArticleRoute(Article $article): string
    {
        return route('admin.articles.update', $article);
    }

    public function deleteArticleRoute(Article $article): string
    {
        return route('admin.articles.destroy', $article);
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

    public function postNewArticle()
    {
        $file = UploadedFile::fake()->image('image.png');

        return $this->post($this->storeArticleRoute(), [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'user_id' => $this->authenticatedAdmin()->id,
            'tags' => $this->faker->words,
            'featured_image' => $file,
        ]);
    }

    public function testStoreNewArticle()
    {
        $this->actingAs($this->authenticatedAdmin())
            ->get($this->newArticleRoute());

        $response = $this->postNewArticle();

        $response->assertSessionHas('success');

        $response->assertRedirect($this->articlesRoute());
    }

    public function getLatestArticle(): Article
    {
        return Article::latest()->first();
    }

    public function testShowSingleArticle()
    {
        $this->actingAs($this->authenticatedAdmin());

        $this->postNewArticle();

        $article = $this->getLatestArticle();

        $response = $this->get($this->showArticleRoute($article));

        $response->assertViewHas('article');

        $response->assertViewIs('admin.articles.show');

        $response->assertSuccessful();
    }

    public function testUpdateArticle()
    {
        $this->actingAs($this->authenticatedAdmin());

        $this->postNewArticle();

        $article = $this->getLatestArticle();

        $this->get($this->editArticleRoute($article))
            ->assertViewIs('admin.articles.edit')
            ->assertViewHas('article')
            ->assertStatus(200);

        $response = $this->put($this->updateArticleRoute($article), [
            'title' => 'Updated title',
            'content' => 'Updated content',
        ]);

        $response->assertSessionHas('success');

        $response->assertRedirect($this->articlesRoute());
    }

    public function testDeleteArticle()
    {
        $this->actingAs($this->authenticatedAdmin());

        $this->postNewArticle();

        $article = $this->getLatestArticle();

        $response = $this->delete($this->deleteArticleRoute($article));

        $response->assertSessionHas('info');
    }
}
