@extends('layouts.app')

@section('content')
    <div class="flex flex-row px-5 py-3 items-center justify-between align-middle shadow bg-gray-200 dark:bg-gray-700">
        <h2 class="text-xl text-gray-800 dark:text-gray-100 leading-tight">Просмотр пользователей</h2>
        <x-a.primary href="{{ route('users.index') }}" class="flex items-center">Назад</x-a.primary>
    </div>

    <div class="w-full">
        <x-card.user class="mx-auto my-2" :user="$user"></x-card.user>
    </div>
@endsection
