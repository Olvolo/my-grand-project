@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">
                Добавление новой книги
            </h1>

            <form action="{{ route('admin.books.store') }}" method="POST" class="p-6 bg-white rounded-lg shadow-md space-y-6">
                @csrf

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Название</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="markdown-editor block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="order_column" class="block text-sm font-medium text-gray-700">Порядок сортировки</label>
                    <input type="number" name="order_column" id="order_column" value="{{ old('order_column', $author->order_column ?? 0) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="authors" class="block text-sm font-medium text-gray-700">Авторы</label>
                    <select name="authors[]" id="authors" multiple class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}" @selected(in_array($author->id, old('authors', []) ?? []))>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="publication_year" class="block text-sm font-medium text-gray-700">Год публикации</label>
                        <input type="text" name="publication_year" id="publication_year" value="{{ old('publication_year') }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="publisher" class="block text-sm font-medium text-gray-700">Издательство</label>
                        <input type="text" name="publisher" id="publisher" value="{{ old('publisher') }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="language" class="block text-sm font-medium text-gray-700">Язык</label>
                        <input type="text" name="language" id="language" value="{{ old('language', 'ru') }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                    </div>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="is_hidden" id="is_hidden" value="1" @checked(old('is_hidden')) class="w-4 h-4 text-indigo-600 border-gray-300 rounded">
                    <label for="is_hidden" class="ml-2 block text-sm text-gray-900">Скрыть книгу</label>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 font-semibold text-white bg-green-600 rounded-lg hover:bg-green-700">
                        Создать книгу
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
