@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Редактирование тега</h1>
            <form action="{{ route('admin.tags.update', $tag) }}" method="POST" class="p-6 bg-white rounded-lg shadow-md space-y-6">
                @csrf
                @method('PATCH')
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Название тега</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $tag->name) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">Сохранить</button>
                </div>
            </form>
            <div class="mt-6 pt-6 border-t border-gray-200">
                <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST" onsubmit="return confirm('Вы уверены?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-800">Удалить тег</button>
                </form>
            </div>
        </div>
    </div>
@endsection
