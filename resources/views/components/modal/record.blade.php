<x-modal.form id="record-modal">
    <x-slot name="header">Оставить заявку на <span class="service_name"></span></x-slot>
    {!! Form::open(['route' => 'record.create','method'=>'POST']) !!}
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
        <x-input id="first_name" placeholder="Имя*" class="block mt-1 w-full" type="text" name="first_name"
                 :value="old('first_name')" required></x-input>
        <x-input type="text" name="service_id" required hidden></x-input>
    </div>
    <div class="mt-4">
        <x-label for="phone" :value="__('Телефон')"></x-label>
        <x-input id="phone" class="block mt-1 w-full"
                 placeholder="Телефон*"
                 type="tel"
                 name="phone" required></x-input>
    </div>
    <div class="mt-4 text-center">
        <x-btn.primary type="submit">
            Сохранить заявку
        </x-btn.primary>
    </div>

    {!! Form::close() !!}
</x-modal.form>
<script>
    document.addEventListener('DOMContentLoaded',function () {
        const modal = document.getElementById('record-modal');
        const service_id = modal.querySelector('input[name="service_id"]')
        const service_name = modal.querySelector('span.service_name')
        service_id.value = localStorage.service_id
        service_name.innerHTML = localStorage.service_name

        const submit = modal.querySelector('form')
        submit.addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(submit)
            console.log(formData)
            fetch('{{route('record.create')}}', {
                method: "POST",
                credentials: "same-origin",
                body: formData
            }).then(res => res.json())
                .then(res => {
                    switch (res.status) {
                        case 'success':
                            toastMessage('toast-success', res.message)
                            break;
                        case 'error':
                            toastMessage('toast-danger', res.message)
                            break;
                    }
                    toggleModal('record-modal')
                })
        })
    })
</script>
