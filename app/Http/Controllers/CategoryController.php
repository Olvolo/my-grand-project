<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function show(Category $category): View
    {
        $articles = $category->articles()
            ->with(['authors', 'tags'])
            ->orderBy('published_at', 'desc')
            ->where(function ($query) {
                $query->visible();
            })
            ->paginate(9);

        return view('categories.show', compact('category', 'articles'));
    }
}
