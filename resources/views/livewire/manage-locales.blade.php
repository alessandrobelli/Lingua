<div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow">
    <div class="px-4 py-5 sm:px-6">
        <h1 class="text-2xl font-bold text-gray-800 opacity-75">{{__('2. Add Locale')}}</h1>
        <p class="text-base mb-2 opacity-75 text-base text-gray-900">{{__('List of Languages')}}</p>
    </div>
    <div class="px-4 py-5 sm:p-6">
        @foreach($locales as $locale)
        <button type="button"
            wire:click="$emit('confirmDelete','locale','{{$locale}}','{{implode(",",$locales)}}','The translation file will be also deleted.')"
            class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
            {{$locale}}
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="ml-3 -mr-1 h-5 w-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
            </svg>


        </button>
        @endforeach


        <div class="w-full block  my-4">
            <div>
                <label for="locale" class="text-2xl font-bold text-gray-800 opacity-75">Language</label>
                <select id="locale" name="locale" wire:model="localeToAdd"
                    class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm @error('localeToAdd') border-red-800 @enderror">
                    @foreach(config('lingua.locales-list') as $value)
                    <option value="{{$value['locale']}}">{{$value['isolanguagename']}} - {{$value['nativename']}} -
                        {{$value['locale']}}
                    </option>
                    @endforeach
                </select>
            </div>




        </div>
        <div class="block my-4">
            <button type="button" wire:click="addLocale()"
                class="text-center inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">{!!
                __('Add&nbsp;Locale') !!}</button>
        </div>


        @error('localeToAdd')
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
            <strong class="font-bold">{{ $message }}</strong>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            </span>
        </div>
        @enderror
    </div>
</div>