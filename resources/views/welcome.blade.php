@extends('layouts.app')

@section('content')
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">Добро пожаловать на сайт "Памятник Духовной Традиции"!</h1>
    <p class="text-lg text-center text-gray-700 mb-8">
        Здесь вы найдете труды Учителя Бидии Дандаровича Дандарона и его учеников.
        Наш сайт посвящен сохранению и распространению их духовного наследия.
    </p>
    <div class="mt-10 text-center">
        <p class="text-xl text-gray-800 mb-4">Начните изучение:</p>
        <ul class="inline-flex space-x-4 mt-4">
            <li><a href="{{ route('authors.index') }}" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-300">Авторы</a></li>
            <li><a href="{{ route('books.index') }}" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-300">Книги</a></li>
            <li><a href="{{ route('articles.index') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">Статьи</a></li>
        </ul>
    </div>

    <div class="mt-16 bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Последние статьи</h2>
        {{-- Здесь можно будет отображать последние публичные статьи --}}
        <p class="text-gray-600">Загрузка последних статей...</p>
        {{-- TODO: Заменить на реальный список статей из контроллера --}}
    </div>
@endsection
