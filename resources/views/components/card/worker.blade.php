@props(['worker'])

<div class="h-96 w-64 block relative rounded-xl">
    <a href="{{route('workers.show',$worker->id)}}">
        <img src="{{asset($worker->img)}}" class="h-full w-full rounded-xl" alt="">
    </a>
    <div
        class="absolute block left-0 bottom-5 w-46 p-5 pb-7 text-bold text-white bg-gray-600 bg-opacity-50 rounded-r">
        {{$worker->last_name." ".$worker->first_name}}
        <div class="absolute block -bottom-2 left-5 p-1 text-sm text-white text-bold bg-amber-700 rounded">
            {{$worker->post->name}}
        </div>
    </div>
    @can('worker-edit')
        <div
            class="absolute block left-0 bottom-5 w-46 p-5 pb-7 text-bold text-white bg-gray-600 bg-opacity-50">
            <x-a.primary href="{{route('workers.edit', $worker->id)}}">Изменить</x-a.primary>
        </div>
    @endcanany
    @can('worker-delete')
        <div
            class="absolute block left-0 bottom-5 w-46 p-5 pb-7 text-bold text-white bg-gray-600 bg-opacity-50">
            {!! Form::open(['method' => 'DELETE','route' => ['workers.destroy', $worker->id],'style'=>'display:inline']) !!}
            <x-btn.danger type="submit">Удалить</x-btn.danger>
            {!! Form::close() !!}
        </div>
    @endcanany
</div>
