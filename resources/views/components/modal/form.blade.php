@props(['id','type'=>'default'])
@php
    switch($type){
        case 'small':
            $size = 'max-w-md';
        break;
        case 'large':
            $size = 'max-w-4xl';
        break;
        case 'extra-large':
            $size = 'max-w-7xl';
        break;
        default:
            $size = 'max-w-xl';
        break;
    }
@endphp

<div id="{{$id}}" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center h-modal md:h-full md:inset-0">
    <div class="relative px-4 w-full {{$size}} h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex justify-end p-2">
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="{{$id}}">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <div class="px-6 pb-4 space-y-6 lg:px-8 sm:pb-6 xl:pb-8">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">{{$header}}</h3>
            {{$slot}}
            </div>
        </div>
    </div>
</div>
