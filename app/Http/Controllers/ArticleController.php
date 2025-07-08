<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the articles.
     */
    public function index()
    {
        // По умолчанию показываем только НЕ скрытые статьи
        $articles = Article::where('is_hidden', false)
            ->orderBy('published_at', 'desc')
            ->with(['authors', 'category', 'tags']); // <-- ДОБАВЛЕНО: 'category', 'tags'

        // Если пользователь авторизован, добавляем скрытые статьи в выборку
        if (Auth::check()) {
            $articles->orWhere('is_hidden', true);
        }

        $articles = $articles->get();

        return view('articles.index', compact('articles'));
    }

    /**
     * Display the specified article.
     */
    public function show(Article $article)
    {
        if ($article->is_hidden && !Auth::check()) {
            return redirect()->route('login'); // Или abort(403) для ошибки доступа
        }

        $article->load(['authors', 'category', 'tags']);

        // TODO: Покажем содержимое статьи на странице 'articles.show'
        // return view('articles.show', compact('article'));

        // Для начала, просто выведем информацию о статье для проверки
        $output = "<h1>Статья: {$article->title}</h1>";
        $output .= "<p>Опубликовано: " . ($article->published_at ? $article->published_at->format('d.m.Y') : 'Дата не указана') . "</p>";

        if ($article->authors->isNotEmpty()) {
            $authorNames = $article->authors->pluck('name')->implode(', ');
            $output .= "<p>Авторы: {$authorNames}</p>";
        }

        $output .= "<hr>";
        $output .= "<div>" . $article->content . "</div>"; // Содержимое статьи уже в HTML

        return view('articles.show', compact('article'));
    }
}
