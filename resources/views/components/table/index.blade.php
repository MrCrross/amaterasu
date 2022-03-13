<div class="flex flex-col">
    <div class="overflow-x-auto">
        <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-md sm:rounded-lg">
                <table {{$attributes->merge(['class'=>"min-w-full"])}}>
                    {{$slot}}
                    <tbody>
                    {{$body}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
