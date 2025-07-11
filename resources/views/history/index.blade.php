@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-gray-900">История</h1>
                <p class="mt-2 text-lg text-gray-600">Тематическая подборка материалов.</p>
            </div>

            <div class="space-y-8">
                {{-- Перебираем категории, которые передал контроллер --}}
                @foreach ($categories as $category)
                    {{-- Выводим блок, только если в категории есть статьи --}}
                    @if($category->articles->isNotEmpty())
                        {{-- Ваш пример с цветным блоком! --}}
                        <div class="bg-emerald-50 p-6 rounded-lg shadow-md">
                            <h3 class="text-2xl font-semibold mb-4 text-gray-800 text-center italic">
                                {{ $category->name }}
                            </h3>
                            <ul class="list-none space-y-2 text-lg">
                                {{-- Перебираем статьи внутри этой категории --}}
                                @foreach ($category->articles as $article)
                                    <li>
                                        <a href="{{ route('articles.show', $article) }}" class="text-gray-800 hover:text-indigo-600 hover:underline">
                                            &rarr; {{ $article->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
