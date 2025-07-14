<header x-data="{ open: false }" class="w-full bg-white/95 backdrop-blur-sm border-b border-gray-200 shadow-sm sticky top-0 z-50">
    {{-- Контейнер для содержимого навигации --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Основная строка навигации --}}
        <div class="flex justify-between items-center min-h-[4rem]">
            {{-- Логотип --}}
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center">
                    <span class="text-2xl font-bold text-indigo-700">ТД</span>
                </a>
            </div>

            {{-- Десктопное меню --}}
            <nav class="hidden lg:flex lg:items-center lg:space-x-8">
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')">Главная</x-nav-link>
                <x-nav-link :href="route('tradition.index')" :active="request()->routeIs('tradition.index')">Традиция</x-nav-link>
                <x-nav-link :href="route('authors.show', 'bidiya-dandaron')" :active="request()->is('authors/bidiya-dandaron*')">Б.Д. Дандарон</x-nav-link>
                <x-nav-link :href="route('authors.index')" :active="request()->routeIs('authors.index')">Лики Традиции</x-nav-link>
                <x-nav-link :href="route('teaching.index')" :active="request()->routeIs('teaching.index')">Учение</x-nav-link>
                <x-nav-link :href="route('history.index')" :active="request()->routeIs('history.index')">История</x-nav-link>
                <x-nav-link :href="route('materials.index')" :active="request()->routeIs('materials.index')">Доп. материалы</x-nav-link>
                <x-nav-link :href="route('contacts')" :active="request()->routeIs('contacts')">Контакты</x-nav-link>
            </nav>

            {{-- Пользовательское меню (десктоп) --}}
            <div class="hidden lg:flex lg:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                            @auth
                                @php($user = auth()->user())
                                @if($user instanceof \App\Models\User)
                                    <span>{{ $user->name }}</span>
                                @else
                                    <span>Пользователь</span>
                                @endif
                            @else
                                <span>Меню</span>
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
                            @php($user = auth()->user())
                            @if($user instanceof \App\Models\User && $user->is_admin)
                                <x-dropdown-link :href="route('admin.dashboard')">Админ-панель</x-dropdown-link>
                            @endif
                            <x-dropdown-link :href="route('profile.edit')">Профиль</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition">
                                    Выход
                                </button>
                            </form>
                        @else
                            <x-dropdown-link :href="route('login')">Вход</x-dropdown-link>
                            <x-dropdown-link :href="route('register')">Регистрация</x-dropdown-link>
                        @endauth
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- Кнопка мобильного меню --}}
            <div class="lg:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Мобильное меню --}}
        <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">Главная</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('tradition.index')" :active="request()->routeIs('tradition.index')">Традиция</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('authors.show', 'bidiya-dandaron')" :active="request()->is('authors/bidiya-dandaron*')">Б.Д. Дандарон</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('authors.index')" :active="request()->routeIs('authors.index')">Лики Традиции</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('teaching.index')" :active="request()->routeIs('teaching.index')">Учение</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('history.index')" :active="request()->routeIs('history.index')">История</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('materials.index')" :active="request()->routeIs('materials.index')">Доп. материалы</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('contacts')" :active="request()->routeIs('contacts')">Контакты</x-responsive-nav-link>
            </div>

            {{-- Пользовательское меню (мобильное) --}}
            <div class="pt-4 pb-3 border-t border-gray-200">
                @auth
                    @php($user = auth()->user())
                    @if($user instanceof \App\Models\User)
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">{{ $user->name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ $user->email }}</div>
                        </div>
                        <div class="mt-3 px-2 space-y-1">
                            @if($user->is_admin)
                                <x-responsive-nav-link :href="route('admin.dashboard')">Админ-панель</x-responsive-nav-link>
                            @endif
                            <x-responsive-nav-link :href="route('profile.edit')">Профиль</x-responsive-nav-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-3 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-50 focus:outline-none focus:text-gray-800 focus:bg-gray-50 transition">
                                    Выход
                                </button>
                            </form>
                        </div>
                    @endif
                @else
                    <div class="px-2 space-y-1">
                        <x-responsive-nav-link :href="route('login')">Вход</x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('register')">Регистрация</x-responsive-nav-link>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</header>
