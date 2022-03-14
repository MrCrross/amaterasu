@props(['services'])
<div id="carousel-service" data-carousel="static" class="relative">

    <!-- Carousel wrapper -->
    <div class="overflow-hidden relative my-5 h-5/6">
        @foreach($services as $key=>$service)
            <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                <img src="{{asset($service->img)}}"
                     class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
                <div class="block absolute bottom-0 right-0 w-full md:right-10 md:bottom-6 md:w-96 md:h-64">
                    <x-card.carousel :service="$service"></x-card.carousel>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Slider indicators -->
    <div class="flex absolute bottom-5 left-1/2 space-x-3 -translate-x-1/2">
        @foreach($services as $key=>$service)
            @if($key===0)
                <button type="button" class="w-3 h-3 bg-white rounded-full dark:bg-gray-800" aria-current="true"
                        aria-label="Slide {{$key}}" data-carousel-slide-to="{{$key}}"></button>
            @else
                <button type="button"
                        class="w-3 h-3 rounded-full bg-white/50 dark:bg-gray-800/50 hover:bg-white dark:hover:bg-gray-800"
                        aria-current="false" aria-label="Slide {{$key}}" data-carousel-slide-to="{{$key}}"></button>
            @endif
        @endforeach
    </div>

    <!-- Slider controls -->
    <button type="button"
            class="flex absolute top-0 left-0 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
            data-carousel-prev>
        <span
            class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round"
                      stroke-linejoin="round" stroke-width="2"
                      d="M15 19l-7-7 7-7"></path>
            </svg>
            <span class="hidden">Назад</span>
        </span>
    </button>
    <button type="button"
            class="flex absolute top-0 right-0 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
            data-carousel-next>
        <span
            class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round"
                      stroke-linejoin="round" stroke-width="2"
                      d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="hidden">Вперед</span>
        </span>
    </button>
</div>
