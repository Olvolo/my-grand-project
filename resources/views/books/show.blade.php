@extends('layouts.app')

@section('content')
    <div class="bg-white p-8 rounded-lg shadow-md mb-8">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4">{{ $book->title }}
            @if ($book->is_hidden)
                <span class="ml-4 px-3 py-1 bg-red-100 text-red-700 rounded-full text-base font-semibold align-middle">Скрыто</span>
            @endif
        </h1>

        <div class="text-gray-600 text-sm mb-4">
            @if ($book->publication_year)
                Год публикации: {{ $book->publication_year }}
            @endif
            @if ($book->language)
                <span class="mx-2">|</span> Язык: {{ strtoupper($book->language) }}
            @endif
            @if ($book->publisher)
                <span class="mx-2">|</span> Издательство: {{ $book->publisher }}
            @endif
            @if ($book->authors->isNotEmpty())
                <span class="mx-2">|</span>
                Авторы:
                @foreach ($book->authors as $author)
                    <a href="{{ route('authors.show', $author) }}" class="text-indigo-600 hover:underline">
                        {{ $author->name }}
                    </a>@if (!$loop->last), @endif
                @endforeach
            @endif
        </div>

        @if ($book->description)
            <div class="prose lg:prose-lg xl:prose-xl max-w-none text-gray-800 leading-relaxed mt-6">
                {!! $book->description !!}
            </div>
        @endif
    </div>

    <div class="bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">Оглавление</h2>

        @if ($book->chapters->isNotEmpty())
            <ul class="space-y-2">
                @foreach ($book->chapters as $chapter)
                    <li class="flex items-center text-lg text-gray-800 hover:text-indigo-700 transition duration-200">
                        <span class="font-semibold w-8 text-right mr-2">{{ $chapter->order }}.</span>
                        <a href="{{ route('books.chapters.show', [$book, $chapter]) }}" class="flex-grow">
                            {{ $chapter->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-600">В этой книге пока нет глав.</p>
        @endif
    </div>
@endsection
