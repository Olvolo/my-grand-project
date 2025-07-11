<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeachingController extends Controller
{
    public function index(): View
    {
        // Укажите здесь слаги тех категорий, которые вы хотите видеть на этой странице
        $categorySlugs = ['filosofiya', 'sutra', 'tantra']; // Например: 'философия', 'сутра', 'тантра'

        $categories = Category::query()
            ->whereIn('slug', $categorySlugs)
            ->with(['articles' => function ($query) {
                // Для каждой категории загружаем только видимые статьи и сортируем их
                $query->visible()->orderBy('order_column');
            }])
            ->get();

        return view('teaching.index', compact('categories'));
    }
}
