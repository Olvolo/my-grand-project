@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Добавление нового автора</h1>

            <form action="{{ route('admin.authors.store') }}" method="POST" class="p-6 bg-white rounded-lg shadow-md space-y-6">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Имя автора</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div>
                    <label for="order_column" class="block text-sm font-medium text-gray-700">Порядок сортировки</label>
                    <input type="number" name="order_column" id="order_column" value="{{ old('order_column', $author->order_column ?? 0) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="bio" class="block text-sm font-medium text-gray-700">Биография (Markdown)</label>
                    <textarea name="bio" id="bio" rows="10" class="markdown-editor block w-full mt-1 border-gray-300 rounded-md shadow-sm">{{ old('bio') }}</textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 font-semibold text-white bg-green-600 rounded-lg hover:bg-green-700">
                        Создать автора
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
