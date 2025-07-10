<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use League\CommonMark\MarkdownConverter;
use League\CommonMark\Exception\CommonMarkException;

class ArticleController extends Controller
{
    /**
     * Display a listing of all articles for the admin.
     */
    public function index(): View
    {
        $articles = Article::query()
            ->with('authors')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new article.
     */
    public function create(): View
    {
        // Передаем в шаблон все необходимые данные для выпадающих списков
        $authors = Author::query()->orderBy('name')->get();
        $categories = Category::query()->orderBy('name')->get();
        $tags = Tag::query()->orderBy('name')->get();

        return view('admin.articles.create', compact('authors', 'categories', 'tags'));
    }
    /**
     * Store a newly created article in storage.
     */
    public function store(Request $request, MarkdownConverter $converter): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:articles,title',
            'content_markdown' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'is_hidden' => 'nullable|boolean',
        ]);

        try {
            $htmlContent = $converter->convert($validated['content_markdown'])->getContent();

            $article = Article::create([
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']), // Генерируем slug
                'content_markdown' => $validated['content_markdown'],
                'content_html' => $htmlContent,
                'category_id' => $validated['category_id'],
                'is_hidden' => $request->has('is_hidden'),
                'published_at' => now(), // Устанавливаем текущую дату как дату публикации
            ]);

            $article->authors()->sync($validated['authors']);
            $article->tags()->sync($validated['tags'] ?? []);

        } catch (CommonMarkException $e) {
            return back()->with('error', 'Ошибка при обработке Markdown: ' . $e->getMessage());
        }

        return redirect()->route('admin.articles.index')->with('success', 'Статья успешно создана!');
    }

    /**
     * Show the form for editing the specified article.
     */
    public function edit(Article $article): View
    {
        // Загружаем все возможные теги, авторов и категории для формы
        $authors = Author::all();
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.articles.edit', compact('article', 'authors', 'categories', 'tags'));
    }

    /**
     * Update the specified article in storage.
     */
    public function update(Request $request, Article $article, MarkdownConverter $converter): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content_markdown' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'authors' => 'required|array',
            'tags.*' => 'exists:tags,id',
            'is_hidden' => 'nullable|boolean',
        ]);

        try {
            $markdownContent = $validated['content_markdown'];
            $htmlContent = $converter->convert($markdownContent)->getContent();

            $article->update([
                'title' => $validated['title'],
                'content_markdown' => $markdownContent,
                'content_html' => $htmlContent,
                'category_id' => $validated['category_id'],
                'is_hidden' => $request->has('is_hidden'),
            ]);

            $article->authors()->sync($validated['authors']);
            $article->tags()->sync($validated['tags'] ?? []);

        } catch (CommonMarkException $e) {
            return back()->with('error', 'Ошибка при обработке Markdown: ' . $e->getMessage());
        }

        return redirect()->route('admin.articles.index')->with('success', 'Статья успешно обновлена!');
    }
}
