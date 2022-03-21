@extends('layouts.app')

@section('content')

    <div class="flex flex-row px-5 py-3 items-center justify-between align-middle shadow bg-gray-200 dark:bg-gray-700">
        <h2 class="text-xl text-gray-800 dark:text-gray-100 leading-tight">Журнал записей</h2>
        @can('order-create')
            <x-a.success href="{{ route('orders.create') }}" class="mr-2">Добавить</x-a.success>
        @endcan
    </div>

    @if ($message = Session::get('success'))
        <x-alert.success><p>{{ $message }}</p></x-alert.success>
    @endif
    <x-table>
        <x-table.head>
            <x-table.row-h>#</x-table.row-h>
            <x-table.row-h>Клиент</x-table.row-h>
            <x-table.row-h>Сотрудник</x-table.row-h>
            <x-table.row-h>Услуга</x-table.row-h>
            <x-table.row-h>Сеанс</x-table.row-h>
            <x-table.row-h>Действия</x-table.row-h>
        </x-table.head>
        <x-slot name="body">
            @foreach ($orders as $key => $order)
                <x-table.row>
                    <x-table.data>{{++$key}}</x-table.data>
                    <x-table.data>{{ $order->client->last_name." ".$order->client->first_name." (".$order->client->phone.")" }}</x-table.data>
                    <x-table.data>
                        {{ $order->worker->post->name." ".$order->worker->last_name." (".$order->worker->first_name.")" }}
                    </x-table.data>
                    <x-table.data>{{ $order->service->name }}</x-table.data>
                    <x-table.data>{{ $order->seance }}</x-table.data>
                    <x-table.data class="md:flex md:flex-col xl:block">
                        <x-a.info href="{{route('orders.show',$order->id)}}" class="xl:mx-1">Просмотр</x-a.info>
                        @can('order-edit')
                            <x-a.primary href="{{ route('orders.edit',$order->id) }}" class="md:mt-2 xl:mt-0 xl:mx-1">
                                Изменить
                            </x-a.primary>
                        @endcan
                        @can('order-delete')
                            {!! Form::open(['method' => 'DELETE','route' => ['orders.destroy', $order->id],'class'=>'m-0','style'=>'display:inline']) !!}
                            <x-btn.danger class="md:mt-2 xl:mt-0 xl:mx-1" type="submit">Отменить</x-btn.danger>
                            {!! Form::close() !!}
                        @endcan
                    </x-table.data>
                </x-table.row>
            @endforeach
        </x-slot>
    </x-table>

@endsection
