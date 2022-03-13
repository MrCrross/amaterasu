@extends('layouts.app')

@section('content')

    <div class="flex flex-row px-5 py-3 items-center justify-between align-middle shadow bg-gray-200 dark:bg-gray-700">
        <h2 class="text-xl text-gray-800 dark:text-gray-100 leading-tight">Редактирование роль</h2>
        <x-a.primary href="{{ route('roles.index') }}" class="flex items-center">Назад</x-a.primary>
    </div>

    <x-accordion class="m-2" id="accordion-collapse" type="collapse">
        <x-accordion.body id="1">
            <x-slot name="head">{{$role->name}}</x-slot>
            <h2 class="text-xl text-gray-800 dark:text-gray-100 leading-tight">Права доступа:</h2>
            @if(!empty($rolePermissions))
                @foreach($rolePermissions as $v)
                        <x-badge.success>{{ $v->name }}</x-badge.success>,
                @endforeach
            @endif
        </x-accordion.body>
    </x-accordion>
@endsection
