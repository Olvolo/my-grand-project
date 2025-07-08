@extends('layouts.app')

@section('content')
    <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center">Все Книги</h1>

    @if ($books->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($books as $book)
                <div class="bg-white p-6 rounded-lg shadow-md flex flex-col">
                    @if ($book->cover_image)
                        <div class="mb-4 flex justify-center">
                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}"
                                 class="w-32 h-48 object-cover rounded-md shadow-lg">
                        </div>
                    @endif
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">
                        <a href="{{ route('books.show', $book) }}" class="hover:text-indigo-600">
                            {{ $book->title }}
                        </a>
                        @if ($book->is_hidden)
                            <span class="ml-2 px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">Скрыто</span>
                        @endif
                    </h2>
                    <div class="text-gray-600 text-sm mb-3">
                        @if ($book->publication_year)
                            <span>Год: {{ $book->publication_year }}</span>
                        @endif
                        @if ($book->authors->isNotEmpty())
                            <span class="mx-1">|</span> Авторы:
                            @foreach ($book->authors as $author)
                                <a href="{{ route('authors.show', $author) }}" class="hover:underline">
                                    {{ $author->name }}
                                </a>@if (!$loop->last), @endif
                            @endforeach
                        @endif
                        @if ($book->chapters_count > 0)
                            <span class="mx-1">|</span> Глав: {{ $book->chapters_count }}
                        @endif
                    </div>
                    @if ($book->description)
                        <p class="text-gray-700 text-sm line-clamp-3 mb-4">
                            {!! Str::limit(strip_tags($book->description), 150) !!}
                        </p>
                    @endif
                    <div class="mt-auto text-right">
                        <a href="{{ route('books.show', $book) }}"
                           class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 transition duration-300">
                            Перейти к книге
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-gray-600 text-lg">Пока нет добавленных книг.</p>
    @endif
@endsection
