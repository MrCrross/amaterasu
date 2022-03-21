<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="fill-current text-gray-500"></x-application-logo>
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors"></x-auth-validation-errors>

        <form method="POST" action="{{ route('register') }}" enctype='multipart/form-data'>
        @csrf
            <div>
            <x-label for="last_name" >Фамилия</x-label>
            <x-input id="last_name" class="block mt-1 w-full"
                     type="text"
                     name="last_name"
                     maxlength="255"
                     placeholder="Фамилия"
                     required></x-input>
            </div>
            <div class="mt-4">
                <x-label for="first_name">Имя</x-label>
                <x-input id="first_name" class="block mt-1 w-full"
                         type="text"
                         name="first_name"
                         maxlength="255"
                         placeholder="Имя"
                         required></x-input>
            </div>
            <div class="mt-4">
                <x-label for="phone">Номер телефона</x-label>
                <x-input id="phone" class="block mt-1 w-full"
                         type="tel"
                         name="phone"
                         placeholder="Номер телефона"
                         required></x-input>
            </div>
            <div class="mt-4">
                <x-label for="birthday" >Дата рождения</x-label>
                <x-input id="birthday" class="block mt-1 w-full"
                         type="date"
                         name="birthday"
                         max="{{date('Y-m-d')}}"
                         pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"
                         placeholder="Дата рождения"
                         required></x-input>
            </div>
        <!-- Name -->
            <div class="mt-4">
                <x-label for="name" :value="__('Логин')"></x-label>

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                         autofocus></x-input>
            </div>
            <!-- Image -->
            <div class="mt-4">
                <x-file id="avatar" name="avatar" label="аватара"></x-file>
            </div>
            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Пароль')"></x-label>

                <x-input id="password" class="block mt-1 w-full"
                         type="password"
                         name="password"
                         required autocomplete="new-password"></x-input>
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Повторите пароль')"/>

                <x-input id="password_confirmation" class="block mt-1 w-full"
                         type="password"
                         name="password_confirmation" required/>
            </div>


            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-gray-200 dark:hover:text-gray-100"
                   href="{{ route('login') }}">
                    {{ __('Уже зарегистрированы?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Зарегистрироваться') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
