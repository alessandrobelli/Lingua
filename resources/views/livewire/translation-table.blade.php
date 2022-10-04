<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <p class="mt-2 text-sm text-gray-700">{{$translations->total()." ".__('strings.')}}
                {{$translationNotCompleted->total()." ".__('strings not translated.')}}
            </p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">

            <div class="w-2/4 inline-block">
                <label class="font-bold">
                    {{__('Search')}}
                    <input placeholder="Search Translations..." wire:model="search"
                        class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 hover:border-gray-500 py-2 px-4 block w-full appearance-none leading-normal my-2"
                        type="text" />
                </label>
            </div>
            <div class="w-1/4 inline-block float-right">
                <label class="font-bold relative inline-block">
                    Per Page: &nbsp;
                    <select wire:model="perPage"
                        class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-500 px-4 py-2 pr-8 rounded leading-normal focus:outline-none focus:shadow-outline my-2">
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                    <div
                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 pt-4 text-gray-700">
                        <svg fill="currentColor" class="fill-current w-4 h-4" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </label>
            </div>
            <div class="w-full align-middle">
                <div class="font-bold w-full block">
                    Show Columns
                </div>

                <label class="md:w-1/3 block text-blue-900 font-bold inline mr-2">
                    <input class="mr-1 leading-tight" type="checkbox" wire:click="toggleshowFiles"
                        wire:model="showFiles">
                    <span class="text-sm">
                        {{__('File location')}}
                    </span>
                </label>
                <label class="md:w-1/3 block text-blue-900 font-bold inline mr-2">
                    <input class="mr-1 leading-tight" type="checkbox" wire:click="toggleshowProject"
                        wire:model="showProject">
                    <span class="text-sm">
                        {{__('Project/Label')}}
                    </span>
                </label>

            </div>
            <div class="w-full align-middle">
                <div class="font-bold w-full block">
                    Options
                </div>

                <label class="md:w-1/3 block text-blue-900 font-bold inline mr-2">
                    <input class="mr-1 leading-tight" type="checkbox" wire:click="toggleonlyToTranslate"
                        wire:model="onlyToTranslate">
                    <span class="text-sm">
                        {{__('Only Strings to translate')}}
                    </span>
                </label>
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
                                <td class="whitespace-nowrap p-4 text-sm text-gray-500">{{$translation->string}}</td>
                                @if($showFiles)
                                <td class="whitespace-nowrap p-4 text-sm text-gray-500">
                                    {{"...".substr($translation->file,23)}}
                                </td>
                                @endif
                                <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm text-gray-500 sm:pr-6">
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