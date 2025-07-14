@extends('layouts.app')

@section('content')
    {{-- Приветственный блок --}}
    <div class="text-center mt-12 mb-24">
        <h1 class="text-4xl font-extrabold text-sky-900 sm:text-5xl md:text-6xl drop-shadow-lg
        mt-12">
            Традиция Дандарона
        </h1>
        <p class="max-w-md mx-auto text-sky-950 sm:text-lg md:mt-5 md:max-w-3xl
        drop-shadow-md">
            Посвящается Бидии Дандаровичу Дандарону и его последователям,<br>чей духовный подвиг
            неоценим.
        </p>
    </div>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 text-center">
        <a href="{{ route('tradition.index') }}" class="relative block overflow-hidden rounded-lg shadow-lg group">
            <img src="{{ asset('images/tradition_background.webp') }}" alt="Традиция" class="absolute inset-0
            object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
            <div class="absolute inset-0 bg-black bg-opacity-30"></div>
            <div class="relative flex flex-col items-center justify-center h-full p-6 text-center">
                <h2 class="text-3xl font-bold text-brand-cream" style="text-shadow: 1px 1px 3px
                rgba(0,0,0,0.5);">Традиция</h2>
                <p class="mt-2 text-brand-cream" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.5);">
                    Преемственность, линия Учителей.</p>
            </div>
        </a>

        <a href="{{ route('authors.show', 'bidiya-dandaron') }}" class="relative block overflow-hidden rounded-lg shadow-lg group">
            <img src="{{ asset('images/Dandaron_background.webp') }}" alt="Б. Д. Дандарон" class="absolute inset-0 object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
            <div class="relative flex flex-col items-center justify-center h-full p-6 text-center">
                <h2 class="text-3xl font-bold text-brand-cream" style="text-shadow: 1px 1px 3px
                rgba(0,0,0,0.5);">Б. Д. Дандарон</h2>
                <p class="mt-2 text-brand-cream" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.5);">
                    Биография, работы, статьи об Учителе.</p>
            </div>
        </a>

        <a href="{{ route('authors.index') }}" class="relative block overflow-hidden rounded-lg
        shadow-lg group">
            <img src="{{ asset('images/authors_background.webp') }}" alt="Лики Традиции" class="absolute inset-0 object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
            <div class="relative flex flex-col items-center justify-center h-full p-6 text-center">
                <h2 class="text-3xl font-bold text-brand-cream" style="text-shadow: 1px 1px 3px
                rgba(0,0,0,0.5);">Лики Традиции</h2>
                <p class="mt-2 text-brand-cream" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.5);">
                    Ученики и последователи.</p>
            </div>
        </a>

        <a href="{{ route('teaching.index') }}" class="relative block overflow-hidden rounded-lg shadow-lg group">
            <img src="{{ asset('images/dharma_background.webp') }}" alt="Учение" class="absolute inset-0
            object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
            <div class="relative flex flex-col items-center justify-center h-full p-6 text-center">
                <h2 class="text-3xl font-bold text-brand-cream" style="text-shadow: 1px 1px 3px
                rgba(0,0,0,0.5);">Учение</h2>
                <p class="mt-2 text-brand-cream" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.5);">
                    Философия, Сутра, Тантра, Садханы.</p></div>
        </a>

        <a href="{{ route('history.index') }}" class="relative block overflow-hidden rounded-lg shadow-lg group">
            <img src="{{ asset('images/history_background.webp') }}" alt="История" class="absolute inset-0 object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
            <div class="relative flex flex-col items-center justify-center h-full p-6 text-center">
                <h2 class="text-3xl font-bold text-brand-cream" style="text-shadow: 1px 1px 3px
                rgba(0,0,0,0.5);">История</h2>
                <p class="mt-2 text-brand-cream" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.5);">
                    История буддизма и не только.</p>
            </div>
        </a>

        <a href="{{ route('materials.index') }}" class="relative block overflow-hidden rounded-lg shadow-lg group">
            <img src="{{ asset('images/materials_background.webp') }}" alt="Дополнения" class="absolute inset-0 object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
            <div class="relative flex flex-col items-center justify-center h-full p-6 text-center">
                <h2 class="text-3xl font-bold text-brand-cream" style="text-shadow: 1px 1px 3px
                rgba(0,0,0,0.5);">Дополнения</h2>
                <p class="mt-2 text-brand-cream" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.5);">
                    Материалы из других источников.</p>
            </div>
        </a>
    </div>
@endsection
