<div class="mb-5">
    @canany(['type-create',
             'type-edit',
             'type-delete'])
        <x-a.info href="{{route('types.index')}}">
            Типы услуг
        </x-a.info>
    @endcan
    @canany(['indication-create',
         'indication-edit',
         'indication-delete'])
        <x-a.info href="{{route('indications.index')}}" class="ml-5">
            Показания
        </x-a.info>
    @endcan
    @canany(['contraindication-create',
             'contraindication-edit',
             'contraindication-delete'])
        <x-a.info href="{{route('contraindications.index')}}" class="ml-5">
            Противопоказания
        </x-a.info>
    @endcan
</div>
