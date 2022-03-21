@extends('layouts.app')

@section('content')

    <div class="w-full md:container md:mx-auto flex flex-col justify-center items-center align-middle">
        <x-head>
            {{$worker->last_name." ".$worker->first_name}}
            @can('worker-edit')
                <x-a.primary href="{{route('workers.edit',$worker->id)}}" class="mx-2">Изменить</x-a.primary>
            @endcan
            @can('worker-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['workers.destroy', $worker->id],'style'=>'display:inline']) !!}
                <x-btn.danger type="submit">Удалить</x-btn.danger>
                {!! Form::close() !!}
            @endcan
        </x-head>
        <x-link.worker></x-link.worker>
        <div class="m-5 relative">
            <div>
                <img src="{{asset($worker->img)}}" class="rounded inline-block md:float-right" alt="">
                <div><span class="text-sm md:text-lg text-amber-600 font-bold">Должность: <span
                            class="text-gray-900 dark:text-white">{{$worker->post->name}}</span></span></div>
                <div><span class="text-sm md:text-lg text-amber-600 font-bold">Возраст: <span
                            class="text-gray-900 dark:text-white">{{$age}}</span></span></div>
                <div>
                    <span class="text-sm md:text-lg text-amber-600 font-bold">Описание:</span>
                    <p class="text-sm md:text-lg text-gray-900 dark:text-white">{!! $worker->description!!}</p>
                </div>
            </div>
        </div>
        @if(count($types)!==0)
            <x-head>
                Услуги специалиста
            </x-head>
            <div class="block md:grid md:grid-cols-2 xl:grid-cols-3 md:gap-3">
                @foreach($types as $type)
                    <x-card.list class="mx-2 mt-5">
                        <div class="mb-2">
                            <h3 class="font-bold text-lg md:text-2xl text-gray-900 dark:text-white">{{$type->name}}</h3>
                        </div>
                        <ul class="list-disc">
                            @foreach($type->services as $service)
                                <li class="ml-5 text-gray-900 dark:text-white">
                                    <a href="{{route('services.show',$service->id)}}"
                                       class="font-normal tracking-tight text-gray-900 dark:text-white hover:border-b-2 hover:border-amber-800 dark:hover:border-amber-300">
                                        {{$service->name}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </x-card.list>
                @endforeach
            </div>
        @endif
    </div>
@endsection
