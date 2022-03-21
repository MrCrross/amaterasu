@props(['services'])
<x-section type="1">
    <x-slot name="head">
        Первые шаги
    </x-slot>
    <div class="block md:grid md:grid-cols-3 md:gap-x-5 md:gap-y-4">
        @foreach($services as $service)
            <div class="my-2 md:my-0">
                <x-card.service :service="$service"></x-card.service>
            </div>
        @endforeach
    </div>
</x-section>
