@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <h1 class="mb-6 text-3xl font-bold text-gray-800">
                Редактирование статьи: {{ $article->title }}
            </h1>

            {{-- Отображение ошибок валидации --}}
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.articles.update', $article) }}" method="POST" class="p-6 bg-white rounded-lg shadow-md space-y-6">
                @csrf
                @method('PATCH')

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Заголовок</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $article->title) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="mt-6">
                    <label for="content" class="block text-sm font-medium text-gray-700">Содержимое статьи (Markdown)</label>
                    <textarea name="content_markdown" id="content_markdown" rows="15" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">{{ old('content_markdown', $article->content_markdown) }}</textarea>                    {{-- Примечание: Мы будем использовать новое свойство content_markdown, которое добавим в модель --}}
                </div>

                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Категория</label>
                    <select name="category_id" id="category_id" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $article->category_id) == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="authors" class="block text-sm font-medium text-gray-700">Авторы (можно выбрать несколько)</label>
                    <select name="authors[]" id="authors" multiple class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}" @selected(in_array($author->id, old('authors', $article->authors->pluck('id')->toArray())))>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="tags" class="block text-sm font-medium text-gray-700">Теги (можно выбрать несколько)</label>
                    <select name="tags[]" id="tags" multiple class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}" @selected(in_array($tag->id, old('tags', $article->tags->pluck('id')->toArray())))>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="is_hidden" id="is_hidden" value="1" @checked(old('is_hidden', $article->is_hidden)) class="w-4 h-4 text-indigo-600 border-gray-300 rounded">
                    <label for="is_hidden" class="ml-2 block text-sm text-gray-900">Скрыть статью</label>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">
                        Сохранить изменения
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
