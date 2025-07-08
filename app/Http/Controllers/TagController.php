<?php

namespace App\Http\Controllers;

use App\Models\Tag; // Импортируем модель Tag
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Для проверки авторизации

class TagController extends Controller
{
    /**
     * Display the specified tag and its articles.
     */
    public function show(Tag $tag)
    {
        // Жадная загрузка статей, связанных с этим тегом
        // Фильтрация статей по is_hidden:
        // - если пользователь не авторизован, показываем только нескрытые
        // - если авторизован, показываем все
        $articlesQuery = $tag->articles()->orderBy('published_at', 'desc');

        if (!Auth::check()) {
            $articlesQuery->where('is_hidden', false);
        }

        $articles = $articlesQuery->with('authors')->get(); // Загружаем авторов для отображения

        return view('tags.show', compact('tag', 'articles'));
    }
}
