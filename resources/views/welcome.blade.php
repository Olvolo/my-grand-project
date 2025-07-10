@extends('layouts.app')

@section('content')
    {{-- Верхний блок остаётся как у вас, он отличный --}}
    <div class="py-12 text-center bg-white rounded-lg shadow-lg">
        <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
            Сайт Традиции Дандарона
        </h1>
        <p class="max-w-md mx-auto mt-3 text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
            Онлайн-архив, посвященный жизни и творческим работам Учителя Бидии Дандаровича Дандарона и его учеников.
        </p>
    </div>

    {{-- А вот динамические блоки --}}
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            {{-- Блок "Последние статьи" --}}
            <h2 class="mb-6 text-3xl font-bold text-center text-gray-800">Последние статьи</h2>
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse($latestArticles as $article)
                    <div class="p-6 transition duration-300 bg-white rounded-lg shadow-md hover:shadow-xl">
                        <h3 class="mb-2 text-xl font-semibold">
                            <a href="{{ route('articles.show', $article) }}" class="text-indigo-600 hover:underline">
                                {{ $article->title }}
                            </a>
                        </h3>
                        <p class="text-sm text-gray-600">
                            {{ $article->published_at->format('d.m.Y') }}
                        </p>
                    </div>
                @empty
                    <p class="text-center text-gray-500 md:col-span-3">Статей пока нет.</p>
                @endforelse
            </div>

            {{-- Блок "Новое в библиотеке" --}}
            <h2 class="mt-16 mb-6 text-3xl font-bold text-center text-gray-800">Новое в библиотеке</h2>
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse($latestBooks as $book)
                    <div class="p-6 transition duration-300 bg-white rounded-lg shadow-md hover:shadow-xl">
                        <h3 class="mb-2 text-xl font-semibold">
                            <a href="{{ route('books.show', $book) }}" class="text-indigo-600 hover:underline">
                                {{ $book->title }}
                            </a>
                        </h3>
                        <p class="text-sm text-gray-600">
                            @if($book->publication_year)
                                Год: {{ $book->publication_year }}
                            @endif
                        </p>
                    </div>
                @empty
                    <p class="text-center text-gray-500 md:col-span-3">Книг пока нет.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
