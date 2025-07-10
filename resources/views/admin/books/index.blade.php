@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Управление книгами</h1>
            <a href="{{ route('admin.books.create') }}" class="px-4 py-2 font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">
                Добавить книгу
            </a>
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Название</th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Авторы</th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-center text-gray-500 uppercase">Глав</th>
                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Статус</th>
                        <th scope="col" class="relative px-6 py-3"><span class="sr-only">Действия</span></th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($books as $book)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $book->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $book->authors->pluck('name')->implode(', ') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">{{ $book->chapters_count }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($book->is_hidden)
                                    <span class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">Скрыто</span>
                                @else
                                    <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Опубликовано</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap space-x-4">
                                <a href="{{ route('admin.books.manage', $book) }}" class="text-green-600 hover:text-green-900">Управлять</a>
                                <a href="{{ route('admin.books.edit', $book) }}" class="text-indigo-600 hover:text-indigo-900">Редактировать</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">Книг для управления пока нет.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $books->links() }}
            </div>
        </div>
    </div>
@endsection
