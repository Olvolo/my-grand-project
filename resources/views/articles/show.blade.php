@extends('layouts.app')

@section('content')
    <article class="bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4">{{ $article->title }}</h1>

        <div class="text-gray-600 text-sm mb-4">
            @if ($article->published_at)
                Опубликовано: <time datetime="{{ $article->published_at->format('Y-m-d') }}">
                    {{ $article->published_at->format('d.m.Y') }}
                </time>
            @endif
            @if ($article->authors->isNotEmpty())
                <span class="mx-2">|</span>
                Авторы:
                @foreach ($article->authors as $author)
                    <a href="{{ route('authors.show', $author) }}" class="text-indigo-600 hover:underline">
                        {{ $author->name }}
                    </a>@if (!$loop->last), @endif
                @endforeach
            @endif
        </div>

        {{-- Категории --}}
        @if ($article->category)
            <div class="text-gray-700 text-sm mb-2">
                Категория: <a href="{{ route('categories.show', $article->category) }}" class="text-blue-600 hover:underline">
                    {{ $article->category->name }}
                </a>
            </div>
        @endif

        {{-- Теги --}}
        @if ($article->tags->isNotEmpty())
            <div class="text-gray-700 text-sm mb-4">
                Теги:
                @foreach ($article->tags as $tag)
                    <a href="{{ route('tags.show', $tag) }}" class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2 hover:bg-gray-300">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>
        @endif

        <hr class="my-6 border-gray-300">

        {{-- ... остальное содержимое статьи ... --}}
        <div class="prose lg:prose-lg xl:prose-xl max-w-none text-gray-800 leading-relaxed">
            {!! $article->content !!}
        </div>

        {{-- TODO: Здесь могут быть комментарии или ссылки на другие материалы --}}
    </article>
@endsection
