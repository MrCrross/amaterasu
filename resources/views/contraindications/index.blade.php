@extends('layouts.app')

@section('content')

    <div class="flex flex-row px-5 py-3 items-center justify-between align-middle shadow bg-gray-200 dark:bg-gray-700">
        <h2 class="text-xl text-gray-800 dark:text-gray-100 leading-tight">Управление противопоказания</h2>
        @can('contraindication-create')
            <x-a.success href="{{ route('contraindications.create') }}" class="flex items-center">Добавить</x-a.success>
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
            @foreach ($data as $key => $contraindication)
                <x-table.row>
                    <x-table.data>{{++$key}}</x-table.data>
                    <x-table.data>{{ $contraindication->name }}</x-table.data>
                    <x-table.data class="flex flex-row items-center w-20">
                        <x-a.info href="{{ route('contraindications.show',$contraindication->id) }}" class="mr-2 mb-3">Просмотр</x-a.info>
                        @can('contraindication-edit')
                            <x-a.primary href="{{ route('contraindications.edit',$contraindication->id) }}" class="mr-2 mb-3">Редактировать
                            </x-a.primary>
                        @endcan
                        @can('contraindication-delete')
                            {!! Form::open(['method' => 'DELETE','route' => ['contraindications.destroy', $contraindication->id]]) !!}
                            <x-btn.danger type="submit">Удалить</x-btn.danger>
                            {!! Form::close() !!}
                        @endcan
                    </x-table.data>
                </x-table.row>
            @endforeach
        </x-slot>
    </x-table>
@endsection
