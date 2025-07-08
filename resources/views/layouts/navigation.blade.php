<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        {{-- Ваш логотип или название сайта --}}
                        <span class="text-2xl font-bold text-indigo-700">{{ config('app.name', 'Мой Сайт') }}</span>
                        {{-- Если хотите использовать компонент Breeze: --}}
                        {{-- <x-application-logo class="block h-9 w-auto fill-current text-gray-800" /> --}}
                    </a>
                </div>

                {{-- Форма поиска --}}
                <form action="{{ route('search') }}" method="GET" class="flex-grow max-w-md mx-4 self-center">
                    <div class="relative">
                        <input type="search" name="query" placeholder="Поиск по статьям и книгам..."
                               class="w-full pl-10 pr-4 py-2 rounded-lg border-2 border-gray-300 focus:outline-none focus:bg-indigo-50 focus:border-indigo-500"
                               value="{{ request('query') }}">
                        <button type="submit" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                    </div>
                </form>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Главная') }}
                    </x-nav-link>

                    <x-nav-link :href="route('authors.index')" :active="request()->routeIs('authors.index')">
                        {{ __('Авторы') }}
                    </x-nav-link>

                    <x-nav-link :href="route('books.index')" :active="request()->routeIs('books.index')">
                        {{ __('Книги') }}
                    </x-nav-link>

                    <x-nav-link :href="route('articles.index')" :active="request()->routeIs('articles.index')">
                        {{ __('Статьи') }}
                    </x-nav-link>

                    @auth
                        {{-- Если пользователь АДМИН, показываем ссылку на Админ-панель --}}
                        @if (Auth::user()->is_admin)
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                                {{ __('Админ-панель') }}
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            @auth
                                <div>{{ Auth::user()->name }}</div>
                            @else
                                <div class="text-gray-600 hover:text-indigo-700">Вход / Регистрация</div>
                            @endauth
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @auth
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Профиль') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Выход') }}
                                </x-dropdown-link>
                            </form>
                        @else
                            {{-- Ссылки Вход/Регистрация в ВЫПАДАЮЩЕМ МЕНЮ для ГОСТЕЙ --}}
                            <x-dropdown-link :href="route('login')">
                                {{ __('Вход') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('register')">
                                {{ __('Регистрация') }}
                            </x-dropdown-link>
                        @endauth
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Главная') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('authors.index')" :active="request()->routeIs('authors.index')">
                {{ __('Авторы') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('books.index')" :active="request()->routeIs('books.index')">
                {{ __('Книги') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('articles.index')" :active="request()->routeIs('articles.index')">
                {{ __('Статьи') }}
            </x-responsive-nav-link>
            @auth
                {{-- Если пользователь АДМИН, показываем ссылку на Админ-панель --}}
                @if (Auth::user()->is_admin)
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Админ-панель') }}
                    </x-responsive-nav-link>
                @endif
            @else
                <x-responsive-nav-link :href="route('login')">
                    {{ __('Вход') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')">
                    {{ __('Регистрация') }}
                </x-responsive-nav-link>
            @endauth
        </div>

        {{-- ПРАВИЛЬНЫЙ БЛОК --}}
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Профиль') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                               onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Выход') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
    @endauth
</nav>
