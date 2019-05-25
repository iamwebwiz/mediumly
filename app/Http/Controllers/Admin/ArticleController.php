<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\FeaturedImage;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticle;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('admin.articles.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticle $request)
    {
        $validator = $request->validated();

        $article = Article::create([
            'title' => $validator['title'],
            'content' => $validator['content'],
            'user_id' => Auth::id(),
        ]);

        $tags = collect($request->tags);

        $attachableTags = collect([]);

        $tags->each(function ($tag) use ($attachableTags) {
            $attachableTags->push(Tag::firstOrCreate(['name' => strtolower($tag)])->id);
        });

        $article->tags()->attach($attachableTags);

        // Handle image upload
        $path = Storage::putFileAs(
            'featured_images',
            $request->file('featured_image'),
            sha1($article->title) . '.' . $request->file('featured_image')->getClientOriginalExtension()
        );

        $featuredImage = new FeaturedImage;
        $featuredImage->image = $path;

        $article->featuredImage()->save($featuredImage);

        session()->flash('success', 'Article created.');
        return redirect()->route('admin.articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();

        session()->flash('info', 'Article has been deleted.');
        return redirect()->back();
    }
}
