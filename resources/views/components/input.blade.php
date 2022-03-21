@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge(['class' => 'block text-sm text-gray-900 bg-gray-50
rounded-lg shadow-sm border border-gray-300 focus:border-indigo-300
focus:ring-indigo-300
dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
          dark:focus:ring-indigo-500 dark:focus:border-indigo-500
']) !!}>
