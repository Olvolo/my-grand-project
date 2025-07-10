<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// --- ОБЯЗАТЕЛЬНЫЕ МАРШРУТЫ BREEZE И АУТЕНТИФИКАЦИИ ---
// Этот файл включает все маршруты для login, register, logout, email verification, password reset.
// Также он включает маршруты для /dashboard и /profile, если они не переопределены ниже.
require __DIR__.'/auth.php';

// Главная страница (публичная)
Route::get('/', function () {
    return view('welcome');
})->name('home');


// Маршруты профиля (должны быть после require __DIR__.'/auth.php')
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- ВАШИ КАСТОМНЫЕ МАРШРУТЫ ---

// Маршруты для Авторов
Route::prefix('authors')->name('authors.')->group(function () {
    Route::get('/', [AuthorController::class, 'index'])->name('index');
    Route::get('/{author:slug}', [AuthorController::class, 'show'])->name('show'); // <-- Это теперь наш хаб
    Route::get('/{author:slug}/bio', [AuthorController::class, 'showBio'])->name('bio'); // <-- Новая страница для биографии
    Route::get('/{author:slug}/books', [AuthorController::class, 'showBooks'])->name('books'); // <-- Новая страница для списка книг
    Route::get('/{author:slug}/articles', [AuthorController::class, 'showArticles'])->name('articles'); // <-- Новая страница для списка статей
});

// Маршруты для Книг
Route::prefix('books')->name('books.')->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('index');
    Route::get('/{book:slug}', [BookController::class, 'show'])->name('show');
    Route::get('/{book:slug}/{chapter:slug}', [ChapterController::class, 'show'])->name('chapters.show');
});

// Маршруты для Статей
Route::prefix('articles')->name('articles.')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('index');
    Route::get('/{article:slug}', [ArticleController::class, 'show'])->name('show');
});

// Маршрут для поиска по сайту
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Маршруты для Категорий
Route::prefix('categories')->name('categories.')->group(function () {
    Route::get('/{category:slug}', [CategoryController::class, 'show'])->name('show');
});

// Маршруты для Тегов
Route::prefix('tags')->name('tags.')->group(function () {
    Route::get('/{tag:slug}', [TagController::class, 'show'])->name('show');
});

// --- МАРШРУТЫ АДМИНИСТРАТОРА ---
// Применяем middleware 'admin' к группе маршрутов
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
     // TODO: Здесь будут другие маршруты админки (управление статьями, книгами и т.д.)
 });

// TODO: Маршруты для скрытого контента (middleware('auth')) будут здесь.
