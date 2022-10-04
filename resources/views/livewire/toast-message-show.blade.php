<div>
    <div class="transition transition-opacity rounded-md bg-{{ $alertTypeClasses[$alertType] }}-200 p-4 mx-auto w-1/2 mt-4"
        x-data="{show:false}" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-40" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in-out duration-700"
        x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-40"
        @toast-message-show.window="show = true; setTimeout(() => show=false, 5000);" x-show="show" x-cloak>
        <div class="flex">
            <div class="ml-3">

                <div class="text-base text-{{ $alertTypeClasses[$alertType] }}-700">
                    <p>{{ $message }}</p>
                </div>
            </div>
        </div>
    </div>
</div>