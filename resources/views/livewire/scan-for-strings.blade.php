@section('pagespecificscripts')
@endsection
<div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow w-1/3">
    <div class="px-4 py-5 sm:px-6">
        <h1 class="text-2xl font-bold text-gray-800 opacity-75">1. {{__('Import Text')}}</h1>
    </div>
    <div class="px-4 py-5 sm:p-6">
        <div class="my-2">
            <label for="path"
                class="block text-sm font-medium text-gray-700">{{__('Path to search for strings')}}</label>
            <div class="mt-1">
                <input type="path" name="path" id="path" wire:model="path"
                    class="block w-full rounded-md border-gray-300 shadow-sm border focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2 @error('path') border-red-800 @enderror"
                    placeholder="{{__('Path')}}">
            </div>
        </div>

        <div class="my-2">
            <label for="project" class="block text-sm font-medium text-gray-700">{{__('Project Name')}}</label>
            <div class="mt-1">
                <input type="project" name="project" id="project" wire:model="project"
                    class="block w-full rounded-md border-gray-300 shadow-sm border focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2"
                    placeholder="{{__('Project Name')}}">
            </div>
        </div>

        <div class="my-2">
            <label for="Regex"
                class="block text-sm font-medium text-gray-700">{{__('Which pattern you want to scan?')}}</label>
            <select id="Regex" name="Regex" wire:model="pattern"
                class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm @error('localeToAdd') border-red-800 @enderror">
                @foreach(config('lingua.regex') as $key => $value)
                <option value="{{$value}}">{{$key}}</option>
                @endforeach
            </select>
        </div>

        <div class="my-2 flex flex-col space-y-4 text-center">
            <button type="button" wire:click="scan()"
                class="text-center inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Scan</button>
            <button type="button"
                wire:click="$emit('confirmDelete','translations','all the translations','','<p class=\'bg-red-100 border font-bold border-red-400 text-red-700 px-4 py-3 rounded relative\'>CAREFUL!</p> This will delete everything, including files.')"
                class="inline-flex items-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">{{__('Delete all translations')}}</button>


        </div>

        <div wire:loading wire:target="scan"
            class="w-full h-full fixed block top-0 left-0 bg-blue-500 opacity-75 z-50 text-center align-center">
            <div class="absolute inset-0 flex items-center justify-center ">
                <span class="lds-dual-ring"></span>
            </div>

        </div>

        @error('path')
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-2" role="alert">
            <strong class="font-bold">{{ $message }}</strong>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            </span>
        </div>
        @enderror
    </div>
</div>