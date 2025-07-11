@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Авторы и их работы</h1>

            <div class="space-y-4">
                @forelse ($authors as $author)
                    {{-- Ваш компонент-аккордеон --}}
                    <div x-data="{ isOpen: false }" class="bg-white rounded-lg shadow-sm">
                        {{-- Кликабельный заголовок --}}
                        <div @click="isOpen = !isOpen" class="p-4 flex justify-between items-center cursor-pointer">
                            <h3 class="text-xl font-semibold text-gray-900">{{ $author->name }}</h3>
                            <div class="flex items-center space-x-4">
                                @if($author->books_count > 0)
                                    <span class="text-sm text-gray-500">Книг: {{ $author->books_count }}</span>
                                @endif
                                <span class="text-sm font-medium text-indigo-600" x-text="isOpen ? 'Свернуть' : 'Показать статьи'"></span>
                            </div>
                        </div>

                        {{-- Выпадающий список статей --}}
                        <div x-show="isOpen" x-transition.duration.300ms class="border-t border-gray-200">
                            <ul class="p-4 space-y-2">
                                @forelse($author->articles as $article)
                                    <li>
                                        <a href="{{ route('articles.show', $article) }}" class="text-gray-700 hover:text-indigo-700 hover:underline">
                                            &rarr; {{ $article->title }}
                                        </a>
                                    </li>
                                @empty
                                    <li class="text-gray-500">У этого автора пока нет статей.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-600">На сайте пока нет авторов.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
