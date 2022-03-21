@extends('layouts.app')

@section('content')
    <div class="flex flex-row px-5 py-3 items-center justify-between align-middle shadow bg-gray-200 dark:bg-gray-700">
        <h2 class="text-xl text-gray-800 dark:text-gray-100 leading-tight">Добавление показания</h2>
        <x-a.primary href="{{ route('indications.index') }}" class="flex items-center">Назад</x-a.primary>
    </div>

    @if (count($errors) > 0)
        <x-alert.danger>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </x-alert.danger>
    @endif
    <x-center-item>
        {!! Form::open(['route' => 'indications.store','method'=>'POST']) !!}
        <div>
            <x-label for="name" :value="__('Название')"></x-label>

            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                     autofocus></x-input>
        </div>
        <div class="mt-4 text-center">
            <x-btn.success type="submit">
                Добавить
            </x-btn.success>
        </div>

        {!! Form::close() !!}
    </x-center-item>
@endsection
