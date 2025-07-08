@extends('layouts.app')

@section('content')
    <div class="bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-6 text-center">Результаты поиска</h1>

        @if ($query)
            <p class="text-lg text-gray-700 mb-6 text-center">
                Ваш запрос: "<span class="font-semibold text-indigo-700">{{ $query }}</span>"
            </p>
        @else
            <p class="text-lg text-gray-700 mb-6 text-center">
                Введите что-нибудь в поле поиска, чтобы начать.
            </p>
        @endif

        @if ($articles->isEmpty() && $chapters->isEmpty() && $query)
            <p class="text-xl text-center text-gray-600 mt-10">
                По запросу "<span class="font-semibold">{{ $query }}</span>" ничего не найдено.
            </p>
        @elseif ($query)
            {{-- Раздел для статей --}}
            @if ($articles->isNotEmpty())
                <h2 class="text-3xl font-bold text-gray-800 mt-8 mb-4 border-b pb-2">Статьи</h2>
                <div class="space-y-6">
                    @foreach ($articles as $article)
                        <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                <a href="{{ route('articles.show', $article) }}" class="hover:text-indigo-600">
                                    {{ $article->title }}
                                </a>
                            </h3>
                            <div class="text-gray-600 text-sm mb-2">
                                @if ($article->published_at)
                                    Опубликовано: {{ $article->published_at->format('d.m.Y') }}
                                @endif
                                @if ($article->authors->isNotEmpty())
                                    <span class="mx-1">|</span> Авторы:
                                    @foreach ($article->authors as $author)
                                        <a href="{{ route('authors.show', $author) }}" class="hover:underline">
                                            {{ $author->name }}
                                        </a>@if (!$loop->last), @endif
                                    @endforeach
                                @endif
                            </div>
                            {{-- TODO: Здесь можно добавить небольшой фрагмент текста с подсветкой совпадений --}}
                            <p class="text-gray-700 text-sm line-clamp-2">
                                {!! Str::limit(strip_tags($article->content), 200) !!}
                            </p>
                            <a href="{{ route('articles.show', $article) }}" class="text-indigo-600 hover:underline text-sm mt-2 block">
                                Читать далее &rarr;
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Раздел для глав книг --}}
            @if ($chapters->isNotEmpty())
                <h2 class="text-3xl font-bold text-gray-800 mt-8 mb-4 border-b pb-2">Главы книг</h2>
                <div class="space-y-6">
                    @foreach ($chapters as $chapter)
                        <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                <a href="{{ route('books.chapters.show', [$chapter->book, $chapter]) }}" class="hover:text-indigo-600">
                                    Книга: "{{ $chapter->book->title }}" &ndash; Глава: {{ $chapter->order }}. {{ $chapter->title }}
                                </a>
                            </h3>
                            <div class="text-gray-600 text-sm mb-2">
                                Авторы книги:
                                @foreach ($chapter->book->authors as $author)
                                    <a href="{{ route('authors.show', $author) }}" class="hover:underline">
                                        {{ $author->name }}
                                    </a>@if (!$loop->last), @endif
                                @endforeach
                            </div>
                            {{-- TODO: Здесь можно добавить небольшой фрагмент текста с подсветкой совпадений --}}
                            <p class="text-gray-700 text-sm line-clamp-2">
                                {!! Str::limit(strip_tags($chapter->content), 200) !!}
                            </p>
                            <a href="{{ route('books.chapters.show', [$chapter->book, $chapter]) }}" class="text-indigo-600 hover:underline text-sm mt-2 block">
                                Читать далее &rarr;
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif
    </div>
@endsection
