<div class="mb-2 mt-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="languageToExport">
        Export
    </label>
    @if(count($locales) > 0)
        <div class="w-full my-4 flex">

            <div class="relative w-1/5 mr-4">
                <select wire:model="languageToExport" name="languageToExport" class="bg-white w-full appearance-none  border border-gray-200 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:border-gray-500 @error('languageToExport') border-red-800 @enderror">
                    <option value=""></option>
                    @foreach($locales as $locale)
                        <option value="{{$locale}}">{{$locale}}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                    </svg>
                </div>
            </div>
            <div class="flex-shrink">
                <button class="bg-blue-900 border-blue-800 font-bold hover:bg-blue-700 text-white py-2 px-4 rounded inline-flex items-center" wire:click="exportCsv">
                    <svg class="w-4 h-4 mr-2 fill-current text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/>
                    </svg>
                    <span>{{__('Export CSV')}}</span>
                </button>
            </div>

        </div>
        @error('languageToExport')
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative block" role="alert">
            <strong class="font-bold">{{ $message }}</strong>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            </span>
        </div>
        @enderror
    @endif
</div>
