@extends('layouts.app')

@section('content')
    <div class="flex flex-row px-5 py-3 items-center justify-between align-middle shadow bg-gray-200 dark:bg-gray-700">
        <h2 class="text-xl text-gray-800 dark:text-gray-100 leading-tight">Личные данные</h2>
    </div>

    <div class="w-full">
        <div
            class="max-w-sm mx-auto mt-5 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            <div class="flex justify-end px-4 pt-4">
                <button id="dropdownUser{{$auth->id}}" data-dropdown-toggle="dropdown{{$auth->id}}"
                        class="hidden sm:inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5"
                        type="button">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdown{{$auth->id}}"
                     class="hidden z-10 w-44 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                    <ul class="py-1" aria-labelledby="dropdownButton{{$auth->id}}">
                        <li>
                            <a href="{{ route('lk.edit',$auth->id) }}"
                               class="block py-2 px-4 text-sm text-amber-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-amber-400 dark:hover:text-white">Изменить</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="flex flex-col items-center pb-10">
                <div>
                    <img class="mb-3 w-24 h-24 rounded-full shadow-lg" src="{{asset($auth->avatar)}}" alt="avatar"/>
                </div>
                <div>
                    <div>
                        <span class="font-bold text-gray-900 dark:text-white">Логин:</span>
                        <span class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$auth->name}}</span>
                    </div>
                    @if(!is_null($user))
                        <div>
                            <span class="font-bold text-gray-900 dark:text-white">Фамилия:</span>
                            <span
                                class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$user->last_name}}</span>
                        </div>
                        <div>
                            <span class="font-bold text-gray-900 dark:text-white">Имя:</span>
                            <span
                                class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$user->first_name}}</span>
                        </div>
                        <div>
                            @if(is_null($user->birthday))
                                @php $user->birthday='Не указано' @endphp
                            @else
                                @php $user->birthday=date_format(date_create($user->birthday),'d.m.Y') @endphp
                            @endif
                            <span class="font-bold text-gray-900 dark:text-white">Дата рождения:</span>
                            <span
                                class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$user->birthday}}</span>
                        </div>
                        @if(!empty($user->phone))
                            <div>
                                <span class="font-bold text-gray-900 dark:text-white">Телефон:</span>
                                <span
                                    class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$user->phone}}</span>
                            </div>
                        @endif
                    @endif
                    <div class="mt-2">
                        @if(!empty($auth->getRoleNames()))
                            @foreach($auth->getRoleNames() as $role)
                                <x-badge.success>{{ $role }}</x-badge.success>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
