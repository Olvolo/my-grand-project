<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\ChapterController as AdminChapterController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\AuthorController as AdminAuthorController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\TagController as AdminTagController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- Главная страница и страницы аутентификации ---
Route::get('/', [HomeController::class, 'index'])->name('home');
require __DIR__.'/auth.php';

// --- МАРШРУТЫ АДМИНИСТРАТОРА (Идут первыми) ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Управление статьями
    Route::get('/articles', [AdminArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [AdminArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [AdminArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}/edit', [AdminArticleController::class, 'edit'])->name('articles.edit');
    Route::patch('/articles/{article}', [AdminArticleController::class, 'update'])->name('articles.update');

    // Управление книгами
    Route::get('/books', [AdminBookController::class, 'index'])->name('books.index');
    Route::get('/books/create', [AdminBookController::class, 'create'])->name('books.create');
    Route::post('/books', [AdminBookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}/manage', [AdminBookController::class, 'manage'])->name('books.manage');
    Route::get('/books/{book}/edit', [AdminBookController::class, 'edit'])->name('books.edit');
    Route::patch('/books/{book}', [AdminBookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [AdminBookController::class, 'destroy'])->name('books.destroy');

    // Управление главами
    Route::post('/chapters/{book}', [AdminChapterController::class, 'store'])->name('chapters.store');
    Route::get('/chapters/{chapter}/edit', [AdminChapterController::class, 'edit'])->name('chapters.edit');
    Route::patch('/chapters/{chapter}', [AdminChapterController::class, 'update'])->name('chapters.update');

    //УПРАВЛЕНИЯ АВТОРАМИ
    Route::resource('authors', AdminAuthorController::class);

    // Управление категориями
    Route::resource('categories', AdminCategoryController::class)->except(['show']);

    // Управление тегами
    Route::resource('tags', AdminTagController::class)->except(['show']);
});




// --- ПУБЛИЧНЫЕ МАРШРУТЫ (Идут после админки) ---

// Профиль пользователя
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Авторы
Route::prefix('authors')->name('authors.')->group(function () {
    Route::get('/', [AuthorController::class, 'index'])->name('index');
    Route::get('/{author:slug}', [AuthorController::class, 'show'])->name('show');
    Route::get('/{author:slug}/bio', [AuthorController::class, 'showBio'])->name('bio');
    Route::get('/{author:slug}/books', [AuthorController::class, 'showBooks'])->name('books');
    Route::get('/{author:slug}/articles', [AuthorController::class, 'showArticles'])->name('articles');
});

// Книги и главы
Route::prefix('books')->name('books.')->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('index');
    Route::get('/{book:slug}', [BookController::class, 'show'])->name('show');
    Route::get('/{book:slug}/{chapter:slug}', [ChapterController::class, 'show'])->name('chapters.show');
});

// Статьи
Route::prefix('articles')->name('articles.')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('index');
    Route::get('/{article:slug}', [ArticleController::class, 'show'])->name('show');
});

// Категории и Теги
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/tags/{tag:slug}', [TagController::class, 'show'])->name('tags.show');

// Поиск и Контакты
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::view('/contacts', 'pages.contacts')->name('contacts');
