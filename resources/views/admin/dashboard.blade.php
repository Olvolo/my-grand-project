@extends('layouts.app')

@section('content')
    <div class="bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-6">Панель Администратора</h1>
        <p class="text-gray-700 text-lg">
            Добро пожаловать в панель администратора! Здесь вы можете управлять контентом сайта.
        </p>
        {{-- TODO: Добавить ссылки на управление статьями, книгами, пользователями --}}
        <div class="mt-6">
            <a href="{{ route('home') }}" class="text-indigo-600 hover:underline">Вернуться на главную</a>
        </div>
    </div>
@endsection
