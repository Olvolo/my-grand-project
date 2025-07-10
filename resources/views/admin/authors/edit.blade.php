@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Редактирование автора</h1>

            <form action="{{ route('admin.authors.update', $author) }}" method="POST" class="p-6 bg-white rounded-lg shadow-md space-y-6">
                @csrf
                @method('PATCH')
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Имя автора</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $author->name) }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div>
                    <label for="bio" class="block text-sm font-medium text-gray-700">Биография (Markdown)</label>
                    <textarea name="bio" id="bio" rows="10" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">{{ old('bio', $author->bio) }}</textarea>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="is_teacher" id="is_teacher" value="1" @checked(old('is_teacher', $author->is_teacher)) class="w-4 h-4 text-indigo-600 border-gray-300 rounded">
                    <label for="is_teacher" class="ml-2 block text-sm text-gray-900">Является Учителем</label>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">
                        Сохранить изменения
                    </button>
                </div>
            </form>
        </div>
        <div class="mt-6 pt-6 border-t border-gray-200">
            <h3 class="text-lg font-medium text-red-600">Опасная зона</h3>
            <form action="{{ route('admin.authors.destroy', $author) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить этого автора?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700">
                    Удалить автора
                </button>
            </form>
        </div>
    </div>
@endsection
