<div class="mb-2 mt-4">
    @if(count($locales) > 0)
    <label for="languageToExport" class="text-2xl font-bold text-gray-800 opacity-75">Export</label>
    <div>

        <select id="languageToExport" name="languageToExport" wire:model="languageToExport"
            class="mt-1 block w-1/3 rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm @error('languageToExport') border-red-800 @enderror">
            <option value=""></option>
            @foreach($locales as $locale)
            <option value="{{$locale}}">{{$locale}}</option>
            @endforeach
        </select>
    </div>
    <div>

        <select id="whatToExport" name="whatToExport" wire:model="whatToExport"
            class="mt-1 block w-auto rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm @error('languageToExport') border-red-800 @enderror">
            <option value="All" selected>All Strings</option>
            <option value="Only translated strings">Only translated strings</option>
            <option value="Only not translated strings">Only not translated strings</option>
        </select>
    </div>

    <div class="flex my-2">

        <button type="button" wire:click="exportCsv"
            class="text-center inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            <svg class="w-4 h-4 mr-2 fill-current text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" />
            </svg>
            {{__('Export CSV')}}</button>
    </div>
    @error('languageToExport')
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative block" role="alert">
        <strong class="font-bold">{{ $message }}</strong>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
        </span>
    </div>
    @enderror
    @else
    <div class="rounded-md bg-red-50 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <!-- Heroicon name: mini/x-circle -->
                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">No locales to export</h3>
            </div>
        </div>
    </div>
    @endif
</div>