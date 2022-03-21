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
            @can('order-worker-list')
                <x-table.row-h>Клиент</x-table.row-h>
            @endcan
            @can('order-client-list')
                <x-table.row-h>Сотрудник</x-table.row-h>
            @endcan
            <x-table.row-h>Услуга</x-table.row-h>
            <x-table.row-h>Сеанс</x-table.row-h>
            @can('order-worker-list')
                <x-table.row-h>Действия</x-table.row-h>
            @endcan
        </x-table.head>
        <x-slot name="body">
            @foreach ($orders as $key => $order)
                <x-table.row>
                    <x-table.data>{{++$key}}</x-table.data>
                    @can('order-worker-list')
                        <x-table.data>{{ $order->client->last_name." ".$order->client->first_name." (".$order->client->phone.")" }}</x-table.data>
                    @endcan
                    @can('order-client-list')
                        <x-table.data>
                            {{ $order->worker->post->name." ".$order->worker->last_name." (".$order->worker->first_name.")" }}
                        </x-table.data>
                    @endcan
                    <x-table.data>{{ $order->service->name }}</x-table.data>
                    <x-table.data>{{ $order->seance }}</x-table.data>
                    @can('order-worker-list')
                        <x-table.data>{!! Form::open(['method' => 'put','route' => ['orders.close', $order->id],'class'=>'m-0','style'=>'display:inline']) !!}
                            <x-btn.success class="xl:mx-1" type="submit">Выполнить</x-btn.success>
                            {!! Form::close() !!}</x-table.data>
                    @endcan
                </x-table.row>
            @endforeach
        </x-slot>
    </x-table>

@endsection
