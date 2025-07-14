    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Традиция Дандарона') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased min-h-screen flex flex-col">

{{-- Навигация (header) - занимает всю ширину --}}
@include('layouts.navigation')

{{-- Основной контент - занимает всю ширину и высоту, заполняет оставшееся пространство --}}
<main class="flex-grow w-full bg-cover bg-center bg-no-repeat relative" style="background-image: url('{{ asset('images/main_background.webp') }}');">
    {{-- Затемнение для лучшей читаемости --}}
    <div class="absolute inset-0 bg-black/20"></div>

    {{-- Контейнер для содержимого с ограничением ширины --}}
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </div>
</main>

{{-- Подвал - фон на всю ширину, текст центрирован --}}
<footer class="w-full bg-sky-900 text-brand-cream py-6">
    <div class="text-center">
        &copy; {{ date('Y') }} {{ config('app.name', 'Традиция Дандарона') }}. Все права защищены.
    </div>
</footer>

</body>
</html>
