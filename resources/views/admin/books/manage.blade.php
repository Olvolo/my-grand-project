@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800">Управление книгой: {{ $book->title }}</h1>
            <p class="text-gray-600">Здесь вы можете добавлять, редактировать и упорядочивать главы.</p>

            {{-- Список существующих глав --}}
            <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold mb-4">Оглавление</h2>
                @forelse($book->chapters as $chapter)
                    <div class="flex justify-between items-center py-2 border-b">
                        <span>{{ $chapter->order }}. {{ $chapter->title }}</span>
                        <a href="{{ route('admin.chapters.edit', $chapter) }}" class="text-sm text-indigo-600 hover:underline">Редактировать</a>
                    </div>
                @empty
                    <p class="text-gray-500">В этой книге пока нет глав.</p>
                @endforelse
            </div>

            {{-- Форма добавления новой главы --}}
            <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold mb-4">Добавить новую главу</h2>
                {{-- Мы создадим этот маршрут на следующем шаге --}}
                <form action="{{ route('admin.chapters.store', $book) }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <input type="text" name="title" placeholder="Название главы" class="block w-full border-gray-300 rounded-md shadow-sm" required>
                        <textarea name="content_markdown" rows="10" placeholder="Содержимое главы в формате Markdown..." class="block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        <div class="flex justify-end">
                            <button type="submit" class="px-6 py-2 font-semibold text-white bg-green-600 rounded-lg hover:bg-green-700">Добавить главу</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
