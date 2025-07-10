@extends('layouts.app')

@section('content')
    <div class="p-4 bg-white rounded-lg shadow-md sm:p-6 lg:p-8">

        <header class="pb-6 mb-6 border-b border-gray-200">
            <h1 class="mb-4 text-4xl font-extrabold text-gray-900">{{ $article->title }}</h1>
            <div class="space-y-2 text-sm text-gray-600">
                @if ($article->published_at)
                    <div>
                        <strong>Опубликовано:</strong>
                        <time datetime="{{ $article->published_at->format('Y-m-d') }}">{{ $article->published_at->format('d.m.Y') }}</time>
                    </div>
                @endif
                @if($article->authors->isNotEmpty())
                    <div>
                        <strong>Автор(ы):</strong>
                        @foreach($article->authors as $author)
                            <a href="{{ route('authors.show', $author) }}" class="text-indigo-600 hover:underline">{{ $author->name }}</a>{{ !$loop->last ? ',' : '' }}
                        @endforeach
                    </div>
                @endif
                @if ($article->category)
                    <div>
                        <strong>Категория:</strong>
                        <a href="{{ route('categories.show', $article->category) }}" class="text-indigo-600 hover:underline">{{ $article->category->name }}</a>
                    </div>
                @endif
            </div>
        </header>

        <div class="prose max-w-none lg:prose-lg">
            {!! $article->content_html !!}
        </div>

        @if ($article->tags->isNotEmpty())
            <footer class="pt-6 mt-8 border-t border-gray-200">
                <h3 class="mb-3 text-lg font-semibold text-gray-800">Теги:</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach ($article->tags as $tag)
                        <a href="{{ route('tags.show', $tag) }}" class="inline-block px-3 py-1 text-sm font-semibold text-gray-700 bg-gray-200 rounded-full hover:bg-gray-300">
                            #{{ $tag->name }}
                        </a>
                    @endforeach
                </div>
            </footer>
        @endif
    </div>
@endsection
