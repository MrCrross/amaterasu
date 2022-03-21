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
@if ($message = Session::get('success'))
    <x-toast.success id="toast-session-success">{!! $message !!}</x-toast.success>
@endif
@if ($message = Session::get('danger'))
    <x-toast.danger id="toast-session-danger">{!! $message !!}</x-toast.danger>
@endif
<x-toast.success class="hidden" id="toast-success"></x-toast.success>
<x-toast.danger class="hidden" id="toast-danger"></x-toast.danger>
<nav class="sticky top-0 z-40 bg-white px-2 sm:px-4 py-2.5 dark:bg-gray-800">
    <div class="container flex flex-wrap justify-between items-center mx-auto">
        <a href="/" class="flex items-center">
            <img src="{{asset('storage/logo.png')}}" class="mr-3 h-16 sm:h-16" alt="Amaterasu Logo"/>
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white
@if(request()->routeIs('main')) border-b-2 dark:border-white border-black @endif">Amaterasu</span>
        </a>
        <div class="flex items-center md:order-2">
            <x-theme class="mr-2"></x-theme>
            @auth
                <button type="button"
                        class="flex mr-3 border-0 text-sm bg-white dark:bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                        id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
                    <span class="sr-only">Открыть меню</span>
                    <img src="{{asset(Auth::user()->avatar)}}" class="rounded-full w-10 h-10"
                         alt="{{Auth::user()->name}}">
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
                        <li>
                            <a href="{{route('lk.index',Auth::user()->id)}}"
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
            @endauth
            <button data-collapse-toggle="mobile-menu-2" type="button"
                    class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="mobile-menu-2" aria-expanded="false">
                <span class="sr-only">Открыть меню</span>
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
        </div>
        <div class="hidden justify-between items-center w-full md:flex md:w-auto md:order-1" id="mobile-menu-2">
            <ul class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium">
                @if(!Auth::check() or Auth::user()->hasRole('Клиент'))
                    <li>
                        <x-menu-item link="{{route('services.index')}}" :active="request()->routeIs('services.index')">
                            Услуги
                        </x-menu-item>
                    </li>
                    <li>
                        <x-menu-item link="{{route('workers.index')}}" :active="request()->routeIs('workers.index')">
                            Наши сотрудники
                        </x-menu-item>
                    </li>
                    @if(Auth::check() and count(Auth::user()->clients->pluck('id')->toArray())!==0)
                        @can('order-client-list')
                            <li>
                                <x-menu-item
                                    link="{{route('orders.record',Auth::user()->clients->pluck('id')->toArray())}}"
                                    :active="request()->routeIs('orders.record')">
                                    Моя запись
                                </x-menu-item>
                            </li>
                        @endcan
                    @endif
                @endif
                @guest
                    <li>
                        <x-menu-item link="{{route('login')}}" active="request()->routeIs('login')">Вход</x-menu-item>
                    </li>
                    <li>
                        <x-menu-item link="{{route('register')}}" active="request()->routeIs('register')">Регистрация
                        </x-menu-item>
                    </li>
                @endguest
                @auth
                    @canany(['service-create','service-edit','service-destroy'])
                        <li>
                            <x-menu-item link="{{route('services.index')}}"
                                         :active="request()->routeIs('services.index')">
                                Услуги
                            </x-menu-item>
                        </li>
                    @endcanany
                    @canany(['worker-create','worker-edit','worker-destroy'])
                        <li>
                            <x-menu-item link="{{route('workers.index')}}"
                                         :active="request()->routeIs('workers.index')">
                                Сотрудники
                            </x-menu-item>
                        </li>
                    @endcanany
                    @can('order-list')
                        <li>
                            <x-menu-item link="{{route('orders.index')}}" :active="request()->routeIs('orders.index')">
                                Запись
                            </x-menu-item>
                        </li>
                    @endcan
                    @if(count(Auth::user()->workers->pluck('id')->toArray())!==0)
                        @can('order-worker-list')
                            <li>
                                <x-menu-item
                                    link="{{route('orders.schedule',Auth::user()->workers->pluck('id')->toArray()[0])}}"
                                    :active="request()->routeIs('orders.schedule')">
                                    Моё расписание
                                </x-menu-item>
                            </li>
                        @endcanany
                    @endif
                    @can('record-list')
                        <li>
                            <x-menu-item link="{{route('records.index')}}"
                                         :active="request()->routeIs('records.index')">
                                Заявки
                            </x-menu-item>
                        </li>
                    @endcan
                    @can('user-list')
                        <li>
                            <x-menu-item link="{{route('users.index')}}" :active="request()->routeIs('users.index')">
                                Пользователи
                            </x-menu-item>
                        </li>
                    @endcan
                    @can('role-list')
                        <li>
                            <x-menu-item link="{{ route('roles.index') }}" :active="request()->routeIs('roles.index')">
                                Роли
                            </x-menu-item>
                        </li>
                    @endcan
                @endauth
            </ul>
        </div>
    </div>
</nav>

<main>
    @yield('content')
</main>

</body>

<script src="{{asset('js/toggle-theme.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const phones = document.querySelectorAll('input[type="tel"]')
        phones.forEach(function (el) {
            const maskOptions = {
                mask: '+{7}(000)000-00-00'
            };
            IMask(el, maskOptions);
        })
        const numbers = document.querySelectorAll('input[type="number"]')
        numbers.forEach(function (el) {
            const maskOptions = {
                mask: Number,
                min: 1,
                max: Number.MAX_SAFE_INTEGER,
            };
            IMask(el, maskOptions);
        })
        const txs = document.querySelectorAll("textarea");
        txs.forEach(function (tx) {
            tx.setAttribute("style", "height:" + (tx.scrollHeight) + "px;overflow-y:hidden;");
            tx.addEventListener("input", OnInput);
        })

        function OnInput() {
            this.style.height = "auto";
            this.style.height = (this.scrollHeight) + "px";
        }
    })
</script>
</html>
