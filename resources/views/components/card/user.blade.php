@props(['user'])
<div {{$attributes->merge([
    'class'=>"max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700"
    ])}}>
    <div class="flex justify-end px-4 pt-4">
        <button id="dropdownUser{{$user->id}}" data-dropdown-toggle="dropdown{{$user->id}}"
                class="hidden sm:inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5"
                type="button">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"></path>
            </svg>
        </button>
        <!-- Dropdown menu -->
        <div id="dropdown{{$user->id}}"
             class="hidden z-10 w-44 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
            <ul class="py-1" aria-labelledby="dropdownButton{{$user->id}}">
                <li>
                    <a href="{{ route('users.show',$user->id) }}"
                       class="block py-2 px-4 text-sm text-amber-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-amber-400 dark:hover:text-white">Просмотр</a>
                </li>
                @can('user-edit')
                <li>
                    <a href="{{ route('users.edit',$user->id) }}"
                       class="block py-2 px-4 text-sm text-blue-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-blue-400 dark:hover:text-white">Изменить</a>
                </li>
                @endcan
                @can('user-delete')
                <li>
                    {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                    <button type="submit"
                            class="block w-full py-2 px-4 text-sm text-left text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-red-400 dark:hover:text-white">
                        Удалить
                    </button>
                    {!! Form::close() !!}
                </li>
                @endcan
            </ul>
        </div>
    </div>
    <div class="flex flex-col items-center pb-10">
        <img class="mb-3 w-24 h-24 rounded-full shadow-lg" src="{{asset($user->avatar)}}" alt="avatar"/>
        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$user->name}}</h5>
        @if(!empty($user->getRoleNames()))
            @foreach($user->getRoleNames() as $role)
                <x-badge.success>{{ $role }}</x-badge.success>
            @endforeach
        @endif
    </div>
</div>
