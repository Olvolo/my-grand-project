<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::query()->withCount('articles')->paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(['name' => 'required|string|max:255|unique:categories,name']);
        Category::query()->create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
        ]);
        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно создана!');
    }

    public function edit(Category $category): View
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate(['name' => ['required','string','max:255', Rule::unique('categories')->ignore($category->id)]]);
        $category->update($validated);
        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно обновлена!');
    }

    public function destroy(Category $category): RedirectResponse
    {
        if ($category->articles()->count() > 0) {
            return back()->with('error', 'Нельзя удалить категорию, в которой есть статьи.');
        }
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно удалена.');
    }
}
