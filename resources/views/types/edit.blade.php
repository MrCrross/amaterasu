@extends('layouts.app')

@section('content')

    <div class="flex flex-row px-5 py-3 items-center justify-between align-middle shadow bg-gray-200 dark:bg-gray-700">
        <h2 class="text-xl text-gray-800 dark:text-gray-100 leading-tight">Редактирование типа услуг</h2>
        <x-a.primary href="{{ route('types.index') }}" class="flex items-center">Назад</x-a.primary>
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
            {!! Form::open(['route' => ['types.update', $type->id],'method'=>'PATCH']) !!}
            <div>
                <x-label for="name" :value="__('Название')"/>

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$type->name"
                         autofocus/>
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
