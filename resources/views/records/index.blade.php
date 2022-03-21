@extends('layouts.app')

@section('content')
    <div class="flex flex-row px-5 py-3 items-center justify-between align-middle shadow bg-gray-200 dark:bg-gray-700">
        <h2 class="text-xl text-gray-800 dark:text-gray-100 leading-tight">Управление заявками</h2>
    </div>

    @if ($message = Session::get('success'))
        <x-alert.success><p>{{ $message }}</p></x-alert.success>
    @endif
    <x-table>
        <x-table.head>
            <x-table.row-h>#</x-table.row-h>
            <x-table.row-h>ФИО</x-table.row-h>
            <x-table.row-h>Телефон</x-table.row-h>
            <x-table.row-h>Услуга</x-table.row-h>
            <x-table.row-h>Сотрудник</x-table.row-h>
            <x-table.row-h>Сеанс</x-table.row-h>
            <x-table.row-h>Действия</x-table.row-h>
        </x-table.head>
        <x-slot name="body">
            @foreach ($records as $key => $record)
                <x-table.row>
                    {!! Form::open(['method' => 'patch','route' => ['records.update', $record->id],'style'=>'display:inline']) !!}
                    <x-table.data>{{++$key}}</x-table.data>
                    <x-table.data>{{ $record->last_name." ".$record->first_name }}</x-table.data>
                    <x-table.data class="flex flex-col">
                        {{ $record->phone }}
                        <x-a.info href="tel:{{ $record->phone }}" class="mt-2">Позвонить</x-a.info>
                    </x-table.data>
                    <x-table.data>{{ $record->service->name }}</x-table.data>
                    <x-table.data>
                        <x-select name="worker_id" class="w-full">
                            @foreach($record->service->workers as $worker)
                                <option
                                    value="{{$worker->id}}">{{$worker->post->name." ".$worker->last_name." ".$worker->first_name}}</option>
                            @endforeach
                        </x-select>
                    </x-table.data>
                    <x-table.data>
                        <x-input name="date" class="w-full" type="date"
                                 value="{{date('Y-m-d')}}"
                                 pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"
                                 min="{{date('Y-m-d')}}" required></x-input>
                        <x-input name="time" class="w-full mt-1 " type="time"
                                 value="{{date('H:i:')}}00"
                                 min="07:00:00"
                                 max="21:00:00"
                                 required></x-input>
                    </x-table.data>
                    <x-table.data>
                        <x-btn.success type="submit">Принять заявку</x-btn.success>
                    </x-table.data>
                    {!! Form::close() !!}
                </x-table.row>
            @endforeach
        </x-slot>
    </x-table>

@endsection
