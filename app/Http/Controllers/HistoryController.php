<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class HistoryController extends Controller
{
    public function index(): View
    {
        // Укажите здесь слаги категорий, относящихся к истории
        $categorySlugs = ['istoriya-buddizma', 'drugaya-istoricheskaya-kategoriya'];

        $categories = Category::query()
            ->whereIn('slug', $categorySlugs)
            ->with(['articles' => fn($q) => $q->visible()->orderBy('order_column')])
            ->get();

        return view('history.index', compact('categories'));
    }
}
