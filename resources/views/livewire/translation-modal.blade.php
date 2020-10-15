<div>
    @if($translation != "")
        <div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center {{ $isOpen ? '' : 'opacity-0 pointer-events-none' }}">
            <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>


            <div class="modal-container bg-white w-1/2 lg:max-w-lg  mx-auto rounded shadow-lg z-50 overflow-y-auto">

                <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50" wire:click="$emit('closeModal')">
                    <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                    <span class="text-sm">(Esc)</span>
                </div>

                <!-- Add margin if you want to see some of the overlay behind the modal-->
                <div class="modal-content py-4 text-left px-6">
                    <div
                         class="modal-close cursor-pointer z-50 float-right relative rounded-full bg-blue-900 p-2 text-white" wire:click="$emit('closeModal')">
                        <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                        </svg>
                    </div>
                    <!--Title-->
                    <div class="flex justify-between items-center pb-3">
                        <p class="text-2xl font-bold">{{$translation->string}}</p>
                    </div>

                    <!--Body-->

                    @foreach($translation->locales as $key => $value)
                        <?php
                        /** @var $key */
                        $locale = alessandrobelli\Lingua\LinguaUtilities::array_multidimensional_search(config('lingua.locales-list'),'locale',$key)[0];
                        ?>
                        <div class="flex">
                            <div
                                class="align-middle justify-center mx-auto w-40 p-2 cursor-none bg-blue-900 text-white text-center flex-shrink select-none border-b-2 border-gray-200">
                                <div class="block align-middle ">{{$locale['isolanguagename']}}</div>
                                <div class="block align-middle font-italic">{{$locale['nativename']}}</div>
                                <div class="flag-icon flag-icon-{{$key}} text-center"></div>
                            </div>
                            <livewire:translation-input :id="$translation->id" :locale="$key" :newTranslation="$value" :key="$loop->index">
                        </div>
                @endforeach


                <!--Footer-->
                    <div class="flex justify-center pt-2">
                        <button class="modal-close px-4 bg-indigo-600 p-3 rounded-lg text-white hover:bg-indigo-400 " wire:click="$emit('closeModal')">Close</button>
                    </div>

                </div>
            </div>
        </div>
    @endif
</div>
