<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(): View
    {
        $books = Book::visible()
            ->with(['authors'])
            ->withCount(['chapters'])
            ->orderBy('title')
            ->get();

        return view('books.index', compact('books'));
    }

    public function show(Book $book): View
    {
        if ($book->is_hidden && !auth()->check()) {
            abort(403);
        }
        $book->load(['authors', 'chapters' => fn($q) => $q->orderBy('order')]);
        return view('books.show', compact('book'));
    }
}
