@extends('layouts.app')
@section('content')
    <div class="p-4 bg-white rounded-lg shadow-md sm:p-6 lg:p-8">
        <h1 class="mb-6 text-3xl font-bold text-gray-800">Статьи автора: {{ $author->name }}</h1>
        <div class="space-y-4">
            @forelse ($articles as $article)
                <div>
                    <a href="{{ route('articles.show', $article) }}" class="text-xl font-semibold text-indigo-600 hover:underline">{{ $article->title }}</a>
                    <p class="text-sm text-gray-600">Опубликовано: {{ $article->published_at->format('d.m.Y') }}</p>
                </div>
            @empty
                <p class="text-gray-600">У этого автора пока нет опубликованных статей.</p>
            @endforelse
        </div>
        <div class="mt-8">
            {{ $articles->links() }}
        </div>
    </div>
@endsection
