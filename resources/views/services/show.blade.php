@extends('layouts.app')

@section('content')
    <div class="w-full md:container md:mx-auto flex flex-col justify-center items-center align-middle">
        <x-head>
            {{$service->name}}
            @can('service-edit')
                <x-a.primary href="{{route('services.edit',$service->id)}}" class="mx-2">Изменить</x-a.primary>
            @endcan
            @can('service-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['services.destroy', $service->id],'style'=>'display:inline']) !!}
                <x-btn.danger type="submit">Удалить</x-btn.danger>
                {!! Form::close() !!}
            @endcan
        </x-head>
        <x-link.service></x-link.service>
        <div class="m-5 relative">
            <div class = "max-h-[20rm]" >
                <img src="{{asset($service->img)}}" class="rounded w-full inline-block float-left mr-2 md:w-4/6 xl:w-2/6 xl:max-h-[350px]" alt="">
                <div><span class="text-sm md:text-lg text-amber-600 font-bold">Тип: <span class="text-gray-900 dark:text-white">{{$service->serviceType->name}}</span></span></div>
                <div><span class="text-sm md:text-lg text-amber-600 font-bold">Цена: <span class="text-gray-900 dark:text-white">{{$service->price}}</span> руб.</span></div>
                <div>
                    <span class="text-sm md:text-lg text-amber-600 font-bold">Описание:</span>
                    <p class="text-sm md:text-lg text-gray-900 dark:text-white">{!! $service->description!!}</p>
                </div>
            </div>
            @if(count($service->indications)!==0)
                <div class="flex flex-col w-full m-5">
                    <h2 class="text-lg text-bold text-amber-600">
                        Показания:
                    </h2>
                    <ul class="list-disc">
                        @foreach($service->indications as $indication)
                            <li class="ml-5 text-gray-900 dark:text-white">{{$indication->name}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(count($service->contraindications)!==0)
                <div class="w-full m-5">
                    <h2 class="text-lg text-bold text-amber-600 ">
                        Противопоказания:
                    </h2>
                    <ul class="list-disc">
                        @foreach($service->contraindications as $contraindication)
                            <li class="ml-5 text-gray-900 dark:text-white">{{$contraindication->name}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(count($service->workers)!==0)
                <div class="w-full m-5">
                    <h2 class="text-lg text-bold text-amber-600">
                        Специалисты:
                    </h2>
                    <div class="block md:grid md:grid-cols-2 xl:grid-cols-3 md:gap-3">
                        @foreach($service->workers as $worker)
                            <div class="h-96 w-64 block relative rounded-xl" >
                                <a href="{{route('workers.show',$worker->id)}}">
                                    <img src="{{asset($worker->img)}}" class="h-full w-full rounded-xl" alt="">
                                </a>
                                <div class="absolute block left-0 bottom-5 w-46 p-5 pb-7 text-bold text-white bg-gray-600 bg-opacity-50">
                                    {{$worker->last_name." ".$worker->first_name}}
                                    <div class="absolute block bottom-0 left-5 p-1 text-sm text-white text-bold bg-amber-300">
                                        {{$worker->post->name}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
    @auth
        @if(Auth::user()->hasRole('Клиент'))
            <div class="w-full text-center">
                {!! Form::open(['method' => 'post','route' => ['records.storeClient', Auth::user()->clients->pluck('id')->first()],'style'=>'display:inline']) !!}
                <input type="text" name="service_id" value="{{$service->id}}" readonly hidden>
                <x-btn.success type="submit">Оставить заявку</x-btn.success>
                {!! Form::close() !!}
            </div>
        @endif
    @endauth
    @guest
        <x-section type="1">
            <x-slot name="head">
                Оставьте заявку, мы перезвоним вам и подберем вам удобное время для приема
            </x-slot>
            <x-center-item>
                {!! Form::open(['id'=>'record-create','route' => 'records.store','method'=>'POST']) !!}
                <div>
                    <x-label for="last_name" :value="__('Ваша фамилия')"></x-label>
                    <x-input id="last_name" class="block mt-1 w-full"
                             type="text"
                             name="last_name"
                             placeholder="Фамилия*"
                             required></x-input>
                </div>
                <div class="mt-4">
                    <x-label for="first_name" :value="__('Ваше имя')"></x-label>
                    <x-input id="first_name" placeholder="Имя*" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required></x-input>
                    <input type="text" name="service_id" value="{{$service->id}}" required hidden>
                </div>
                <div class="mt-4">
                    <x-label for="email" :value="__('Почта')"></x-label>
                    <x-input id="email" placeholder="Почта*" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required></x-input>
                </div>
                <div class="mt-4">
                    <x-label for="phone" :value="__('Телефон')"></x-label>
                    <x-input id="phone" class="block mt-1 w-full"
                             placeholder="Телефон*"
                             type="tel"
                             name="phone" required></x-input>
                </div>
                <div class="mt-4 text-center">
                    <x-btn.success type="submit">
                        Оставить заявку
                    </x-btn.success>
                </div>

                {!! Form::close() !!}
            </x-center-item>
        </x-section>
    @endguest
@endsection
