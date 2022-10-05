<div>
    @if($whatToDelete != "")
        <div class="z-50 modal fixed w-full h-full top-0 left-0 flex items-center justify-center {{ $isOpen ? '' : 'opacity-0 pointer-events-none' }}">
            <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>


            <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

                <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50" wire:click="$emit('closeModal')">
                    <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                    <span class="text-sm">(Esc)</span>
                </div>

                <!-- Add margin if you want to see some of the overlay behind the modal-->
                <div class="modal-content py-4 text-left px-6">
                    <!--Title-->
                    <div class="flex justify-between items-center pb-3">
                        <p class="text-2xl font-bold">
                            @if($entityToDelete === "merge translations")
                            Merge
                            @else
                                Delete
                            @endif
                            {{$whatToDelete}}</p>
                        <div class="modal-close cursor-pointer z-50" wire:click="$emit('closeModal')">
                            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                            </svg>
                        </div>
                    </div>

                    <!--Body-->
                    <div class="w-full align-middle justify-center text-center mb-2">


                        <div class="block w-full flex align-middle">
                            <svg viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg" class="fill-current text-red-700 inline-block w-24 h-24 mr-2 flex-shrink justify-start">
                                <path d="M 500 0C 224 0 0 224 0 500C 0 776 224 1000 500 1000C 776 1000 1000 776 1000 500C 1000 224 776 0 500 0C 500 0 500 0 500 0M 500 25C 762 25 975 238 975 500C 975 762 762 975 500 975C 238 975 25 762 25 500C 25 238 238 25 500 25C 500 25 500 25 500 25M 526 150C 576 150 602 175 601 224C 600 300 600 350 575 525C 570 560 560 575 525 575C 525 575 475 575 475 575C 440 575 430 560 425 525C 400 355 400 300 400 226C 400 175 425 150 475 150M 500 650C 527 650 552 661 571 679C 589 698 600 723 600 750C 600 805 555 850 500 850C 445 850 400 805 400 750C 400 723 411 698 429 679C 448 661 473 650 500 650C 500 650 500 650 500 650"/>
                            </svg>
                            <div class="inline-block a-auto justify-end">
                                @if($entityToDelete !== "merge translations")
                                {{__('Are you sure you want to delete :whatToDelete ?',['whatToDelete' => $whatToDelete])}}
                                @endif
                                <br>
                                {!! $message !!}
                            </div>

                        </div>

                    </div>


                    <!--Footer-->
                    <div class="flex justify-end pt-2">
                        <button class="modal-close px-4 bg-indigo-600 p-3 rounded-lg text-white hover:bg-indigo-400 mr-2" wire:click="$emit('closeModal')">Cancel</button>
                        @if($entityToDelete === "merge translations")
                            <button class="inline-flex items-center justify-center p-2 text-gray-400 rounded-md hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" wire:click="delete()">Merge</button>

                        @else
                            <button class="inline-flex items-center justify-center p-2 text-red-400 rounded-md hover:text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" wire:click="delete()">Delete</button>

                        @endif

                    </div>


                </div>
            </div>
        </div>
        <div wire:loading class="w-full h-full fixed block top-0 left-0 bg-indigo-200 opacity-75 z-50 text-center align-center">
            <div class="absolute inset-0 flex items-center justify-center ">
                <span class="lds-dual-ring"></span>
            </div>

        </div>
    @endif
</div>
