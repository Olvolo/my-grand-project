<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AuthorController extends Controller
{
    /**
     * Display a listing of the authors.
     */
    public function index(): View
    {
        $authors = Author::query()
            ->withCount(['books', 'articles'])
            ->orderBy('name')
            ->paginate(20);

        return view('admin.authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new author.
     */
    public function create(): View
    {
        return view('admin.authors.create');
    }

    /**
     * Store a newly created author in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:authors,name',
            'bio' => 'nullable|string',
            'is_teacher' => 'nullable|boolean',
            'order_column' => 'nullable|integer',
        ]);

        // Исправляем вызов, чтобы удовлетворить анализатор
        Author::query()->create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'bio' => $validated['bio'],
            'is_teacher' => $request->has('is_teacher'),
            'order_column' => $validated['order_column'] ?? 0,
        ]);

        return redirect()->route('admin.authors.index')->with('success', 'Автор успешно создан!');
    }

    /**
     * Show the form for editing the specified author.
     */
    public function edit(Author $author): View
    {
        return view('admin.authors.edit', compact('author'));
    }

    /**
     * Update the specified author in storage.
     */
    public function update(Request $request, Author $author): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('authors')->ignore($author->id)],
            'bio' => 'nullable|string',
            'is_teacher' => 'nullable|boolean',
            'order_column' => 'nullable|integer',
        ]);

        $author->update([
            'name' => $validated['name'],
            'bio' => $validated['bio'],
            'is_teacher' => $request->has('is_teacher'),
            'order_column' => $validated['order_column'] ?? 0,
        ]);

        return redirect()->route('admin.authors.index')->with('success', 'Данные автора успешно обновлены!');
    }

    /**
     * Remove the specified author from storage.
     */
    public function destroy(Author $author): RedirectResponse
    {
        if ($author->books()->count() > 0 || $author->articles()->count() > 0) {
            return back()->with('error', 'Нельзя удалить автора, у которого есть книги или статьи.');
        }

        $author->delete();
        return redirect()->route('admin.authors.index')->with('success', 'Автор успешно удалён.');
    }
}
