<div {{$attributes->merge([
'class'=>"flex flex-col p-1 md:p-5 max-w-sm bg-gray-100 bg-opacity-50 dark:bg-opacity-50
dark:bg-gray-600 rounded-lg shadow-md hover:shadow-lg dark:border-gray-700"
])}}>
    {{$slot}}
</div>
