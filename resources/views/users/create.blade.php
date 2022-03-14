@extends('layouts.app')

@section('content')
    <div class="flex flex-row px-5 py-3 items-center justify-between align-middle shadow bg-gray-200 dark:bg-gray-700">
        <h2 class="text-xl text-gray-800 dark:text-gray-100 leading-tight">Добавление пользователя</h2>
        <x-a.primary href="{{ route('users.index') }}" class="flex items-center">Назад</x-a.primary>
    </div>

    @if (count($errors) > 0)
        <x-alert.danger>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </x-alert.danger>
    @endif
    <x-center-item>
        {!! Form::open(['route' => 'users.store','method'=>'POST']) !!}
        <div>
            <x-label for="name" :value="__('Логин')"/>

            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
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
                     required autocomplete="new-password"/>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-label for="password_confirmation" :value="__('Повторите пароль')"/>

            <x-input id="password_confirmation" class="block mt-1 w-full"
                     type="password"
                     name="password_confirmation" required/>
        </div>
        <div class="mt-4">
            <x-label for="roles" :value="__('Роли')"/>
            <x-select id="roles" name="roles[]" multiple required>
                @foreach($roles as $role)
                    <option value="{{$role}}">{{$role}}</option>
                @endforeach
            </x-select>
        </div>
        <div class="mt-4 text-center">
            <x-btn.success type="submit">
                Добавить
            </x-btn.success>
        </div>

        {!! Form::close() !!}
    </x-center-item>
@endsection
