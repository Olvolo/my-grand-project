@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold text-gray-900">Традиция</h1>
                <p class="mt-2 text-lg text-gray-600">Непрерывная череда Учителей и учеников.</p>
            </div>

            {{-- Блок с Учителями --}}
            @if($teachers->isNotEmpty())
                <div class="mt-12">
                    <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Ключевые фигуры</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach ($teachers as $teacher)
                            <a href="{{ route('authors.show', $teacher) }}" class="block p-6 text-center bg-white rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300">
                                <h3 class="text-2xl font-semibold text-indigo-700">{{ $teacher->name }}</h3>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Блок со статьями по теме --}}
            @if($articles->isNotEmpty())
                <div class="mt-16">
                    <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">
                        Материалы по теме "{{ $traditionCategory->name ?? 'Традиция' }}"
                    </h2>
                    <div class="space-y-4 max-w-4xl mx-auto">
                        @foreach ($articles as $article)
                            <a href="{{ route('articles.show', $article) }}" class="block p-4 bg-white rounded-lg shadow-sm hover:bg-gray-50 transition-colors duration-200">
                                <p class="text-xl font-semibold text-gray-800 hover:text-indigo-600">
                                    {{ $article->title }}
                                </p>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
