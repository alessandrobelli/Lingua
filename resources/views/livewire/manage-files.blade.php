<div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow">
  <div class="px-4 py-5 sm:px-6">
    <h1 class="text-2xl font-bold text-gray-800 opacity-75">Files</h1>
    <p class="text-base opacity-75 text-base text-gray-900">
      {{__('3. Build json files: this will enable the translation on the website with the current translations.')}}
    </p>
  </div>
  <div class="px-4 py-5 sm:p-6">
    <div class="block my-4">
      <button type="button" wire:click="buildJson()"
        class="text-center inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">{{__('Build Json Files')}}</button>
    </div>
    <livewire:export-to-csv>

      <div wire:loading wire:target="buildJson,addLocale"
        class="w-full h-full fixed block top-0 left-0 bg-indigo-200 opacity-75 z-50 text-center align-center">
        <div class="absolute inset-0 flex items-center justify-center ">
          <span class="lds-dual-ring"></span>
        </div>

      </div>


      <h1 class="text-2xl font-bold text-gray-800 opacity-75">List of translation files.</h1>



      @if(count(File::files(resource_path() . "/lang/")))
      <div class="bg-gray-800 p-2 text-gray-100 font-serif text-xs overflow-x-scroll text-center">
        {{strlen(resource_path()) > 19 ? "...".substr(resource_path(),3,strlen(resource_path())): resource_path()}}
      </div>
      <div class="bg-white p-2 overflow-x-scroll whitespace-no-wrap divide-y">
        @foreach(File::files(resource_path() . "/lang/") as $file)
        <div class="block py-2">
          {{$file->getBasename()}} -
          {{alessandrobelli\Lingua\LinguaUtilities::array_multidimensional_search(config('lingua.locales-list'),'locale',$file->getFilenameWithoutExtension())[0]['isolanguagename']}}
        </div>
        @endforeach
      </div>
      <div class="block my-4">
        <button type="button" wire:click="downloadjsons()"
          class="text-center inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">{{__('Download Json Files')}}</button>


      </div>

      @endif
  </div>
</div>