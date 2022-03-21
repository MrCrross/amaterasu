@extends('layouts.app')

@section('content')

    <div class="flex flex-row px-5 py-3 items-center justify-between align-middle shadow bg-gray-200 dark:bg-gray-700">
        <h2 class="text-xl text-gray-800 dark:text-gray-100 leading-tight">Управление типами услуг</h2>
        @can('type-create')
            <x-a.success href="{{ route('types.create') }}" class="flex items-center">Добавить</x-a.success>
        @endcan
    </div>

    @if ($message = Session::get('success'))
        <x-alert.success><p>{{ $message }}</p></x-alert.success>
    @endif
    <x-table>
        <x-table.head>
            <x-table.row-h>#</x-table.row-h>
            <x-table.row-h>Название</x-table.row-h>
            <x-table.row-h>Действия</x-table.row-h>
        </x-table.head>
        <x-slot name="body">
            @foreach ($data as $key => $type)
                <x-table.row>
                    <x-table.data>{{++$key}}</x-table.data>
                    <x-table.data>{{ $type->name }}</x-table.data>
                    <x-table.data class="w-20">
                        <x-a.info href="{{ route('types.show',$type->id) }}" class="mr-2">Просмотр</x-a.info>
                        @can('type-edit')
                            <x-a.primary href="{{ route('types.edit',$type->id) }}" class="mr-2">Редактировать
                            </x-a.primary>
                        @endcan
                        @can('type-delete')
                            {!! Form::open(['method' => 'DELETE','route' => ['types.destroy', $type->id],'style'=>'display:inline']) !!}
                            <x-btn.danger type="submit">Удалить</x-btn.danger>
                            {!! Form::close() !!}
                        @endcan
                    </x-table.data>
                </x-table.row>
            @endforeach
        </x-slot>
    </x-table>
@endsection
