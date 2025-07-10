<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     * 2. Добавляем тип возвращаемого значения -> : View
     */
    public function index(): View
    {
        return view('admin.dashboard');
    }
}
