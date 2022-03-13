<div {{$attributes->merge([
    'class'=>"p-4 my-2 mx-2 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800",'role'=>"alert"])}}>
    <span class="font-medium">Ошибка!</span> {{$slot}}
</div>
