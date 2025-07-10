@extends('layouts.app')
@section('content')
    <div class="p-4 bg-white rounded-lg shadow-md sm:p-6 lg:p-8">
        <h1 class="mb-6 text-3xl font-bold text-gray-800">Книги автора: {{ $author->name }}</h1>
        <div class="space-y-4">
            @forelse ($books as $book)
                <div>
                    <a href="{{ route('books.show', $book) }}" class="text-xl font-semibold text-indigo-600 hover:underline">{{ $book->title }}</a>
                    <p class="text-sm text-gray-600">{{ $book->publication_year }}</p>
                </div>
            @empty
                <p class="text-gray-600">У этого автора пока нет опубликованных книг.</p>
            @endforelse
        </div>
        <div class="mt-8">
            {{ $books->links() }}
        </div>
    </div>
@endsection
