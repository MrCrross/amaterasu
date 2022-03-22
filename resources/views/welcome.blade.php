@extends('layouts.app')

@section('content')
    <x-carousel.service :services="$services"></x-carousel.service>
    <x-offer :services="$offers"></x-offer>
    @guest
    <x-section type="2">
        <x-slot name="head">
            Оставьте заявку, мы перезвоним вам и подберем вам удобное время для приема
        </x-slot>
        <x-center-item>
            {!! Form::open(['id'=>'record-create','route' => 'records.store','method'=>'POST']) !!}
            <div>
                <x-label for="last_name" :value="__('Ваша фамилия')"></x-label>
                <x-input id="last_name" class="block mt-1 w-full"
                         type="text"
                         name="last_name"
                         placeholder="Фамилия*"
                         required></x-input>
            </div>
            <div class="mt-4">
                <x-label for="first_name" :value="__('Ваше имя')"></x-label>
                <x-input id="first_name" placeholder="Имя*" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required></x-input>
                <input type="text" name="service_id" value="1" required hidden>
            </div>
            <div class="mt-4">
                <x-label for="email" :value="__('Почта')"></x-label>
                <x-input id="email" placeholder="Почта*" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required></x-input>
            </div>
            <div class="mt-4">
                <x-label for="phone" :value="__('Телефон')"></x-label>
                <x-input id="phone" class="block mt-1 w-full"
                         placeholder="Телефон*"
                         type="tel"
                         name="phone" required></x-input>
            </div>
            <div class="mt-4 text-center">
                <x-btn.success type="submit">
                    Оставить заявку
                </x-btn.success>
            </div>

            {!! Form::close() !!}
        </x-center-item>
    </x-section>
    @endguest

    <x-modal.record></x-modal.record>
@endsection
