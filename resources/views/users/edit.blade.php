@extends('layouts.app')

@section('content')

    <div class="flex flex-row px-5 py-3 items-center justify-between align-middle shadow bg-gray-200 dark:bg-gray-700">
        <h2 class="text-xl text-gray-800 dark:text-gray-100 leading-tight">Редактирование пользователя</h2>
        <x-a.primary href="{{ route('users.index') }}" class="flex items-center">Назад</x-a.primary>
    </div>

    @if (count($errors) > 0)
        <x-alert.danger>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </x-alert.danger>
    @endif

    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div
            class="w-full sm:max-w-md mt-3 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg dark:bg-gray-800 ">
            {!! Form::open(['route' => ['users.update', $user->id],'method'=>'PATCH']) !!}
            <div>
                <x-label for="name" :value="__('Логин')"/>

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$user->name"
                         autofocus/>
            </div>
            <!-- Image -->
            <div class="mt-4">
                <x-file id="avatar" name="avatar"></x-file>
            </div>
            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Пароль')"/>

                <x-input id="password" class="block mt-1 w-full"
                         type="password"
                         name="password"
                         autocomplete="new-password"/>
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Повторите пароль')"/>

                <x-input id="password_confirmation" class="block mt-1 w-full"
                         type="password"
                         name="password_confirmation"/>
            </div>
            <div class="mt-4">
                <x-label for="roles" :value="__('Роли')"/>
                <x-select id="roles" name="roles[]" multiple>
                    @foreach($roles as $role)
                        <option value="{{$role}}" @if(array_search($role,$userRole)) {{'selected'}} @endif >{{$role}}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="mt-4 text-center">
                <x-btn.primary type="submit">
                    Изменить
                </x-btn.primary>
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection
