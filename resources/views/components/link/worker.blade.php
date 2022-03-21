<div class="my-2">
    @canany(['post-create',
             'post-edit',
             'post-delete'])
        <x-a.info href="{{route('posts.index')}}">
            Должности
        </x-a.info>
    @endcan
</div>
