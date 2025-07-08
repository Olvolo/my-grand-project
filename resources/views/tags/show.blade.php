@extends('layouts.app')

@section('content')
    <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center">
        Тег: "#{{ $tag->name }}"
    </h1>

    @if ($articles->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($articles as $article)
                <div class="bg-white p-6 rounded-lg shadow-md flex flex-col">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">
                        <a href="{{ route('articles.show', $article) }}" class="hover:text-indigo-600">
                            {{ $article->title }}
                        </a>
                        @if ($article->is_hidden)
                            <span class="ml-2 px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">Скрыто</span>
                        @endif
                    </h2>
                    <div class="text-gray-600 text-sm mb-3">
                        @if ($article->published_at)
                            Опубликовано: <time datetime="{{ $article->published_at->format('Y-m-d') }}">
                                {{ $article->published_at->format('d.m.Y') }}
                            </time>
                        @endif
                        @if ($article->authors->isNotEmpty())
                            <span class="mx-1">|</span> Авторы:
                            @foreach ($article->authors as $author)
                                <a href="{{ route('authors.show', $author) }}" class="hover:underline">
                                    {{ $author->name }}
                                </a>@if (!$loop->last), @endif
                            @endforeach
                        @endif
                        {{-- Отображение категории в списке тега --}}
                        @if ($article->category)
                            <span class="mx-1">|</span> Категория:
                            <a href="{{ route('categories.show', $article->category) }}" class="inline-block text-blue-600 hover:underline">
                                {{ $article->category->name }}
                            </a>
                        @endif
                    </div>
                    @if ($article->description)
                        <p class="text-gray-700 text-sm line-clamp-3 mb-4">
                            {!! Str::limit(strip_tags($article->description), 150) !!}
                        </p>
                    @endif
                    <div class="mt-auto text-right">
                        <a href="{{ route('articles.show', $article) }}"
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition duration-300">
                            Читать статью
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-gray-600 text-lg">По тегу "#{{ $tag->name }}" пока нет статей.</p>
    @endif
@endsection
