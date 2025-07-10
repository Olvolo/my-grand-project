<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    public function index(): View
    {
        $tags = Tag::query()->withCount('articles')->paginate(20);
        return view('admin.tags.index', compact('tags'));
    }

    public function create(): View
    {
        return view('admin.tags.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(['name' => 'required|string|max:255|unique:tags,name']);
        Tag::query()->create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
        ]);
        return redirect()->route('admin.tags.index')->with('success', 'Тег успешно создан!');
    }

    public function edit(Tag $tag): View
    {
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag): RedirectResponse
    {
        $validated = $request->validate(['name' => ['required','string','max:255', Rule::unique('tags')->ignore($tag->id)]]);
        $tag->update($validated);
        return redirect()->route('admin.tags.index')->with('success', 'Тег успешно обновлён!');
    }

    public function destroy(Tag $tag): RedirectResponse
    {
        if ($tag->articles()->count() > 0) {
            return back()->with('error', 'Нельзя удалить тег, который присвоен статьям.');
        }
        $tag->delete();
        return redirect()->route('admin.tags.index')->with('success', 'Тег успешно удалён.');
    }
}
