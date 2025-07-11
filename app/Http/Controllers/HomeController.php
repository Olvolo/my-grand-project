<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the application's homepage.
     */
    public function index(): View
    {
        // Пока просто возвращаем шаблон, без дополнительной логики
        return view('welcome');
    }
}
