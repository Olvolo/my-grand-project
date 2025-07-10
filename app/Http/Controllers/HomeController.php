<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Book;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the application's homepage.
     */
    public function index(): View
    {
        // Получаем 3 последние видимые статьи
        $latestArticles = Article::visible()
            ->with('authors')
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        // Получаем 3 последние видимые книги
        $latestBooks = Book::visible()
            ->with('authors')
            ->orderBy('created_at', 'desc') // или по 'publication_year'
            ->limit(3)
            ->get();

        return view('welcome', [
            'latestArticles' => $latestArticles,
            'latestBooks' => $latestBooks,
        ]);
    }
}
