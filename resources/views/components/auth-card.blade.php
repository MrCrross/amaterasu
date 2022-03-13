<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
    <div class="flex flex-col items-center">
        {{ $logo }}
        <x-theme class="mt-2"></x-theme>
    </div>

    <div class="w-full sm:max-w-md mt-3 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg dark:bg-gray-800 ">
        {{ $slot }}
    </div>
</div>
