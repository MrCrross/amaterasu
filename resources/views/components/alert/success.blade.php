<div {{$attributes->merge([
    'class'=>"p-4 my-2 mx-2 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800", 'role'=>"alert"])}}>
    <span class="font-medium">Успешно!</span> {{$slot}}
</div>
