@extends('layouts.app')

@section('content')

    <div class="flex flex-row px-5 py-3 items-center justify-between align-middle shadow bg-gray-200 dark:bg-gray-700">
        <h2 class="text-xl text-gray-800 dark:text-gray-100 leading-tight">Управление ролями</h2>
        @can('role-create')
        <x-a.success href="{{ route('roles.create') }}" class="flex items-center">Добавить</x-a.success>
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
            @foreach ($roles as $key => $role)
                <x-table.row>
                    <x-table.data>{{++$key}}</x-table.data>
                    <x-table.data>{{ $role->name }}</x-table.data>
                    <x-table.data>
                        <x-a.info href="{{ route('roles.show',$role->id) }}" class="mr-2">Просмотр</x-a.info>
                        @can('role-edit')
                            <x-a.primary href="{{ route('roles.edit',$role->id) }}" class="mr-2">Редактировать
                            </x-a.primary>
                        @endcan
                        @can('role-delete')
                            {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                            <x-btn.danger type="submit">Удалить</x-btn.danger>
                            {!! Form::close() !!}
                        @endcan
                    </x-table.data>
                </x-table.row>
            @endforeach
        </x-slot>
    </x-table>
@endsection
