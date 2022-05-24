@extends('layouts.app')

@section('content')

    <div class="flex flex-row px-5 py-3 items-center justify-between align-middle shadow bg-gray-200 dark:bg-gray-700">
        <h2 class="text-xl text-gray-800 dark:text-gray-100 leading-tight">Управление должностями</h2>
        @can('post-create')
            <x-a.success href="{{ route('posts.create') }}" class="flex items-center">Добавить</x-a.success>
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
            @foreach ($data as $key => $post)
                <x-table.row>
                    <x-table.data>{{++$key}}</x-table.data>
                    <x-table.data>{{ $post->name }}</x-table.data>
                    <x-table.data>
                        <x-a.info href="{{ route('posts.show',$post->id) }}" class="mr-2">Просмотр</x-a.info>
                        @can('post-edit')
                            <x-a.primary href="{{ route('posts.edit',$post->id) }}" class="mr-2">Редактировать
                            </x-a.primary>
                        @endcan
                        @can('post-delete')
                            {!! Form::open(['method' => 'DELETE','route' => ['posts.destroy', $post->id],'style'=>'display:inline']) !!}
                            <x-btn.danger type="submit">Удалить</x-btn.danger>
                            {!! Form::close() !!}
                        @endcan
                    </x-table.data>
                </x-table.row>
            @endforeach
        </x-slot>
    </x-table>
@endsection
