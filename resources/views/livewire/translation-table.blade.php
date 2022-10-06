<div class="px-4 sm:px-6 lg:px-8">
    <div class="w-full">
        <p class="mt-2 text-sm text-gray-700">{{$translations->total()." ".__('strings.')}} <br>
            {{$translationNotCompleted->total()." ".__('strings not translated.')}}
        </p>
    </div>
    <div class="flex">

        <div class="mt-4 w-full justify-between flex space-x-4">

            <div class="w-2/3">
                <label class="block text-sm font-medium text-gray-700">
                    {{__('Search')}}
                    <input placeholder="Search Translations..." wire:model="search"
                        class="block w-full rounded-md border-gray-300 shadow-sm border focus:border-blue-500 focus:ring-blue-500 sm:text-sm p-2"
                        type="text" />
                </label>
            </div>
            <div class="w-1/3 float-right">
                <label for="perPage" class="block text-sm font-medium text-gray-700">{{__('Per Page:')}}&nbsp;</label>
                <select id="perPage" name="perPage" wire:model="perPage" wire:model="perPage"
                    class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm @error('localeToAdd') border-red-800 @enderror">
                    <option>10</option>
                    <option>25</option>
                    <option>50</option>
                    <option>100</option>
                </select>


            </div>
            <div class="w-full align-middle">
                <div class="block text-sm font-medium text-gray-700">
                    Show Columns
                </div>
                <div class="relative flex items-start">
                    <div class="flex h-5 items-center">
                        <input wire:model="showFiles" wire:click="toggleshowFiles" type="checkbox"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    </div>
                    <div class="ml-3 text-sm">
                        <label class="font-medium text-gray-700">{{__('File location')}}</label>
                    </div>
                </div>
                <div class="relative flex items-start">
                    <div class="flex h-5 items-center">
                        <input wire:model="showProject" wire:click="toggleshowProject" type="checkbox"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    </div>
                    <div class="ml-3 text-sm">
                        <label class="font-medium text-gray-700">{{__('Project/Label')}}</label>
                    </div>
                </div>



            </div>
            <div class="w-full align-middle">
                <div class="block text-sm font-medium text-gray-700">
                    {{__('Options')}}
                </div>
                <div class="relative flex items-start">
                    <div class="flex h-5 items-center">
                        <input wire:model="onlyToTranslate" wire:click="toggleonlyToTranslate" type="checkbox"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    </div>
                    <div class="ml-3 text-sm">
                        <label class="font-medium text-gray-700">{{__('Only Strings to translate')}}</label>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr class="divide-x divide-gray-200">
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-4 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                    <a role="button" wire:click.prevent="sortBy('string')">
                                        String
                                        @include('lingua::includes._sort-icon', ['field' => 'string'])
                                    </a>
                                </th>
                                @if($showFiles)
                                <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    <a role="button" wire:click.prevent="sortBy('file')">
                                        File Location / Line
                                        @include('lingua::includes._sort-icon', ['field' => 'file'])

                                    </a>
                                </th>
                                @endif
                                <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    <a role="button">
                                        Locales
                                    </a>
                                </th>
                                @if($showProject)
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-4 text-left text-sm font-semibold text-gray-900 sm:pr-6">
                                    Project
                                </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @foreach($translations as $translation)
                            <tr class="divide-x divide-gray-200">
                                <td class="p-4 text-sm text-gray-500 w-1/3 whitespace-pre-line">
                                    {{$translation->string}}
                                </td>
                                @if($showFiles)
                                <td class="whitespace-pre-line p-4 text-sm text-gray-500">
                                    {{"...".substr($translation->file,23)}}
                                </td>
                                @endif
                                <td class="whitespace-pre-line py-4 pl-4 pr-4 text-sm text-gray-500 sm:pr-6">
                                    @if(!empty($translation->locales))
                                    <button type="button"
                                        class="bg-transparent border focus:border-gray-900 border-gray-500 text-gray-500 hover:text-indigo-500 font-bold py-2 px-4 rounded-full focus:outline-none"
                                        wire:click="$emit('showModal',{{$translation->id}})">
                                        {{__('Manage Translations')}}
                                    </button>
                                    @else
                                    Add a locale to start translate.
                                    @endif
                                </td>
                                @if($showProject)
                                <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm text-gray-500 sm:pr-6">
                                    {{$translation->project}}
                                </td>
                                @endif
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full mt-2">
        {{$translations->links('lingua::layouts.livewire-pagination-tailwind')}}
    </div>
    @livewire('translation-modal')
</div>