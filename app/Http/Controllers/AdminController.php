<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard with site statistics.
     */
    public function index(): View
    {
        $stats = [
            'books_count'    => Book::query()->count(),
            'articles_count' => Article::query()->count(),
            'authors_count'  => Author::query()->count(),
            'categories_count' => Category::query()->count(),
            'tags_count' => Tag::query()->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
