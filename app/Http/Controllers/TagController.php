<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\View\View;

class TagController extends Controller
{
    public function show(Tag $tag): View
    {
        $articles = $tag->articles()
            ->with(['authors', 'category'])
            ->orderBy('published_at', 'desc')
            ->where(function ($query) { // <-- Начинаем обёртку
                $query->visible();      // <-- Применяем scope здесь
            })                          // <-- Завершаем обёртку
            ->paginate(9);

        return view('tags.show', compact('tag', 'articles'));
    }
}
