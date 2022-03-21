@extends('layouts.app')

@section('content')

    <div class="flex flex-row px-5 py-3 items-center justify-between align-middle shadow bg-gray-200 dark:bg-gray-700">
        <h2 class="text-xl text-gray-800 dark:text-gray-100 leading-tight">Управление пользователями</h2>
        @can('user-create')
            <x-a.success href="{{ route('users.create') }}" class="flex items-center">Добавить</x-a.success>
        @endcan
    </div>

    @if ($message = Session::get('success'))
        <x-alert.success><p>{{ $message }}</p></x-alert.success>
    @endif
    <x-table>
        <x-table.head>
            <x-table.row-h>#</x-table.row-h>
            <x-table.row-h>Аватар</x-table.row-h>
            <x-table.row-h>Логин</x-table.row-h>
            <x-table.row-h>Роли</x-table.row-h>
            <x-table.row-h>Действия</x-table.row-h>
        </x-table.head>
        <x-slot name="body">
            @foreach ($data as $key => $user)
                <x-table.row>
                    <x-table.data>{{++$key}}</x-table.data>
                    <x-table.data>
                        <img class="w-16 h-16 rounded-full shadow-lg" src="{{asset($user->avatar)}}" alt="avatar"/>
                    </x-table.data>
                    <x-table.data>{{ $user->name }}</x-table.data>
                    <x-table.data>
                        @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $role)
                                <x-badge.success>{{ $role }}</x-badge.success>
                            @endforeach
                        @endif
                    </x-table.data>
                    <x-table.data>
                        <x-a.info href="{{ route('users.show',$user->id) }}" class="mr-2">Просмотр</x-a.info>
                        @can('user-edit')
                            <x-a.primary href="{{ route('users.edit',$user->id) }}" class="mr-2">Редактировать
                            </x-a.primary>
                        @endcan
                        @can('user-delete')
                            {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                            <x-btn.danger type="submit">Удалить</x-btn.danger>
                            {!! Form::close() !!}
                        @endcan
                    </x-table.data>
                </x-table.row>
            @endforeach
        </x-slot>
    </x-table>
    {{--    <div class="grid grid-cols-5">--}}
    {{--        @foreach ($data as $key => $user)--}}
    {{--            <x-card.user :user="$user"></x-card.user>--}}
    {{--        @endforeach--}}
    {{--    </div>--}}
@endsection
