@extends('layouts.app')

@section('content')
    <div class="w-full flex flex-col justify-center items-center align-middle">
        <x-head class="mb-5">
            Сотрудники
            @can('worker-create')
                <x-a.success href="{{route('workers.create')}}" class="ml-5">
                    Добавить
                </x-a.success>
            @endcan
        </x-head>
        <x-link.worker></x-link.worker>
        @foreach($posts as $post)
            <x-head class="mb-5">
                {{$post->name}}
            </x-head>
            <div class="block md:grid md:grid-cols-2 xl:grid-cols-3 md:gap-3">
                @foreach($post->workers as $worker)
                    <div class="h-96 w-64 block relative rounded-xl">
                        <a href="{{route('workers.show',$worker->id)}}">
                            <img src="{{asset($worker->img)}}" class="h-full w-full rounded-xl" alt="">
                        </a>
                        <div class="absolute block left-0 bottom-5 w-46 p-5 pb-7 text-bold text-white bg-gray-600 bg-opacity-50 rounded-r">
                            {{$worker->last_name." ".$worker->first_name}}
                            <div class="absolute block -bottom-2 left-5 p-1 text-sm text-white text-bold bg-amber-700 rounded">
                                {{$worker->post->name}}
                            </div>
                        </div>
                        @can('worker-edit')
                            <div class="absolute block right-2 top-4">
                                <x-a.primary class="bg-opacity-50 hover:bg-opacity-70 dark:bg-opacity-50 dark:hover:bg-opacity-70" href="{{route('workers.edit', $worker->id)}}">Изменить</x-a.primary>
                            </div>
                        @endcanany
                        @can('worker-delete')
                            <div class="absolute block right-2 top-12">
                                {!! Form::open(['method' => 'DELETE','route' => ['workers.destroy', $worker->id],'style'=>'display:inline']) !!}
                                <x-btn.danger  class="bg-opacity-50 hover:bg-opacity-70 dark:bg-opacity-50 dark:hover:bg-opacity-70" type="submit">Удалить</x-btn.danger>
                                {!! Form::close() !!}
                            </div>
                        @endcanany
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

@endsection
