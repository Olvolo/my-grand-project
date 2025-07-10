@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Создание нового тега</h1>
            <form action="{{ route('admin.tags.store') }}" method="POST" class="p-6 bg-white rounded-lg shadow-md">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Название тега</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="flex justify-end mt-6">
                    <button type="submit" class="px-6 py-2 font-semibold text-white bg-green-600 rounded-lg hover:bg-green-700">Создать</button>
                </div>
            </form>
        </div>
    </div>
@endsection
