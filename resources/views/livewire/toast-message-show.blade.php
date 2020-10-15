<div>
    <div class="z-50 transition transition-opacity fixed bottom-0 inset-x-0 mb-6 mx-6 px-6 py-5 max-w-sm rounded-lg pointer-events-auto {{ $alertTypeClasses[$alertType] }}"
         x-data="{show:false}"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-40"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in-out duration-700"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-40"
         @toast-message-show.window="show = true; setTimeout(() => show=false, 5000);"
         x-show="show"
         x-cloak
    >
        {{ $message }}
    </div>
</div>
