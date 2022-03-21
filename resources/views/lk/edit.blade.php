@extends('layouts.app')

@section('content')
    <div class="w-full text-center">
        @if(!is_null($user))
            <x-head>Редактирование личных данных <b>{{$user->last_name." ".$user->first_name}}</b></x-head>
        @else
            <x-head>Редактирование личных данных <b>{{$auth->name}}</b></x-head>
        @endif
    </div>
    <div id="editContainer"
         class="w-full md:container md:mx-auto mt-5 mb-10 flex flex-col justify-center align-middle">
        {!! Form::open(['method' => 'patch','route' => ['lk.update',$auth->id],'enctype'=>'multipart/form-data']) !!}
        <div class="block md:flex md:flex-row w-full">
            <div class="w-full md:w-96 p-4 dark:bg-gray-800 bg-white md:rounded-lg">
                <div class="flex flex-col">
                    <div class="inline-flex justify-center">
                        <div id="temp-img"
                             class="w-4/6 h-72 flex items-center justify-center border-2 border-gray-400 border-dashed hidden">
                            <x-svg.x fill="rgb(156,163,175)" width="36" height="36"/>
                        </div>
                        @if(!empty($user->img))
                            <img id="img"
                                 class="h-72 rounded-lg ring-1 ring-amber-600 shadow-lg shadow-gray-200 dark:shadow-gray-800"
                                 src="{{asset($user->img)}}" alt="{{$user->last_name." ".$user->first_name}}">
                        @else
                            <img id="img"
                                 class="h-72 rounded-lg ring-1 ring-amber-600 shadow-lg shadow-gray-200 dark:shadow-gray-800"
                                 src="{{asset($auth->avatar)}}" alt="{{$auth->name}}">
                        @endif
                    </div>
                    <div class="inline-flex items-center justify-center mt-2 ">
                        <label class="w-36 relative flex flex-row p-2 rounded-2xl
                    items-center justify-center cursor-pointer
                    shadow shadow-gray-200 dark:shadow-gray-800 hover:bg-amber-700 bg-amber-600"
                               title="Добавить изображение">
                            <svg class="fill-gray-100 dark:fill-gray-900" height="18" viewBox="0 0 24 24" width="18"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9 16h6v-6h4l-7-7-7 7h4zm-4 2h14v2H5z"/>
                            </svg>
                            <span class="px-2 text-gray-100 dark:text-gray-900">Файла нет</span>
                            @if(!empty($user->img))
                                <input type='file' name="img" id="file" class="absolute top-1 w-1 -z-10"
                                       accept="image/jpeg, image/png"/>
                            @else
                                <input type='file' name="avatar" id="file" class="absolute top-1 w-1 -z-10"
                                       accept="image/jpeg, image/png"/>
                            @endif
                        </label>
                    </div>
                </div>
            </div>
            <div class="block w-full md:flex md:flex-row text-left md:justify-between">
                <div class="mt-4 md:mt-0 w-full md:mx-5">
                    <div class="text-center">
                        <x-label for="name" :value="__('Учетная запись')"></x-label>
                    </div>
                    <div class="mt-4">
                        <x-label for="name" :value="__('Логин')"></x-label>
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$auth->name"
                                 autofocus></x-input>
                    </div>
                @if(!empty($user->img))
                    <!-- Image -->
                        <div class="mt-4">
                            <x-label for="avatar" :value="__('Аватар')"></x-label>

                            <img id="img"
                                 class="h-24 rounded-lg ring-1 ring-amber-600 shadow-lg shadow-gray-200 dark:shadow-gray-800"
                                 src="{{asset($auth->avatar)}}" alt="{{$auth->name}}">

                            <x-file id="avatar" name="avatar"></x-file>
                        </div>
                @endif
                <!-- Password -->
                    <div class="mt-4">
                        <x-label for="password" :value="__('Пароль')"></x-label>
                        <x-input id="password" class="block mt-1 w-full"
                                 type="password"
                                 name="password"
                                 autocomplete="new-password"></x-input>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-label for="password_confirmation" :value="__('Повторите пароль')"></x-label>
                        <x-input id="password_confirmation" class="block mt-1 w-full"
                                 type="password"
                                 name="password_confirmation"></x-input>
                    </div>
                </div>
                @if(!is_null($user))
                    <div class="mt-4 md:mt-0 w-full md:mx-5">
                        <div class="text-center">
                            <x-label for="name" :value="__('Личные данные')"></x-label>
                        </div>
                        <div class="mt-4">
                            <x-label for="last_name" class="ml-3">Фамилия</x-label>
                            <x-input id="last_name" class="mt-2 w-full"
                                     type="text"
                                     name="last_name"
                                     value="{{$user->last_name}}"
                                     maxlength="255"
                                     placeholder="Фамилия"
                                     required></x-input>
                        </div>
                        <div class="mt-4">
                            <x-label for="first_name" class="ml-3">Имя</x-label>
                            <x-input id="first_name" class="mt-2 w-full"
                                     type="text"
                                     name="first_name"
                                     value="{{$user->first_name}}"
                                     maxlength="255"
                                     placeholder="Имя"
                                     required></x-input>
                        </div>

                        <div class="mt-4">
                            <x-label for="birthday" class="ml-3">Дата рождения</x-label>
                            <x-input id="birthday" class="mt-2 w-full"
                                     type="date"
                                     name="birthday"
                                     value="{{$user->birthday}}"
                                     max="{{date('Y-m-d')}}"
                                     pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"
                                     placeholder="Дата рождения"
                                     required></x-input>
                        </div>
                        @if(!empty($user->phone))
                            <div class="mt-4">
                                <x-label for="phone" class="ml-3">Телефон</x-label>
                                <x-input id="phone" class="mt-2 w-full"
                                         type="tel"
                                         name="phone"
                                         value="{{$user->phone}}"
                                         maxlength="255"
                                         placeholder="Имя"
                                         required></x-input>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
        <div class="mt-5 text-center">
            <x-btn.primary type="submit">Изменить</x-btn.primary>
        </div>

        {!! Form::close() !!}
    </div>

    <script src="{{asset('js/img.js')}}"></script>
@endsection
