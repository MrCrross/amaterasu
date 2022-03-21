@extends('layouts.app')

@section('content')
    <div class="flex flex-row px-5 py-3 items-center justify-between align-middle shadow bg-gray-200 dark:bg-gray-700">
        <h2 class="text-xl text-gray-800 dark:text-gray-100 leading-tight">Просмотр противопоказания</h2>
        <x-a.primary href="{{ route('contraindications.index') }}" class="flex items-center">Назад</x-a.primary>
    </div>

    <div class="flex flex-row items-center justify-center mt-3">
        <div class="block p-6 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$contraindication->name}}</h5>
            <div>
                @can('contraindication-edit')
                    <x-a.primary href="{{ route('contraindications.edit',$contraindication->id) }}" class="mr-2">Изменить
                    </x-a.primary>
                @endcan
                @can('contraindication-delete')
                    {!! Form::open(['method' => 'DELETE','route' => ['contraindications.destroy', $contraindication->id],'style'=>'display:inline']) !!}
                    <x-btn.danger type="submit">Удалить</x-btn.danger>
                    {!! Form::close() !!}
                @endcan
            </div>
        </div>
    </div>
@endsection
