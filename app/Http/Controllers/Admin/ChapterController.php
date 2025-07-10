<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use League\CommonMark\MarkdownConverter;
use League\CommonMark\Exception\CommonMarkException;

class ChapterController extends Controller
{
    /**
     * Show the form for editing the specified chapter.
     */
    public function edit(Chapter $chapter): View
    {
        return view('admin.chapters.edit', compact('chapter'));
    }

    /**
     * Update the specified chapter in storage.
     */
    public function update(Request $request, Chapter $chapter, MarkdownConverter $converter): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content_markdown' => 'required|string',
            'is_hidden' => 'nullable|boolean',
        ]);

        try {
            $markdownContent = $validated['content_markdown'];
            $htmlContent = $converter->convert($markdownContent)->getContent();

            $chapter->update([
                'title' => $validated['title'],
                'content_markdown' => $markdownContent,
                'content_html' => $htmlContent,
                'is_hidden' => $request->has('is_hidden'),
            ]);

        } catch (CommonMarkException $e) {
            return back()->with('error', 'Ошибка при обработке Markdown: ' . $e->getMessage());
        }
        // Возвращаемся на страницу книги, к которой принадлежит глава
        return redirect()->route('books.show', $chapter->book)->with('success', 'Глава успешно обновлена!');
    }

    public function store(Request $request, Book $book, MarkdownConverter $converter): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content_markdown' => 'nullable|string',
        ]);

        // Находим последний порядковый номер и добавляем 1
        $lastOrder = $book->chapters()->max('order') ?? 0;

        try {
            $htmlContent = $converter->convert($validated['content_markdown'] ?? '')->getContent();

            $book->chapters()->create([
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']),
                'content_markdown' => $validated['content_markdown'],
                'content_html' => $htmlContent,
                'order' => $lastOrder + 1,
            ]);
        } catch (CommonMarkException $e) {
            return back()->with('error', 'Ошибка при обработке Markdown: ' . $e->getMessage());
        }

        // Возвращаемся на страницу управления книгой
        return redirect()->route('admin.books.manage', $book)->with('success', 'Глава успешно добавлена!');
    }

}
