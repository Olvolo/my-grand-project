<?php

namespace App\Http\Controllers;

use App\Models\Author; // Импортируем модель Author
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the authors.
     */
    public function index()
    {
        // Получаем всех авторов, сортируем по имени
        // Можно добавить пагинацию, если авторов будет очень много: ->paginate(15)
        $authors = Author::orderBy('name')->get();

        // TODO: Покажем всех авторов на странице 'authors.index'
        // return view('authors.index', compact('authors'));

        // Получаем всех авторов, сортируем по имени
// Жадная загрузка книг и статей для отображения их количества
        $authors = Author::orderBy('name')
            ->withCount(['books', 'articles']) // Добавляем подсчет связанных записей
            ->get();

        return view('authors.index', compact('authors'));
    }

    /**
     * Display the specified author.
     */
    public function show(Author $author)
    {
        // Благодаря Route Model Binding (/{author:slug} в роуте),
        // Laravel автоматически найдет автора по его slug и передаст сюда готовый объект $author.

        // Загружаем книги и статьи автора
        // Используем with() для жадной загрузки отношений, чтобы избежать N+1 проблемы
        $author->load(['books.chapters', 'articles']);

        // Для Учителя можем добавить проверку и вывести дополнительную информацию
        if ($author->is_teacher) {
            $teacherInfo = "Это страница Учителя!";
        } else {
            $teacherInfo = "";
        }

        // TODO: Покажем детальный профиль автора на странице 'authors.show'
        // return view('authors.show', compact('author', 'teacherInfo'));

        // Для начала, просто выведем информацию об авторе для проверки
        $output = "<h1>Профиль автора: {$author->name}</h1>";
        $output .= "<p>Биография: " . ($author->bio ?? 'Нет биографии.') . "</p>";
        $output .= "<p>Учитель: " . ($author->is_teacher ? 'Да' : 'Нет') . "</p>";
        $output .= "{$teacherInfo}";

        if ($author->books->isNotEmpty()) {
            $output .= "<h2>Книги:</h2><ul>";
            foreach ($author->books as $book) {
                $output .= "<li><a href=\"/books/{$book->slug}\">{$book->title}</a> (" . $book->chapters->count() . " глав)</li>";
            }
            $output .= "</ul>";
        }

        if ($author->articles->isNotEmpty()) {
            $output .= "<h2>Статьи:</h2><ul>";
            foreach ($author->articles as $article) {
                $output .= "<li><a href=\"/articles/{$article->slug}\">{$article->title}</a></li>";
            }
            $output .= "</ul>";
        }

        return $output;
    }
}
