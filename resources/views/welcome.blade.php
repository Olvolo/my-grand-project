@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            {{-- Верхний приветственный блок --}}
            <div class="py-12 text-center">
                {{-- Здесь можно будет разместить изображение Древа Прибежища или фото Дандарона --}}
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
                    Традиция Дандарона
                </h1>
                <p class="max-w-md mx-auto mt-3 text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                    Архив работ Учителя Бидии Дандарона и его учеников, посвящённый сохранению и распространению их духовного наследия.
                </p>
            </div>

            {{-- Сетка с навигационными карточками-ссылками --}}
            <div class="grid grid-cols-1 gap-8 mt-6 md:grid-cols-2 lg:grid-cols-3">

                {{-- Примечание: пока мы не создали страницу, ссылка ведёт на заглушку # --}}
                <a href="{{ route('tradition.index') }}" class="block p-8 text-center transition duration-300 bg-white rounded-lg shadow-lg hover:shadow-2xl hover:scale-105">
                    <h2 class="text-2xl font-bold text-gray-800">Традиция</h2>
                    <p class="mt-2 text-gray-600">Преемственность, линия Учителей, история.</p>
                </a>

                <a href="{{ route('authors.show', 'bidiya-dandaron') }}" class="block p-8 text-center transition duration-300 bg-white rounded-lg shadow-lg hover:shadow-2xl hover:scale-105">
                    <h2 class="text-2xl font-bold text-gray-800">Б.Д. Дандарон</h2>
                    <p class="mt-2 text-gray-600">Биография, работы, статьи об Учителе.</p>
                </a>

                <a href="{{ route('authors.index') }}" class="block p-8 text-center transition duration-300 bg-white rounded-lg shadow-lg hover:shadow-2xl hover:scale-105">
                    <h2 class="text-2xl font-bold text-gray-800">Лики Традиции</h2>
                    <p class="mt-2 text-gray-600">Ученики и последователи, их работы и воспоминания.</p>
                </a>

                <a href="{{ route('teaching.index') }}" class="block p-8 text-center transition duration-300 bg-white rounded-lg shadow-lg hover:shadow-2xl hover:scale-105">
                    <h2 class="text-2xl font-bold text-gray-800">Учение</h2>
                    <p class="mt-2 text-gray-600">Философия, Сутра, Тантра, Садханы.</p>
                </a>

                <a href="{{ route('history.index') }}" class="block p-8 text-center transition duration-300 bg-white rounded-lg shadow-lg hover:shadow-2xl hover:scale-105">
                    <h2 class="text-2xl font-bold text-gray-800">История</h2>
                    <p class="mt-2 text-gray-600">История буддизма, ключевые моменты.</p>
                </a>

                <a href="{{ route('materials.index') }}" class="block p-8 text-center transition
                duration-300 bg-white rounded-lg shadow-lg hover:shadow-2xl hover:scale-105">
                    <h2 class="text-2xl font-bold text-gray-800">Доп. материалы</h2>
                    <p class="mt-2 text-gray-600">Материалы из других источников.</p>
                </a>

            </div>
        </div>
    </div>
@endsection
