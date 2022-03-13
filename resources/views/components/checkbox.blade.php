@props(['name','value', 'checked'=>''])
<div {{$attributes->merge([
    'class'=>"flex items-center"
])}}>
    <label class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">
    <input type="checkbox"
           name="{{$name}}"
           value="{{$value}}"
           class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800
           focus:ring-2 dark:bg-gray-700 dark:border-gray-600" {{$checked}}>
    {{$slot}}</label>
</div>
