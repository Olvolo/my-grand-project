<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\View\View;

class AuthorController extends Controller
{
    /**
     * Display a listing of all authors.
     */
    public function index(): View
    {
        $authors = Author::query()
            ->with('articles')
            ->withCount(['books'])
            ->orderBy('name')
            ->get();

        return view('authors.index', compact('authors'));
    }

    /**
     * Display the author's main hub/gateway page.
     */
    public function show(Author $author): View
    {
        return view('authors.show', compact('author'));
    }

    /**
     * Display the author's biography page.
     */
    public function showBio(Author $author): View
    {
        return view('authors.bio', compact('author'));
    }

    /**
     * Display a list of the author's books.
     */
    public function showBooks(Author $author): View
    {
        // Оборачиваем scope в замыкание
        $books = $author->books()
            ->where(function ($query) {
                $query->visible();
            })
            ->orderBy('publication_year')
            ->paginate(15);

        return view('authors.books', compact('author', 'books'));
    }

    /**
     * Display a list of the author's articles.
     */
    public function showArticles(Author $author): View
    {
        // Оборачиваем scope в замыкание
        $articles = $author->articles()
            ->where(function ($query) {
                $query->visible();
            })
            ->orderBy('published_at', 'desc')
            ->paginate(15);

        return view('authors.articles', compact('author', 'articles'));
    }
}
