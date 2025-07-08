@extends('layouts.app')

@section('content')
    <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center">Наши Авторы</h1>

    @if ($authors->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($authors as $author)
                <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4">
                    @if ($author->photo)
                        <img src="{{ asset('storage/' . $author->photo) }}" alt="{{ $author->name }}"
                             class="w-16 h-16 rounded-full object-cover border-2 border-indigo-500">
                    @else
                        <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold text-xl">
                            {{ mb_substr($author->name, 0, 1) }}
                        </div>
                    @endif
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">
                            <a href="{{ route('authors.show', $author) }}" class="hover:text-indigo-600">
                                {{ $author->name }}
                            </a>
                        </h2>
                        {{-- Этот блок будет удален, если метка не нужна --}}
                        {{-- @if ($author->is_teacher)
                            <span class="text-sm text-indigo-700 font-medium">Учитель</span>
                        @endif --}}
                        <p class="text-gray-600 text-sm mt-1">Книг: {{ $author->books->count() }}, Статей: {{ $author->articles->count() }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-gray-600 text-lg">Пока нет зарегистрированных авторов.</p>
    @endif
@endsection
