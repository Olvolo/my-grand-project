<?php

namespace App\Http\Controllers;

use App\Models\Book;    // Импортируем модель Book
use App\Models\Chapter; // Импортируем модель Chapter
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChapterController extends Controller
{
    /**
     * Display the specified chapter.
     */
    public function show(Book $book, Chapter $chapter)
    {
        // Благодаря Route Model Binding (/{book:slug}/{chapter:slug} в роуте),
        // Laravel автоматически найдет книгу по ее slug и главу по ее slug.

        // Дополнительная проверка, что глава действительно принадлежит этой книге.
        // Это важно для безопасности и корректности URL.
        if ($chapter->book_id !== $book->id) {
            abort(404, 'Chapter not found in this book.');
        }
        // Если глава или ее родительская книга скрыты И пользователь НЕ авторизован, перенаправляем
        if (($chapter->is_hidden || $book->is_hidden) && !Auth::check()) {
            return redirect()->route('login'); // Или abort(403)
        }
        // Получаем следующую и предыдущую главу для навигации
        $nextChapter = $chapter->nextChapter();
        $previousChapter = $chapter->previousChapter();

        // TODO: Покажем содержимое главы на странице 'chapters.show'
        // return view('chapters.show', compact('book', 'chapter', 'nextChapter', 'previousChapter'));

        // Для начала, просто выведем информацию о главе для проверки
        $output = "<h1>Книга: <a href=\"/books/{$book->slug}\">{$book->title}</a></h1>";
        $output .= "<h2>Глава: {$chapter->order}. {$chapter->title}</h2>";
        $output .= "<hr>";
        $output .= "<div>" . $chapter->content . "</div>"; // Содержимое главы уже в HTML

        $output .= "<hr>";
        $output .= "<div>";
        if ($previousChapter) {
            $output .= "<a href=\"/books/{$book->slug}/{$previousChapter->slug}\">← Предыдущая глава: {$previousChapter->title}</a>";
        }
        if ($nextChapter) {
            $output .= " | <a href=\"/books/{$book->slug}/{$nextChapter->slug}\">Следующая глава: {$nextChapter->title} →</a>";
        }
        $output .= "</div>";

// Получаем все главы этой книги, они уже отсортированы благодаря orderBy('order') в модели Book.
        $allChapters = $book->chapters;

        return view('chapters.show', compact('book', 'chapter', 'nextChapter', 'previousChapter', 'allChapters'));    }
}
