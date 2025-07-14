<header x-data="{ open: false }" class="w-full bg-sky-700/95 backdrop-blur-sm border-b border-sky-700 shadow-sm sticky top-0 z-50">
    {{-- Контейнер для содержимого навигации --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Основная строка навигации --}}
        <div class="flex justify-between items-center min-h-[4rem]">
            {{-- Логотип --}}
            <div class="shrink-0 flex items-center">
                <a href="{{ route('home') }}">
                    <img class="block h-10 w-auto" src="{{ asset('images/logo.webp') }}" alt="Логотип Вишваваджра">
                </a>
            </div>

            {{-- Десктопное меню --}}
            <nav class="hidden lg:flex lg:items-center lg:space-x-8">
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')">Главная</x-nav-link>
                <x-nav-link :href="route('tradition.index')" :active="request()->routeIs('tradition.index')">Традиция</x-nav-link>
                <x-nav-link :href="route('authors.show', 'bidiya-dandaron')" :active="request()->is('authors/bidiya-dandaron*')">Дандарон</x-nav-link>
                <x-nav-link :href="route('authors.index')" :active="request()->routeIs('authors.index')">Лики Традиции</x-nav-link>
                <x-nav-link :href="route('teaching.index')" :active="request()->routeIs('teaching.index')">Учение</x-nav-link>
                <x-nav-link :href="route('history.index')" :active="request()->routeIs('history.index')">История</x-nav-link>
                <x-nav-link :href="route('materials.index')" :active="request()->routeIs('materials.index')">Дополнения</x-nav-link>
                <x-nav-link :href="route('contacts')" :active="request()->routeIs('contacts')">Контакты</x-nav-link>
            </nav>

            {{-- Пользовательское меню (десктоп) --}}
            <div class="hidden lg:flex lg:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-brand-cream bg-sky-800 hover:text-amber-500 focus:outline-none transition">
                            @auth
                                @php($user = auth()->user())
                                @if($user instanceof \App\Models\User)
                                    <span>{{ $user->name }}</span>
                                @else
                                    <span>Пользователь</span>
                                @endif
                            @else
                                <span>Вход</span>
                            @endauth
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="rounded-md border border-amber-500/50 py-1 bg-sky-800/95 backdrop-blur-md shadow-lg">
                            @auth
                                @php($user = auth()->user())
                                @if($user instanceof \App\Models\User && $user->is_admin)
                                    <x-dropdown-link :href="route('admin.dashboard')">Админ-панель</x-dropdown-link>
                                @endif
                                <x-dropdown-link :href="route('profile.edit')">Профиль</x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                                     as="button"
                                                     @click.prevent="$el.closest('form').submit()">
                                        Выход
                                    </x-dropdown-link>
                                </form>
                            @else
                                <x-dropdown-link :href="route('login')">Вход</x-dropdown-link>
                                <x-dropdown-link :href="route('register')">Регистрация</x-dropdown-link>
                            @endauth
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- Кнопка мобильного меню --}}
            <div class="lg:hidden flex items-center">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-brand-cream hover:text-amber-400 hover:bg-sky-900/50 focus:ring focus:ring-amber-400 focus:ring-offset-2 focus:ring-offset-sky-700/95 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Мобильное меню --}}
        <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">Главная</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('tradition.index')" :active="request()->routeIs('tradition.index')">Традиция</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('authors.show', 'bidiya-dandaron')" :active="request()->is('authors/bidiya-dandaron*')">Дандарон</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('authors.index')" :active="request()->routeIs('authors.index')">Лики Традиции</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('teaching.index')" :active="request()->routeIs('teaching.index')">Учение</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('history.index')" :active="request()->routeIs('history.index')">История</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('materials.index')" :active="request()->routeIs('materials.index')">Дополнения</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('contacts')" :active="request()->routeIs('contacts')">Контакты</x-responsive-nav-link>
            </div>

            {{-- Пользовательское меню (мобильное) --}}
            <div class="pt-4 pb-3 border-t border-sky-700">
                @auth
                    @php($user = auth()->user())
                    @if($user instanceof \App\Models\User)
                        <div class="px-4">
                            <div class="font-medium text-base text-brand-cream">{{ $user->name }}</div>
                            <div class="font-medium text-sm text-sky-200">{{ $user->email }}</div>
                        </div>
                        <div class="mt-3 space-y-1">
                            @if($user->is_admin)
                                <x-responsive-nav-link :href="route('admin.dashboard')">Админ-панель</x-responsive-nav-link>
                            @endif
                            <x-responsive-nav-link :href="route('profile.edit')">Профиль</x-responsive-nav-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-responsive-nav-link :href="route('logout')"
                                                           as="button"
                                                           @click.prevent="$el.closest('form').submit()">
                                        Выход
                                    </x-responsive-nav-link>
                                </form>
                        </div>
                    @endif
                @else
                    <div class="space-y-1">
                        <x-responsive-nav-link :href="route('login')">Вход</x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('register')">Регистрация</x-responsive-nav-link>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</header>
