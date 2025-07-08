<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth; // Импортируем фасад Auth

class SearchController extends Controller
{
    /**
     * Handle the search request.
     */
    public function index(Request $request)
    {
        $query = $request->input('query');
        $articles = collect();
        $chapters = collect();

        if ($query) {
            $searchTerm = '%' . $query . '%';

            // Базовый запрос для статей (только НЕ скрытые)
            $articlesQuery = Article::where('title', 'LIKE', $searchTerm)
                ->orWhere('content', 'LIKE', $searchTerm);

            // Если пользователь авторизован, расширяем поиск на скрытые статьи
            if (!Auth::check()) {
                $articlesQuery->where('is_hidden', false);
            }
            $articles = $articlesQuery->with('authors')->get();

            // Базовый запрос для глав (только НЕ скрытые)
            $chaptersQuery = Chapter::where('title', 'LIKE', $searchTerm)
                ->orWhere('content', 'LIKE', $searchTerm)
                ->with('book'); // Загружаем связанную книгу

            // Расширяем поиск на скрытые главы/книги, если пользователь авторизован
            if (!Auth::check()) {
                $chaptersQuery->where('is_hidden', false)
                    ->whereHas('book', function ($query) {
                        $query->where('is_hidden', false);
                    });
            }
            $chapters = $chaptersQuery->get();
        }

        return view('search.index', compact('query', 'articles', 'chapters'));
    }
}
