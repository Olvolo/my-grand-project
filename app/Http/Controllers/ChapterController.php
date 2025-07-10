<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Chapter;
use Illuminate\View\View;

class ChapterController extends Controller
{
    public function show(Book $book, Chapter $chapter): View
    {
        if ($chapter->book_id !== $book->id) {
            abort(404);
        }

        if (($chapter->is_hidden || $book->is_hidden) && !auth()->check()) {
            abort(403, 'Эта глава доступна только авторизованным пользователям.');
        }

        $allChapters = $book->visibleChapters()->get();

        $previousChapter = $chapter->previousChapter();
        $nextChapter = $chapter->nextChapter();

        return view('chapters.show', compact(
            'book',
            'chapter',
            'allChapters',
            'previousChapter',
            'nextChapter'
        ));
    }
}
