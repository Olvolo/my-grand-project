{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--    <div class="p-4 bg-white rounded-lg shadow-md sm:p-6 lg:p-8">--}}

{{--        <header class="pb-6 mb-6 border-b border-gray-200">--}}
{{--            <h1 class="mb-4 text-4xl font-extrabold text-gray-900">{{ $author->name }}</h1>--}}

{{--            --}}{{-- Добавляем этот блок для вывода биографии --}}
{{--            @if ($author->bio)--}}
{{--                <div class="prose max-w-none lg:prose-lg">--}}
{{--                    {!! $author->bio !!}--}}
{{--                </div>--}}
{{--            @endif--}}

{{--        </header>--}}

{{--        <div>--}}
{{--            <h2 class="text-2xl font-bold text-gray-800">Книги автора</h2>--}}
{{--            @forelse ($author->books as $book)--}}
{{--                <div class="mt-4">--}}
{{--                    <a href="{{ route('books.show', $book) }}" class="text-lg text-indigo-600 hover:underline">{{ $book->title }}</a>--}}
{{--                    @if($book->publication_year)--}}
{{--                        <p class="my-0 text-sm text-gray-600">Год публикации: {{ $book->publication_year }}</p>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            @empty--}}
{{--                <p class="mt-2 text-gray-500">У этого автора пока нет опубликованных книг.</p>--}}
{{--            @endforelse--}}
{{--        </div>--}}

{{--        <div class="mt-10">--}}
{{--            <h2 class="text-2xl font-bold text-gray-800">Статьи автора</h2>--}}
{{--            @forelse ($author->articles as $article)--}}
{{--                <div class="mt-4">--}}
{{--                    <a href="{{ route('articles.show', $article) }}" class="text-lg text-indigo-600 hover:underline">{{ $article->title }}</a>--}}
{{--                    @if($article->published_at)--}}
{{--                        <p class="my-0 text-sm text-gray-600">Опубликовано: {{ $article->published_at->format('d.m.Y') }}</p>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            @empty--}}
{{--                <p class="mt-2 text-gray-500">У этого автора пока нет опубликованных статей.</p>--}}
{{--            @endforelse--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

@extends('layouts.app')

@section('content')
    <div class="p-4 bg-white rounded-lg shadow-md sm:p-6 lg:p-8">

        {{-- Заголовок с именем автора --}}
        <header class="pb-6 text-center border-b border-gray-200">
            {{-- Место для фото автора в будущем --}}
            {{-- <img src="..." class="w-32 h-32 mx-auto mb-4 rounded-full"> --}}
            <h1 class="text-4xl font-extrabold text-gray-900">{{ $author->name }}</h1>
            @if($author->is_teacher)
                <p class="mt-2 text-lg font-semibold text-indigo-600">Учитель Традиции</p>
            @endif
        </header>

        {{-- Навигационные карточки-шлюзы --}}
        <div class="grid grid-cols-1 gap-8 mt-8 md:grid-cols-3">

            <a href="{{ route('authors.bio', $author) }}" class="block p-6 text-center transition duration-300 bg-gray-100 rounded-lg shadow-sm hover:shadow-lg hover:bg-indigo-50">
                <h2 class="text-2xl font-bold text-gray-800">Биография</h2>
                <p class="mt-2 text-gray-600">Подробные материалы о жизни и деятельности.</p>
            </a>

            <a href="{{ route('authors.books', $author) }}" class="block p-6 text-center transition duration-300 bg-gray-100 rounded-lg shadow-sm hover:shadow-lg hover:bg-indigo-50">
                <h2 class="text-2xl font-bold text-gray-800">Книги</h2>
                <p class="mt-2 text-gray-600">Полный список написанных трудов и работ.</p>
            </a>

            <a href="{{ route('authors.articles', $author) }}" class="block p-6 text-center transition duration-300 bg-gray-100 rounded-lg shadow-sm hover:shadow-lg hover:bg-indigo-50">
                <h2 class="text-2xl font-bold text-gray-800">Статьи</h2>
                <p class="mt-2 text-gray-600">Статьи автора и материалы о нём.</p>
            </a>

        </div>
    </div>
@endsection
