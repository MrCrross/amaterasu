@component('mail::message')
    # Добро пожаловать в {{ config('app.name') }}

    Здравствуйте, {{$data->email}},

    Вы записались на прием в {{ config('app.name') }}. Для оказания услуги Вам был создан личный кабинет.

    Логин: {{$data->login}}
    Пароль: {{$data->password}}

    Время сеанса: {{$data->seance}}
    Для более подробной информации войдите в личный кабинет.

    @component('mail::button', ['url' => route("login")])
        Войти
    @endcomponent
    Спасибо,<br>
    {{ config('app.name') }}
@endcomponent
