@extends('layouts.app')

@section('content')

    <div class="w-full flex flex-col justify-center items-center align-middle">
        <x-head>
            Процедуры
            @can('service-create')
                <x-a.success href="{{route('services.create')}}" class="ml-5">
                    Добавить
                </x-a.success>
            @endcan
        </x-head>
       <x-link.service></x-link.service>
        <div class="block md:grid md:grid-cols-2 md:gap-3 lg:grid-cols-3">
            @foreach($types as $type)
                @guest
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
                @endguest
                @auth
                    @foreach($type->services as $service)
                        <x-card.service :service="$service"></x-card.service>
                    @endforeach
                @endauth
            @endforeach
        </div>
    </div>


@endsection
