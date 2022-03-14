@props(['service'])

<div class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
    <a href="/service/{{$service->id}}">
        <img class="rounded-t-lg h-44 w-full" src="{{asset($service->img)}}" alt=""/>
    </a>
    <div class="h-64 flex flex-col justify-evenly">
        <div class="px-3">
            <x-label class="md:text-lg text-sm font-bold" value="Название: "></x-label>
            <a href="/service/{{$service->id}}">
                <p class="font-normal tracking-tight text-gray-900 dark:text-white">{{$service->name}}</p>
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
            <x-btn.success type="button" data-modal-toggle="record-modal" onclick="localStorage.service_id = {{$service->id}};localStorage.service_name='{{$service->name}}';">
                Оставить заявку
            </x-btn.success>
        </div>
    </div>
</div>
