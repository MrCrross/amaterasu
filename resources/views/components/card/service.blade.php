@props(['service'])

<div class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
    <a href="{{route('services.show',$service->id)}}">
        <img class="rounded-t-lg h-44 w-full" src="{{asset($service->img)}}" alt=""/>
    </a>
    <div class="h-64 flex flex-col justify-evenly">
        <div class="px-3">
            <x-label class="md:text-lg text-sm font-bold" value="Название: "></x-label>
            <a href="{{route('services.show',$service->id)}}">
                <p class="font-normal tracking-tight text-gray-900 dark:text-white border-b-2 border-transparent hover:border-b-2 hover:border-amber-800 dark:hover:border-amber-300">{{$service->name}}</p>
            </a>
        </div>
        <div class="px-3">
            <x-label class="md:text-lg text-sm font-bold" value="Тип услуги: "></x-label>
            <p class="font-normal md:text-lg text-sm text-gray-800 dark:text-gray-50">{{$service->serviceType->name}}</p>
        </div>
        <div class="px-3">
            <x-label class="md:text-lg text-sm font-bold" value="Цена: "></x-label>
            <p class="font-bold md:text-lg text-sm text-gray-800 dark:text-gray-50">{{$service->price}} руб.</p>
        </div>
        <div class="px-3">
            @if(request()->routeIs('main'))
                @guest
                    <x-btn.success type="button" data-modal-toggle="record-modal"
                                   onclick="localStorage.setItem('service_id',{{$service->id}});localStorage.setItem('service_name','{{$service->name}}'); change();">
                        Оставить заявку
                    </x-btn.success>
                @endguest
                @if(Auth::check() and Auth::user()->hasRole('Клиент'))
                    {!! Form::open(['method' => 'post','route' => ['records.storeClient', Auth::user()->clients->pluck('id')->first()],'style'=>'display:inline']) !!}
                    <input type="text" name="service_id" value="{{$service->id}}" readonly hidden>
                    <x-btn.success type="submit">Оставить заявку</x-btn.success>
                    {!! Form::close() !!}
                @endif
            @endif
            @if(!request()->routeIs('main'))
                @can('service-edit')
                    <x-a.primary href="{{route('services.edit',$service->id)}}" class="mr-2">Редактировать</x-a.primary>
                @endcan
                @can('service-delete')
                    {!! Form::open(['method' => 'DELETE','route' => ['services.destroy', $service->id],'style'=>'display:inline']) !!}
                    <x-btn.danger type="submit">Удалить</x-btn.danger>
                    {!! Form::close() !!}
                @endcan
            @endif
        </div>
    </div>
</div>
