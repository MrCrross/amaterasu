@props(['type'=>1])
@php
    switch($type){
        case 2:
            $bg = 'bg-gray-100 dark:bg-gray-900';
        break;
        default:
            $bg = 'bg-white dark:bg-gray-800/30';
            break;
    }
@endphp
<div {{$attributes->merge(['class'=>"w-full flex flex-col sm:justify-center items-center p-10 ".$bg])}}>
    <x-head>{{$head}}</x-head>
    {{$slot}}
</div>
