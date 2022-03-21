@extends('layouts.app')

@section('content')
    <div class="flex flex-row px-5 py-3 items-center justify-between align-middle shadow bg-gray-200 dark:bg-gray-700">
        <h2 class="text-xl text-gray-800 dark:text-gray-100 leading-tight">Добавление роли</h2>
        <x-a.primary href="{{ route('roles.index') }}" class="flex items-center">Назад</x-a.primary>
    </div>

    @if (count($errors) > 0)
        <x-alert.danger>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </x-alert.danger>
    @endif

    <x-center-item>
            {!! Form::open(['route' => 'roles.store','method'=>'POST']) !!}
            <div>
                <x-label for="name" :value="__('Название')"/>
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                         autofocus/>
            </div>

            <div class="mt-4">
                <h2 class="text-xl text-gray-800 dark:text-gray-100 leading-tight">Права доступа:</h2>
                @foreach($permission as $value)
                    <x-checkbox name="permission[]" :value="$value->id">{{ $value->name }}</x-checkbox>
                @endforeach
            </div>
            <div class="mt-4 text-center">
                <x-btn.success type="submit">
                    Добавить
                </x-btn.success>
            </div>

            {!! Form::close() !!}
    </x-center-item>

@endsection
