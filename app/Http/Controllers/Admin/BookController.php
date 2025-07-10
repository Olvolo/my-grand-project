<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class BookController extends Controller
{
    // ... метод index ...
    public function index(): View
    {
        $books = Book::query()
            ->with('authors')
            ->withCount('chapters')
            ->orderBy('title')
            ->paginate(15);

        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for editing the specified book.
     */
    public function edit(Book $book): View
    {
        // Добавляем ::query()
        $authors = Author::query()->orderBy('name')->get();

        return view('admin.books.edit', compact('book', 'authors'));
    }

    /**
     * Update the specified book in storage.
     */
    public function update(Request $request, Book $book): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
            'publication_year' => 'nullable|digits:4',
            'publisher' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:10',
            'is_hidden' => 'nullable|boolean',
        ]);

        $book->update([
            'title' => $validated['title'],
            'publication_year' => $validated['publication_year'],
            'publisher' => $validated['publisher'],
            'language' => $validated['language'],
            'is_hidden' => $request->has('is_hidden'),
        ]);

        $book->authors()->sync($validated['authors']);

        return redirect()->route('admin.books.index')->with('success', 'Книга успешно обновлена!');
    }

    /**
     * Show the form for creating a new book.
     */
    public function create(): View
    {
        $authors = Author::query()->orderBy('name')->get();
        return view('admin.books.create', compact('authors'));
    }

    /**
     * Store a newly created book in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:books,title',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
            'publication_year' => 'nullable|digits:4',
            'publisher' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:10',
            'is_hidden' => 'nullable|boolean',
        ]);

        $book = Book::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'publication_year' => $validated['publication_year'],
            'publisher' => $validated['publisher'],
            'language' => $validated['language'],
            'is_hidden' => $request->has('is_hidden'),
        ]);

        $book->authors()->sync($validated['authors']);

        return redirect()->route('admin.books.index')->with('success', 'Книга успешно создана!');
    }

    public function destroy(Book $book): RedirectResponse
    {
        // При удалении книги, Laravel автоматически удалит связанные записи
        // в таблице `book_author` благодаря настройкам внешних ключей.
        // Однако, ГЛАВЫ останутся "сиротами". Правильнее удалить их вручную.
        $book->chapters()->delete(); // Удаляем все главы этой книги
        $book->authors()->detach(); // Отвязываем авторов
        $book->delete(); // Удаляем саму книгу

        return redirect()->route('admin.books.index')->with('success', 'Книга и все её главы успешно удалены!');
    }

    public function manage(Book $book): View
    {
        // Загружаем книгу с её главами, отсортированными по порядку
        $book->load('chapters');
        return view('admin.books.manage', compact('book'));
    }
}
