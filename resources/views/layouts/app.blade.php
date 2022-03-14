<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://unpkg.com/flowbite@1.3.4/dist/flowbite.js"></script>
    <script src="https://unpkg.com/imask"></script>
    <script src="{{asset('js/toast.js')}}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link type="image/png" rel="icon" href="{{asset('storage/logo.png')}}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="font-sans antialiased bg-gray-100 relative dark:bg-gray-900">
<div class="absolute top-0 bottom-0 right-0 left-0 -z-50 bg-gray-100 dark:bg-gray-900"></div>
<x-toast.success></x-toast.success>
<x-toast.danger></x-toast.danger>
<nav class="sticky top-0 z-40 bg-white px-2 sm:px-4 py-2.5 dark:bg-gray-800">
    <div class="container flex flex-wrap justify-between items-center mx-auto">
        <a href="/" class="flex items-center">
            <img src="{{asset('storage/logo.png')}}" class="mr-3 h-16 sm:h-16" alt="Amaterasu Logo"/>
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white
@if(request()->routeIs('main')) border-b-2 dark:border-white border-black @endif">Amaterasu</span>
        </a>
        <div class="hidden justify-between items-center w-full md:flex md:w-auto md:order-1" id="mobile-menu-2">
            <ul class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium">
                @guest
                    <li>
                        <x-menu-item link="/service" :active="request()->routeIs('service')">Услуги</x-menu-item>
                    </li>
                    <li>
                        <x-menu-item link="/service" :active="request()->routeIs('service')">Наши сотрудники
                        </x-menu-item>
                    </li>
                @endguest
                @can('user-list')
                    <li>
                        <x-menu-item link="{{ route('users.index') }}" :active="request()->routeIs('users.index')">
                            Пользователи
                        </x-menu-item>
                    </li>
                    <li>
                        <x-menu-item link="{{ route('roles.index') }}" :active="request()->routeIs('roles.index')">
                            Роли
                        </x-menu-item>
                    </li>
                @endcan
            </ul>
        </div>
        <div class="flex items-center md:order-2">
            <x-theme class="mr-2"></x-theme>
            @auth
                <button type="button"
                        class="flex mr-3 border-0 text-sm bg-white dark:bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                        id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
                    <x-avatar class="w-8 h-8 rounded-full" id="user-avatar" fill="#000000"></x-avatar>
                </button>
                <!-- Dropdown menu -->
                <div
                    class="hidden z-50 my-4 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
                    id="dropdown">
                    <div class="py-3 px-4">
                        <span class="block text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                        <span class="block text-sm font-medium text-gray-500 truncate dark:text-gray-400">
                            @foreach(Auth::user()->getRoleNames() as $role)
                                {{ucfirst($role).`\n`}}
                            @endforeach
                        </span>
                    </div>
                    <ul class="py-1" aria-labelledby="dropdown">
                        @can('admin_panel')
                            <li>
                                <a href="/admin"
                                   class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Панель
                                    администратора</a>
                            </li>
                        @endcan
                        <li>
                            <a href="/lk"
                               class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Личный
                                кабинет</a>
                        </li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}"
                                  method="POST" class="hidden">
                                @csrf
                            </form>
                            <a type="button" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                               class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Выйти</a>
                        </li>
                    </ul>
                </div>
                <button data-collapse-toggle="mobile-menu-2" type="button"
                        class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                </button>
            @else
                <ul class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium">
                    <li>
                        <x-menu-item link="/login" active="request()->routeIs('login')">Войти</x-menu-item>
                    </li>
                    <li>
                        <x-menu-item link="/register" active="request()->routeIs('register')">Регистрация</x-menu-item>
                    </li>
                </ul>
            @endauth
        </div>

    </div>
</nav>

<main>
    @yield('content')
</main>

</body>

<script src="{{asset('js/toggle-theme.js')}}"></script>
<script>
    const phones = document.querySelectorAll('input[type="tel"]')
    phones.forEach(function (el) {
        const maskOptions = {
            mask: '+{7}(000)000-00-00'
        };
        IMask(el, maskOptions);
    })
</script>
</html>
