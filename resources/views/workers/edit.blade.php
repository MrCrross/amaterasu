@extends('layouts.app')

@section('content')
    <div class="w-full text-center">
        <x-head>Редактирование работника <b>{{$worker->last_name." ".$worker->first_name}}</b></x-head>
        @can('user-edit')
        <x-a.primary href="{{route('users.edit',$worker->user_id)}}">Изменить учетную запись</x-a.primary>
        @endcan
    </div>
    <div id="editContainer"
         class="w-full md:container md:mx-auto mt-5 mb-10 flex flex-col justify-center align-middle">
        {!! Form::open(['method' => 'patch','route' => ['workers.update',$worker->id],'enctype'=>'multipart/form-data']) !!}
        <div class="block md:flex md:flex-row w-full">
            <div class="w-full md:w-96 p-4 dark:bg-gray-800 bg-white md:rounded-lg">
                <div class="flex flex-col">
                    <div class="inline-flex justify-center">
                        <div id="temp-img"
                             class="w-4/6 h-72 flex items-center justify-center border-2 border-gray-400 border-dashed hidden">
                            <x-svg.x fill="rgb(156,163,175)" width="36" height="36"/>
                        </div>
                        <img id="img"
                             class="h-72 rounded-lg ring-1 ring-amber-600 shadow-lg shadow-gray-200 dark:shadow-gray-800"
                             src="{{asset($worker->img)}}" alt="{{$worker->last_name." ".$worker->first_name}}">
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
                                   accept="image/jpeg, image/png"/>
                        </label>
                    </div>
                </div>
            </div>
            <div class="block w-full md:flex md:flex-row text-left md:justify-between">
                <div class="mt-4 md:mt-0 md:w-1/2 md:mx-5">
                    <div>
                        <x-label for="last_name" class="ml-3">Фамилия</x-label>
                        <x-input id="last_name" class="mt-2 w-full"
                                 type="text"
                                 name="last_name"
                                 value="{{$worker->last_name}}"
                                 maxlength="255"
                                 placeholder="Фамилия"
                                 required></x-input>
                    </div>
                    <div>
                        <x-label for="first_name" class="ml-3">Имя</x-label>
                        <x-input id="first_name" class="mt-2 w-full"
                                 type="text"
                                 name="first_name"
                                 value="{{$worker->first_name}}"
                                 maxlength="255"
                                 placeholder="Имя"
                                 required></x-input>
                    </div>
                    <div class="mt-2">
                        <x-label for="birthday" class="ml-3">Дата рождения</x-label>
                        <x-input id="birthday" class="mt-2 w-full"
                                 type="date"
                                 name="birthday"
                                 value="{{$worker->birthday}}"
                                 max="{{date('Y-m-d')}}"
                                 pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"
                                 placeholder="Дата рождения"
                                 required></x-input>
                    </div>
                    <div class="mt-2">
                        <div class="flex flex-row justify-between my-2 items-center">
                            <x-label for="post" class="ml-3">Должность:</x-label>
                            <x-link.worker></x-link.worker>
                        </div>
                        <x-select id="post" class="mt-2 w-full" name="post_id" required>
                            @foreach($posts as $post)
                                <option value="{{$post->id}}" @if(in_array($worker->post_id,(array)$post)) {{'selected'}} @endif>{{$post->name}}</option>
                            @endforeach
                        </x-select>
                    </div>
                </div>
                <div class="mt-4 md:mt-0 md:w-1/2 md:mx-5">
                    <div>
                        <x-label for="description" class="ml-3">Описание (образование)</x-label>
                        <x-textarea id="description" class="mt-2 w-full h-full"
                                    name="description"
                                    rows="1"
                                    placeholder="Описание"
                                    required>{{$worker->description}}</x-textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="block md:flex md:flex-row md:flex-between w-full mt-4">
            <div class="mt-4 md:mt-0 w-full md:mx-5">
                <div>
                    <div class="w-full text-center">
                        <x-head>
                            Услуги:
                            @can('service-create')
                                <x-a.success href="{{route('services.create')}}" class="ml-3">+</x-a.success>
                            @endcan
                        </x-head>
                    </div>
                    <div class="block md:grid md:grid-cols-2 xl:grid-cols-3 md:gap-3">
                        @foreach($services as $type)
                            <x-card.list class="mx-2 mt-5">
                                <div class="mb-2">
                                    <h3 class="font-bold text-lg md:text-2xl text-gray-900 dark:text-white">{{$type->name}}</h3>
                                </div>
                                @foreach($type->services as $service)
                                    @php $checked=''; if(in_array($service->id, $activeServices)): $checked='checked'; endif; @endphp
                                    <x-checkbox name="services[]"
                                                value="{{$service->id}}" :checked="$checked">{{$service->name}}</x-checkbox>
                                @endforeach
                            </x-card.list>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5 text-center">
            <x-btn.primary type="submit">Изменить</x-btn.primary>
        </div>

        {!! Form::close() !!}
    </div>

    <script src="{{asset('js/img.js')}}"></script>

    <script>
        const container = document.querySelector('#editContainer')
        const name = container.querySelector('input[name="name"]')
        name.addEventListener('input', function (e) {
            if (e.target.value == '' ) {
                const spanName = container.querySelector('label[for="name"]').querySelector('span')
                spanName.innerHTML = ''
                spanName.classList.remove('bg-red-500')
                spanName.classList.remove('bg-green-500')
            } else {
                fetch('{{route('workers.check')}}', {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": '{{csrf_token()}}'
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
