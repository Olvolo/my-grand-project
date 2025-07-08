<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Это будет страница дашборда администратора
        return view('admin.dashboard');
    }
}
