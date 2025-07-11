@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <h1 class="mb-6 text-3xl font-bold text-gray-800">
                Редактирование главы: {{ $chapter->title }}
            </h1>

            <form action="{{ route('admin.chapters.update', $chapter) }}" method="POST" class="p-6 bg-white rounded-lg shadow-md space-y-6">
                @csrf
                @method('PATCH')

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Заголовок главы</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $chapter->title) }}" class="markdown-editor block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                </div>

                <div>
                    <label for="content_markdown" class="block text-sm font-medium text-gray-700">Содержимое (Markdown)</label>
                    <textarea name="content_markdown" id="content_markdown" rows="20" class="markdown-editor block w-full mt-1 border-gray-300 rounded-md shadow-sm">{{ old('content_markdown', $chapter->content_markdown) }}</textarea>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="is_hidden" id="is_hidden" value="1" @checked(old('is_hidden', $chapter->is_hidden)) class="w-4 h-4 text-indigo-600 border-gray-300 rounded">
                    <label for="is_hidden" class="ml-2 block text-sm text-gray-900">Скрыть главу</label>
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
