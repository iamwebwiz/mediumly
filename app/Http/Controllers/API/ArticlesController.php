<?php

namespace App\Http\Controllers\API;

use App\Article;
use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::with(['tags', 'featuredImage'])
            ->orderBy('created_at', 'DESC')
            ->get();

        return response()->json($articles, 200);
    }

    public function show($articleId)
    {
        $article = Article::with(['tags', 'featuredImage', 'author'])->whereId($articleId)->first();

        return response()->json($article, 200);
    }
}
