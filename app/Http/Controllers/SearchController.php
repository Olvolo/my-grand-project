<?php
//
//namespace App\Http\Controllers;
//
//use Illuminate\Http\Request;
//use App\Models\Article;
//use App\Models\Chapter;
//use Illuminate\View\View;
//
//class SearchController extends Controller
//{
//    public function index(Request $request): View
//    {
//        $request->validate([
//            'query' => 'nullable|string|max:255',
//        ]);
//
//        $query = $request->input('query');
//        $articles = collect();
//        $chapters = collect();
//
//        if ($query && strlen(trim($query)) > 0) {
//            $searchTerm = '%' . $query . '%';
//
//            // Поиск по статьям
//            $articles = Article::visible()
//                ->where(function ($q) use ($searchTerm) {
//                    $q->where('title', 'LIKE', $searchTerm)
//                        ->orWhere('content', 'LIKE', $searchTerm);
//                })
//                ->with('authors')
//                ->get();
//
//            // Поиск по главам
//            $chapters = Chapter::visible()
//                ->where(function ($q) use ($searchTerm) {
//                    $q->where('title', 'LIKE', $searchTerm)
//                        ->orWhere('content', 'LIKE', $searchTerm);
//                })
//                ->whereHas('book', fn($q) => $q->visible())
//                ->with('book')
//                ->get();
//        }
//
//        return view('search.index', compact('query', 'articles', 'chapters'));
//    }
//}


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Chapter;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function index(Request $request): View
    {
        $request->validate([
            'query' => 'nullable|string|max:255',
        ]);

        $query = $request->input('query');
        $articles = collect();
        $chapters = collect();

        if ($query) {
            // Вот и вся магия: вместо сложного запроса - один метод search()
            $articles = Article::search($query)->get();
            $chapters = Chapter::search($query)->get();

            // Теперь, когда мы получили результаты из MeiliSearch,
            // мы можем отфильтровать их для неавторизованных пользователей.
            if (!auth()->check()) {
                $articles = $articles->where('is_hidden', false);

                // Для глав проверяем и саму главу, и ее родительскую книгу
                $chapters = $chapters->filter(function ($chapter) {
                    return !$chapter->is_hidden && !$chapter->book->is_hidden;
                });
            }
        }

        return view('search.index', compact('query', 'articles', 'chapters'));
    }
}
