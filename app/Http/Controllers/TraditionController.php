<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use Illuminate\View\View;

class TraditionController extends Controller
{
    public function index(): View
    {
        // Находим учителей и сортируем их по нашему новому полю
        $teachers = Author::query()
            ->where('is_teacher', true)
            ->orderBy('order_column')
            ->get();

        // Находим категорию "Традиция"
        $traditionCategory = Category::query()->where('slug', 'traditsiya')->first();

        // Загружаем статьи из этой категории, если она существует, и сортируем
        $articles = $traditionCategory
            ? $traditionCategory->articles()->visible()->orderBy('order_column')->get()
            : collect();

        return view('tradition.index', compact('teachers', 'articles', 'traditionCategory'));
    }
}
