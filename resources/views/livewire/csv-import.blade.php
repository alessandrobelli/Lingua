<div>
    <div class="w-full p-2 bg-yellow-200 rounded-lg ">
        <p class="">Csv file <strong>must have the first line with the headers separated by comma, </strong> and those needs to represent: </p>
        <ol class="list-decimal pl-4">
            <li>String to be translated</li>
            <li>Language. <strong>Please use the value <a class="underline text-blue-500" href="{{url('admin/dashboard')}}" target="_blank"> on the dashboard</a>, input "Language", first value.</strong></li>
            <li>Translated text</li>
            <li>Project/Label (optional)</li>
        </ol>
        <p>You will select the columns after you upload the file.</p>
        <p class="bg-red-200 p-1 w-auto">The <span class="font-bold">language column</span> needs to be the "iso language name" in english, like "German" or "Italian".</p>
        <p class="bg-red-200 p-1 w-auto">A wrong name will end up in an error, but don't worry, nothing will be imported!</p>
    </div>
    <div class="w-full my-2">
        <input type="file" wire:model="csv">

        @error('csv')
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">{{ $message }}</strong>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            </span>
        </div>
        @enderror

        <button wire:click="parseHeader" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Get Columns</button>
    </div>
    @if($csv_header != "")
        <div class="h-auto">
            <label class="block text-gray-700 text-sm font-bold mb-2 inline-block" for="stringToBeTranslatedField">
                String to translate :
            </label>

            <div class="w-1/5 inline-block ml-2">
                <select
                    wire:model="stringToBeTranslatedField"
                    name="stringToBeTranslatedField"
                    class="bg-white block appearance-none w-full border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:border-gray-500 @error('stringToBeTranslatedField') border-red-300 @enderror">
                    @foreach($csv_header as $key => $tableField)
                        <option value="{{$key}}">{{$tableField}}</option>
                    @endforeach
                </select>
            </div>

        </div>
        <div class="h-auto mt-2">
            <label class="block text-gray-700 text-sm font-bold mb-2 inline-block" for="languageField">
                Language :
            </label>

            <div class="w-1/5 inline-block ml-2">
                <select
                    wire:model="languageField"
                    name="languageField"
                    class="bg-white block appearance-none w-full border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:border-gray-500 @error('languageField') border-red-300 @enderror">
                    @foreach($csv_header as $key => $tableField)
                        <option value="{{$key}}">{{$tableField}}</option>
                    @endforeach
                </select>
            </div>

        </div>
        <div class="h-auto mt-2">
            <label class="block text-gray-700 text-sm font-bold mb-2 inline-block" for="translatedStringField">
                Translated string :
            </label>

            <div class="w-1/5 inline-block ml-2">
                <select
                    wire:model="translatedStringField"
                    name="translatedStringField"
                    class="bg-white block appearance-none w-full border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:border-gray-500  @error('translatedStringField') border-red-300 @enderror">
                    @foreach($csv_header as $key => $tableField)
                        <option value="{{$key}}">{{$tableField}}</option>
                    @endforeach
                </select>
            </div>

        </div>
        <div class="h-auto mt-2">
            <label class="block text-gray-700 text-sm font-bold mb-2 inline-block" for="projectLabelString">
                Project/Label : (optional)
            </label>

            <div class="w-1/5 inline-block ml-2">
                <select name="projectLabelString"
                        wire:model="projectLabelString"
                        class="bg-white block appearance-none w-full border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:border-gray-500 ">
                    @foreach($csv_header as $key => $tableField)
                        <option value="{{$key}}">{{$tableField}}</option>
                    @endforeach
                </select>
            </div>

        </div>
        <button wire:click="parseImport" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">Parse and import CSV</button>

    @endif
    @error('stringToBeTranslatedField')
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-2" role="alert">
        <strong class="font-bold">{{ $message }}</strong>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            </span>
    </div>
    @enderror
    @error('languageField')
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-2" role="alert">
        <strong class="font-bold">{{ $message }}</strong>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            </span>
    </div>
    @enderror
    @error('translatedStringField')
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-2" role="alert">
        <strong class="font-bold">{{ $message }}</strong>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            </span>
    </div>
    @enderror

    <div wire:loading class="w-full h-full fixed block top-0 left-0 bg-indigo-200 opacity-75 z-50 text-center align-center">
        <div class="absolute inset-0 flex items-center justify-center ">
            <span class="lds-dual-ring"></span>
        </div>
    </div>

    @if($csv_data)
        <h1 class="text-2xl font-bold">Imported Data</h1>
        <table class="table-auto w-full mt-2">
            <thead class="bg-gray-200">
            <tr>
                @foreach ($csv_data[0] as $key => $value)
                    <th class="w-1/2 px-4 py-2">{{ $value }} </th>
                @endforeach
            </tr>
            </thead>
            @foreach ($csv_data as $key => $value)
                <tr class="bg-white">
                    @if($key != 0)
                        @foreach($value as $string)
                            <td class="border px-4 py-2">
                                {{$string}}
                            </td>
                        @endforeach
                    @endif
                </tr>
            @endforeach
        </table>
    @endif
</div>
