<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Мой Сайт') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900 leading-normal tracking-tight">
{{-- ЭТОТ DIV КРИТИЧЕН ДЛЯ КОМПОНОВКИ: min-h-screen (100% высоты) и flex flex-col (элементы по вертикали) --}}
<div class="min-h-screen flex flex-col">
    {{-- Включаем компонент навигации --}}
    @include('layouts.navigation')

    @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    {{-- Page Content - основной контент страницы - ЭТОТ БЛОК ВСЕГДА ДОЛЖЕН РЕНДЕРИТЬСЯ --}}
    {{-- flex-grow заставляет его растягиваться на всю доступную высоту --}}
    <main class="flex-grow py-8">
        <div class="container mx-auto px-4">
            {{-- Здесь будет основной контент каждой страницы --}}
            @yield('content')
        </div>
    </main>

    <footer class="bg-gray-800 text-white py-8 mt-auto">
        <div class="container mx-auto px-4 text-center">
            &copy; {{ date('Y') }} {{ config('app.name', 'Мой Сайт') }}. Все права защищены.
        </div>
    </footer>
</div>
</body>
</html>
