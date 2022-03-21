@extends('layouts.app')

@section('content')
    <div class="w-full text-center">
        <x-head>Добавление услуги</x-head>
        <x-link.service></x-link.service>
    </div>
    <div id="createContainer"
         class="w-full md:container md:mx-auto mt-5 mb-10 flex flex-col justify-center align-middle">
        {!! Form::open(['method' => 'post','route' => ['services.store'],'enctype'=>'multipart/form-data']) !!}
        <div class="block md:flex md:flex-row w-full">
            <div class="w-full md:w-96 p-4 dark:bg-gray-800 bg-white md:rounded-lg">
                <div class="flex flex-col">
                    <div class="inline-flex justify-center">
                        <div id="temp-img"
                             class="w-4/6 h-72 flex items-center justify-center border-2 border-gray-400 border-dashed">
                            <x-svg.x fill="rgb(156,163,175)" width="36" height="36"/>
                        </div>
                        <img id="img"
                             class="h-72 rounded-lg ring-1 ring-amber-600 shadow-lg shadow-gray-200 dark:shadow-gray-800 hidden"
                             src="" alt="">
                    </div>
                    <div class="inline-flex items-center justify-center mt-2 ">
                        <label class="w-36 relative flex flex-row p-2 rounded-2xl
                    items-center justify-center cursor-pointer
                    shadow shadow-gray-200 dark:shadow-gray-800 hover:bg-amber-700 bg-amber-600"
                               title="Добавить изображение">
                            <svg class="fill-gray-100 dark:fill-gray-900" height="18" viewBox="0 0 24 24" width="18"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 0h24v24H0z" fill="none"/>
                                <path d="M9 16h6v-6h4l-7-7-7 7h4zm-4 2h14v2H5z"/>
                            </svg>
                            <span class="px-2 text-gray-100 dark:text-gray-900">Файла нет</span>
                            <input type='file' name="img" id="file" class="absolute top-1 w-1 -z-10"
                                   accept="image/jpeg, image/png" required/>
                        </label>
                    </div>
                </div>
            </div>
            <div class="block w-full md:flex md:flex-row text-left md:justify-between">
                <div class="mt-4 md:mt-0 md:w-1/2 md:mx-5">
                    <div>
                        <x-label for="name" class="ml-3">Название <span class="rounded p-1 "></span></x-label>
                        <x-input id="name" class="mt-2 w-full"
                                 type="text"
                                 name="name"
                                 maxlength="255"
                                 placeholder="Название"
                                 required></x-input>
                    </div>
                    <div class="mt-2">
                        <x-label for="price" class="ml-3">Стоимость (руб.)</x-label>
                        <x-input id="price" class="mt-2 w-full"
                                 type="number"
                                 name="price"
                                 placeholder="Цена"
                                 required></x-input>
                    </div>
                    <div class="mt-2">
                        <div class="flex flex-row justify-between my-2 items-center">
                            <x-label for="type" class="ml-3">Тип услуги:</x-label>
                            @can('type-create')
                                <x-a.success href="{{route('types.create')}}" class="ml-1">+</x-a.success>
                            @endcan
                        </div>
                        <x-select id="type" class="mt-2 w-full" name="service_type_id" required>
                            @foreach($types as $type)
                                <option value="{{$type->id}}">{{$type->name}}</option>
                            @endforeach
                        </x-select>
                    </div>
                </div>
                <div class="mt-4 md:mt-0 md:w-1/2 md:mx-5">
                    <div>
                        <x-label for="description" class="ml-3">Описание</x-label>
                        <x-textarea id="description" class="mt-2 w-full h-full"
                                    name="description"
                                    rows="1"
                                    placeholder="Описание"
                                    required></x-textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="block md:flex md:flex-row md:flex-between w-full mt-4">
            <div class="mt-4 md:mt-0 md:w-1/2 md:mx-5">
                <div>
                    <div class="flex flex-row justify-between items-center">
                        <x-label class="text-lg">Показания:</x-label>
                        @can('indication-create')
                            <x-a.success href="{{route('indications.create')}}" class="ml-1">+</x-a.success>
                        @endcan
                    </div>
                    @foreach($indications as $indication)
                        <x-checkbox name="indications[]" value="{{$indication->id}}">{{$indication->name}}</x-checkbox>
                    @endforeach
                </div>
            </div>
            <div class="mt-4 md:mt-0 md:w-1/2 md:mx-5">
                <div>
                    <div class="flex flex-row justify-between items-center">
                        <x-label class="text-lg">Противопоказания:</x-label>
                        @can('contraindication-create')
                            <x-a.success href="{{route('contraindications.create')}}" class="ml-1">+</x-a.success>
                        @endcan
                    </div>
                    @foreach($contraindications as $contraindication)
                        <x-checkbox name="contraindications[]"
                                    value="{{$contraindication->id}}">{{$contraindication->name}}</x-checkbox>
                    @endforeach
                </div>
            </div>
            <div class="mt-4 md:mt-0 md:w-1/2 md:mx-5">
                <div>
                    <div class="flex flex-row justify-between items-center">
                        <x-label class="text-lg">Сотрудники, способные выполнить услугу:</x-label>
                    </div>
                    @foreach($workers as $worker)
                        <x-checkbox name="workers[]"
                                    value="{{$worker->id}}">{{$worker->last_name." ".$worker->first_name." (".$worker->post->name.")"}}</x-checkbox>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="mt-5 text-center">
            <x-btn.success type="submit">Добавить</x-btn.success>
        </div>

        {!! Form::close() !!}
    </div>

    <script src="{{asset('js/img.js')}}"></script>

    <script>
        const container = document.querySelector('#createContainer')
        const name = container.querySelector('input[name="name"]')
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        name.addEventListener('input', function (e) {
            if (e.target.value == '') {
                const spanName = container.querySelector('label[for="name"]').querySelector('span')
                spanName.innerHTML = ''
                spanName.classList.remove('bg-red-500')
                spanName.classList.remove('bg-green-500')
            } else {
                fetch('{{route('services.check')}}', {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": token
                    },
                    method: "post",
                    credentials: "same-origin",
                    body: JSON.stringify({
                        name: e.target.value
                    })
                }).then(res => res.json())
                    .then(res => {
                        const labName = container.querySelector('label[for="name"]')
                        const spanName = labName.querySelector('span')
                        if (res.status) {
                            spanName.classList.remove('bg-red-500')
                            spanName.classList.add('bg-green-500')
                        } else {
                            spanName.classList.remove('bg-green-500')
                            spanName.classList.add('bg-red-500')
                        }
                        spanName.innerHTML = res.message
                    })
            }
        })
    </script>


@endsection
