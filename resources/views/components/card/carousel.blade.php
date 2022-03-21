@props(['service'])

<a href="{{route('services.show',$service->id)}}" class="flex flex-col justify-evenly p-1 md:p-5 max-w-sm bg-gray-100 bg-opacity-50 dark:bg-opacity-50
dark:bg-gray-600 rounded-lg shadow-md hover:shadow-lg dark:border-gray-700 ">
    <div>
        <x-label class="md:text-lg text-sm font-bold" value="Название: "></x-label>
        <p class="font-bold text-sm md:text-lg text-gray-900 dark:text-white border-b-2 border-transparent hover:border-b-2 hover:border-amber-800 dark:hover:border-amber-300">{{$service->name}}</p>
    </div>
    <div>
        <x-label class="md:text-lg text-sm font-bold" value="Тип услуги: "></x-label>
        <p class="font-normal text-sm md:text-lg text-gray-800 dark:text-gray-50">{{$service->serviceType->name}}</p>
    </div>
    <div>
        <x-label class="md:text-lg text-sm font-bold" value="Цена: "></x-label>
        <p class="font-bold text-sm md:text-lg text-gray-800 dark:text-gray-50">{{$service->price}} руб.</p>
    </div>

</a>
