@extends('layouts.app')

@section('content')

    <div class="flex flex-row px-5 py-3 items-center justify-between align-middle shadow bg-gray-200 dark:bg-gray-700">
        <h2 class="text-xl text-gray-800 dark:text-gray-100 leading-tight">Просмотр записи</h2>
        <x-a.primary href="{{ route('orders.index') }}" class="flex items-center">Назад</x-a.primary>
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
                <x-table.row>
                    <x-table.data>1</x-table.data>
                    <x-table.data>{{ $order->client->last_name." ".$order->client->first_name." (".$order->client->phone.")" }}</x-table.data>
                    <x-table.data>
                        {{ $order->worker->post->name." ".$order->worker->last_name." (".$order->worker->first_name.")" }}
                    </x-table.data>
                    <x-table.data>{{ $order->service->name }}</x-table.data>
                    <x-table.data>{{ $order->seance }}</x-table.data>
                    <x-table.data class="md:flex md:flex-col xl:block">
                        {!! Form::open(['method' => 'put','route' => ['orders.close', $order->id],'class'=>'m-0','style'=>'display:inline']) !!}
                        <x-btn.success class="xl:mx-1" type="submit">Выполнить</x-btn.success>
                        {!! Form::close() !!}
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
        </x-slot>
    </x-table>

@endsection
