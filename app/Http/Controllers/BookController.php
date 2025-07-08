<?php

namespace App\Http\Controllers;

use App\Models\Book; // Импортируем модель Book
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the books.
     */
    public function index()
    {
        // По умолчанию показываем только НЕ скрытые книги
        $books = Book::where('is_hidden', false)
            ->orderBy('title')
            ->with(['authors'])
            ->withCount(['chapters']);

        // Если пользователь авторизован, добавляем скрытые книги в выборку
        if (Auth::check()) {
            $books->orWhere('is_hidden', true);
        }

        $books = $books->get(); // Выполняем запрос

        return view('books.index', compact('books'));
    }

    /**
     * Display the specified book (Table of Contents).
     */
    public function show(Book $book)
    {
        // Если книга скрыта И пользователь НЕ авторизован, перенаправляем на страницу входа
        if ($book->is_hidden && !Auth::check()) {
            return redirect()->route('login'); // Или abort(403) для ошибки доступа
        }
        $book->load(['authors', 'chapters']);

        // TODO: Покажем оглавление книги на странице 'books.show'
        // return view('books.show', compact('book'));

        // Для начала, просто выведем информацию о книге и её главах для проверки
        $output = "<h1>Книга: {$book->title}</h1>";
        if ($book->description) {
            $output .= "<p>Описание: " . strip_tags($book->description) . "</p>"; // strip_tags, т.к. описание в HTML
        }
        $output .= "<p>Год публикации: " . ($book->publication_year ?? 'Не указан') . "</p>";

        if ($book->authors->isNotEmpty()) {
            $authorNames = $book->authors->pluck('name')->implode(', ');
            $output .= "<p>Авторы: {$authorNames}</p>";
        }

        if ($book->chapters->isNotEmpty()) {
            $output .= "<h2>Оглавление:</h2><ul>";
            foreach ($book->chapters as $chapter) {
                // Ссылка на главу будет выглядеть как /books/{book_slug}/{chapter_slug}
                $output .= "<li><a href=\"/books/{$book->slug}/{$chapter->slug}\">{$chapter->order}. {$chapter->title}</a></li>";
            }
            $output .= "</ul>";
        } else {
            $output .= "<p>В этой книге пока нет глав.</p>";
        }

        return view('books.show', compact('book'));
    }
}
