<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\View\View;

class ArticleController extends Controller
{
    /**
     * Display a listing of the articles.
     */
    public function index(): View
    {
        $articles = Article::visible()
        ->with(['authors', 'category', 'tags'])
            ->orderBy('published_at', 'desc')
            ->paginate(12); // Добавим пагинацию

        return view('articles.index', compact('articles'));
    }
    /**
     * Display the specified article.
     */
    public function show(Article $article): View
    {
        if ($article->is_hidden && !auth()->check()) {
            abort(403);
        }
        $article->load(['authors', 'tags', 'category']);
        return view('articles.show', [
            'article' => $article,
        ]);
    }
}
