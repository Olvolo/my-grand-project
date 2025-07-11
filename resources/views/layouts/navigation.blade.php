{{--<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">--}}
{{--    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">--}}
{{--        <div class="flex justify-between h-16">--}}
{{--            <div class="flex">--}}
{{--                <div class="shrink-0 flex items-center">--}}
{{--                    <a href="{{ route('home') }}">--}}
{{--                        <span class="text-2xl font-bold text-indigo-700">{{ config('app.name', 'Мой Сайт') }}</span>--}}
{{--                    </a>--}}
{{--                </div>--}}

{{--                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">--}}
{{--                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">--}}
{{--                        {{ __('Главная') }}--}}
{{--                    </x-nav-link>--}}
{{--                    <x-nav-link :href="route('tradition.index')" :active="request()->routeIs('tradition.index')">--}}
{{--                        {{ __('Традиция') }}--}}
{{--                    </x-nav-link>--}}
{{--                    <x-nav-link :href="route('authors.show', 'bidiya-dandaron')" :active="request()->is('authors/bidiya-dandaron*')">--}}
{{--                        {{ __('Б.Д. Дандарон') }}--}}
{{--                    </x-nav-link>--}}
{{--                    <x-nav-link :href="route('authors.index')" :active="request()->routeIs('authors.index')">--}}
{{--                        {{ __('Лики Традиции') }}--}}
{{--                    </x-nav-link>--}}
{{--                    <x-nav-link :href="route('teaching.index')" :active="request()->routeIs('teaching.index')">--}}
{{--                        {{ __('Учение') }}--}}
{{--                    </x-nav-link>--}}
{{--                    <x-nav-link :href="route('history.index')" :active="request()->routeIs('history.index')">--}}
{{--                        {{ __('История') }}--}}
{{--                    </x-nav-link>--}}
{{--                    <x-nav-link :href="route('materials.index')" :active="request()->routeIs('materials.index')">--}}
{{--                        {{ __('Доп. материалы') }}--}}
{{--                    </x-nav-link>--}}
{{--                    <x-nav-link :href="route('contacts')" :active="request()->routeIs('contacts')">--}}
{{--                        {{ __('Контакты') }}--}}
{{--                    </x-nav-link>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="-mr-2 flex items-center sm:hidden">--}}
{{--                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">--}}
{{--                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">--}}
{{--                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />--}}
{{--                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />--}}
{{--                    </svg>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">--}}
{{--        <div class="pt-2 pb-3 space-y-1">--}}
{{--            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')"> {{ __('Главная') }} </x-responsive-nav-link>--}}
{{--            <x-responsive-nav-link :href="route('tradition.index')" :active="request()->routeIs('tradition.index')"> {{ __('Традиция') }} </x-responsive-nav-link>--}}
{{--            <x-responsive-nav-link :href="route('authors.show', 'bidiya-dandaron')" :active="request()->is('authors/bidiya-dandaron*')"> {{ __('Б.Д. Дандарон') }} </x-responsive-nav-link>--}}
{{--            <x-responsive-nav-link :href="route('authors.index')" :active="request()->routeIs('authors.index')"> {{ __('Лики Традиции') }} </x-responsive-nav-link>--}}
{{--            <x-responsive-nav-link :href="route('teaching.index')" :active="request()->routeIs('teaching.index')"> {{ __('Учение') }} </x-responsive-nav-link>--}}
{{--            <x-responsive-nav-link :href="route('history.index')" :active="request()->routeIs('history.index')"> {{ __('История') }} </x-responsive-nav-link>--}}
{{--            <x-responsive-nav-link :href="route('materials.index')" :active="request()->routeIs('materials.index')"> {{ __('Доп. материалы') }} </x-responsive-nav-link>--}}
{{--            <x-responsive-nav-link :href="route('contacts')" :active="request()->routeIs('contacts')"> {{ __('Контакты') }} </x-responsive-nav-link>--}}
{{--        </div>--}}

{{--    </div>--}}
{{--</nav>--}}

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <span class="text-2xl font-bold text-indigo-700">{{ config('app.name', 'Мой Сайт') }}</span>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Главная') }}
                    </x-nav-link>
                    <x-nav-link :href="route('tradition.index')" :active="request()->routeIs('tradition.index')">
                        {{ __('Традиция') }}
                    </x-nav-link>
                    <x-nav-link :href="route('authors.show', 'bidiya-dandaron')" :active="request()->is('authors/bidiya-dandaron*')">
                        {{ __('Б.Д. Дандарон') }}
                    </x-nav-link>
                    <x-nav-link :href="route('authors.index')" :active="request()->routeIs('authors.index')">
                        {{ __('Лики Традиции') }}
                    </x-nav-link>
                    <x-nav-link :href="route('teaching.index')" :active="request()->routeIs('teaching.index')">
                        {{ __('Учение') }}
                    </x-nav-link>
                    <x-nav-link :href="route('history.index')" :active="request()->routeIs('history.index')">
                        {{ __('История') }}
                    </x-nav-link>
                    <x-nav-link :href="route('materials.index')" :active="request()->routeIs('materials.index')">
                        {{ __('Доп. материалы') }}
                    </x-nav-link>
                    <x-nav-link :href="route('contacts')" :active="request()->routeIs('contacts')">
                        {{ __('Контакты') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            @auth
                                @php($user = auth()->user())
                                @if ($user instanceof \App\Models\User)
                                    <span>{{ $user->name }}</span>
                                @endif
                            @else
                                <span class="text-gray-600 hover:text-indigo-700">Меню</span>
                            @endauth

                            <span class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            </span>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        @auth
                            @php($user = auth()->user())
                            @if($user instanceof \App\Models\User && $user->is_admin)
                                <x-dropdown-link :href="route('admin.dashboard')">
                                    Админ-панель
                                </x-dropdown-link>
                            @endif
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Профиль') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" @click.prevent="$el.closest('form').submit()">
                                    {{ __('Выход') }}
                                </x-dropdown-link>
                            </form>
                        @else
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
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')"> {{ __('Главная') }} </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('tradition.index')" :active="request()->routeIs('tradition.index')"> {{ __('Традиция') }} </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('authors.show', 'bidiya-dandaron')" :active="request()->is('authors/bidiya-dandaron*')"> {{ __('Б.Д. Дандарон') }} </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('authors.index')" :active="request()->routeIs('authors.index')"> {{ __('Лики Традиции') }} </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('teaching.index')" :active="request()->routeIs('teaching.index')"> {{ __('Учение') }} </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('history.index')" :active="request()->routeIs('history.index')"> {{ __('История') }} </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('materials.index')" :active="request()->routeIs('materials.index')"> {{ __('Доп. материалы') }} </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contacts')" :active="request()->routeIs('contacts')"> {{ __('Контакты') }} </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
                @php($user = auth()->user())
                @if($user instanceof \App\Models\User)
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800">{{ $user->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ $user->email }}</div>
                    </div>
                    <div class="mt-3 space-y-1">
                        @if($user->is_admin)
                            <x-responsive-nav-link :href="route('admin.dashboard')">
                                {{ __('Админ-панель') }}
                            </x-responsive-nav-link>
                        @endif
                        <x-responsive-nav-link :href="route('profile.edit')"> {{ __('Профиль') }} </x-responsive-nav-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-responsive-nav-link :href="route('logout')" @click.prevent="$el.closest('form').submit()">
                                {{ __('Выход') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                @endif
            @else
                <div class="py-1 border-t border-gray-200">
                    <x-responsive-nav-link :href="route('login')"> {{ __('Вход') }} </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')"> {{ __('Регистрация') }} </x-responsive-nav-link>
                </div>
            @endauth
        </div>
    </div>
</nav>
