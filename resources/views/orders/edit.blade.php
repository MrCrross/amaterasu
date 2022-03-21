@extends('layouts.app')

@section('content')

    <div class="flex flex-row px-5 py-3 items-center justify-between align-middle shadow bg-gray-200 dark:bg-gray-700">
        <h2 class="text-xl text-gray-800 dark:text-gray-100 leading-tight">Редактирование записи</h2>
        <x-a.primary href="{{ route('orders.index') }}" class="flex items-center">Назад</x-a.primary>
    </div>

    @if (count($errors) > 0)
        <x-alert.danger>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </x-alert.danger>
    @endif

    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div
            class="w-full sm:max-w-md mt-3 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg dark:bg-gray-800 ">
            {!! Form::open(['route' => ['orders.update', $order->id],'method'=>'PATCH']) !!}
            <div class="my-1">
                <x-label for="client">Клиент</x-label>
                <x-select id="client" class="w-full" name="client_id" required>
                    @foreach($clients as $client)
                        <option value="{{$client->id}}"
                                @if($client->id === $order->client_id) selected @endif
                        >{{$client->last_name.' '.$client->first_name." (".$client->phone.")"}}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="my-1">
                <x-label for="worker">Работник</x-label>
                <x-select id="worker" class="w-full" name="worker_id" required>
                    @foreach($workers as $worker)
                        <option value="{{$worker->id}}"
                                @if($worker->id === $order->worker_id) selected @endif
                        >{{$worker->post->name.' '.$worker->last_name.' '.$worker->first_name}}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="my-1">
                <x-label for="service">Услуга</x-label>
                <x-select id="service" class="w-full" name="service_id"  required>
                    @foreach($services as $service)
                        <option value="{{$service->id}}"
                                @if($service->id === $order->service_id) selected @endif
                        >{{$service->name}}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="my-1">
                <x-label for="seance">Запись (Дата и время)</x-label>
                <div class="flex flex-row">
                    <x-input name="date" class="w-full mx-1" type="date"
                             value="{{mb_substr($order->seance,0,mb_stripos($order->seance,' '))}}"
                             pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"
                             min="{{date('Y-m-d')}}" required></x-input>
                    <x-input name="time" class="w-full mx-1" type="time"
                             value="{{mb_substr($order->seance,mb_stripos($order->seance,' '))}}"
                             min="07:00:00"
                             max="21:00:00"
                             required></x-input>
                </div>
            </div>
            <div class="mt-4 text-center">
                <x-btn.primary type="submit">
                    Изменить
                </x-btn.primary>
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection
