@section('pagespecificscripts')
<script>
    let test = trans("test");
</script>
@endsection
<div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow w-1/3">
    <div class="px-4 py-5 sm:px-6">
        <h1 class="text-2xl font-bold text-gray-800 opacity-75">1. {{__('Import Text')}}</h1>
    </div>
    <div class="px-4 py-5 sm:p-6">


        <label class="block text-gray-700 text-sm font-bold mb-2" for="path">
            {{__('Path to search for strings')}}
        </label>
        <input wire:model="path"
            class="appearance-none border py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline inline-flex w-full @error('path') border-red-800 @enderror"
            id="path" type="text" placeholder="{{__('Path')}}">

        <label class="block text-gray-700 text-sm font-bold my-2" for="path">
            Project Name / Label
        </label>
        <input wire:model="project"
            class="appearance-none border py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline inline-flex"
            id="project" type="text" placeholder="{{__('Project Name')}}">
        <div>
            <label for="Regex" class="block text-sm font-medium text-gray-700">Which pattern you want to scan?</label>
            <select id="Regex" name="Regex" wire:model="pattern"
                class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm @error('localeToAdd') border-red-800 @enderror">
                @foreach(config('lingua.regex') as $key => $value)
                <option value="{{$value}}">{{$key}}</option>
                @endforeach
            </select>
        </div>
        <div class="block">
            <div class="inline-block">
                <button wire:click="scan()"
                    class="bg-blue-900 border-blue-800 py-2 px-4 font-bold hover:bg-blue-700 text-white mt-2"
                    type="button">
                    Scan
                </button>
            </div>
            <div class="inline-block">
                <button class="bg-red-900 border-red-800 py-2 px-4 font-bold hover:bg-red-700 text-white mt-2"
                    type="button"
                    wire:click="$emit('confirmDelete','translations','all the translations','','<p class=\'bg-red-100 border font-bold border-red-400 text-red-700 px-4 py-3 rounded relative\'>CAREFUL!</p> This will delete everything, including files.')">
                    {{__('Delete all translations')}}
                </button>
            </div>
        </div>

        <div wire:loading wire:target="scan"
            class="w-full h-full fixed block top-0 left-0 bg-indigo-200 opacity-75 z-50 text-center align-center">
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