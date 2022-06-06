@extends('layouts.app')
@section('content')

    <div class="flex flex-row px-5 py-3 items-center justify-between align-middle shadow bg-gray-200 dark:bg-gray-700">
        <h2 class="text-xl text-gray-800 dark:text-gray-100 leading-tight">Популярнейшие услуги</h2>
        <form class="flex flex-row items-center" action="{{route('static.index')}}">
            @csrf
            <div class="flex flex-col mr-1">
                <label class="text-sm mb-1" for="from">С</label>
                <x-input id="from" name="from" type="date" value="{{$min}}" min="{{$min}}" max="{{$max}}" />
            </div>
            <div class="flex flex-col ml-1">
                <label class="text-sm mb-1" for="to">По</label>
                <x-input id="to" name="to" type="date" value="{{$max}}" min="{{$min}}" max="{{$max}}" />
            </div>
            <x-button class="ml-1">Применить</x-button>
        </form>
    </div>
    <x-table>
        <x-table.head>
            <x-table.row-h>#</x-table.row-h>
            <x-table.row-h>Название услуг</x-table.row-h>
            <x-table.row-h>Количество раз(за период)</x-table.row-h>
        </x-table.head>
        <x-slot name="body">
            @foreach ($services as $key => $service)
                <x-table.row>
                    <x-table.data>{{++$key}}</x-table.data>
                    <x-table.data>{{$service->service->name}}</x-table.data>
                    <x-table.data>{{$service->count}}</x-table.data>
                </x-table.row>
            @endforeach
        </x-slot>
    </x-table>
@endsection
