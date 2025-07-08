<?php

namespace App\Http\Controllers;

use App\Models\Category; // Импортируем модель Category
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Для проверки авторизации

class CategoryController extends Controller
{
    /**
     * Display the specified category and its articles.
     */
    public function show(Category $category)
    {
        // Жадная загрузка статей, связанных с этой категорией
        // Фильтрация статей по is_hidden:
        // - если пользователь не авторизован, показываем только нескрытые
        // - если авторизован, показываем все
        $articlesQuery = $category->articles()->orderBy('published_at', 'desc');

        if (!Auth::check()) {
            $articlesQuery->where('is_hidden', false);
        }

        $articles = $articlesQuery->with('authors')->get(); // Загружаем авторов для отображения

        return view('categories.show', compact('category', 'articles'));
    }
}
