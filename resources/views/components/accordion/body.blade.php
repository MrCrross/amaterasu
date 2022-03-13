@props(['id'])
<h2 id="accordion-collapse-heading-{{$id}}">
    <button type="button"
            class="flex justify-between items-center p-5 w-full font-medium text-left text-gray-900 bg-gray-100 rounded-t-xl
            border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700
            dark:text-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-800"
            data-accordion-target="#accordion-collapse-body-{{$id}}" aria-expanded="true"
            aria-controls="accordion-collapse-body-{{$id}}">
        <span>{{$head}}</span>
        <svg data-accordion-icon class="w-6 h-6 rotate-180 shrink-0" fill="currentColor"
             viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                  clip-rule="evenodd"></path>
        </svg>
    </button>
</h2>
<div id="accordion-collapse-body-{{$id}}" aria-labelledby="accordion-collapse-heading-{{$id}}">
    <div class="p-5 border border-gray-200 text-gray-900 dark:text-gray-100 dark:border-gray-700 dark:bg-gray-900">
        {{$slot}}
    </div>
</div>
