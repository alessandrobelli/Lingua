<div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    @if($translation != "")
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div
            class="flex min-h-full items-end justify-center text-center items-center p-0 {{ $isOpen ? '' : 'opacity-0 pointer-events-none' }}">

            <div
                class="relative transform overflow-hidden rounded-lg bg-white px-4 pt-5 pb-4 text-left shadow-xl transition-all my-8 max-w-xl p-6">
                <div>
                    <!--Title-->
                    <div class="my-2 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-2xl font-medium text-gray-900" id="modal-title">
                            {{$translation->string}}
                        </h3>
                    </div>


                    <!--Body-->

                    @foreach($translation->locales as $key => $value)
                    <?php
                        /** @var $key */
                        $locale = alessandrobelli\Lingua\LinguaUtilities::array_multidimensional_search(config('lingua.locales-list'),'locale',$key)[0];
                        ?>
                    <div class="flex">
                        <div
                            class="flex flex-row justify-center mx-auto w-40 p-2 cursor-none bg-blue-500 text-white text-center flex-shrink select-none border-b-2 border-gray-200">
                            {{$locale['isolanguagename']}} <br>
                            {{$locale['nativename']}}
                        </div>
                        <livewire:translation-input :id="$translation->id" :locale="$key" :newTranslation="$value"
                            :key="$loop->index">
                    </div>
                    @endforeach



                    <div class="flex justify-center pt-2">

                        <button type="button" wire:click="$emit('closeModal')"
                            class=" relative -ml-px inline-flex items-center rounded-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-10 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                            <span class="sr-only">Close</span>
                            <!-- Heroicon name: mini/chevron-right -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                </div>
            </div>
            @endif
        </div>