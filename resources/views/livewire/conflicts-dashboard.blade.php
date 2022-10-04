<div>
    <livewire:confirm-delete-modal>

        <h1 class="text-4xl font-bold text-gray-800 opacity-75 text-center">Conflicts dashboard</h1>
        @if(empty($conflictsArray))
            <h1 class="text-2xl font-bold text-gray-800 opacity-75 my-2">You have no similar strings!</h1>
        @else

            <h1 class="text-2xl font-bold text-gray-800 opacity-75">Similar strings</h1>
            <p class="text-base font-bold text-gray-400">Changes will reflect the database as well as the files.</p>
            <p class="text-base font-bold text-gray-400 mb-2">In this case, project will not be transferred to the chosen string.</p>
            <div class="w-full mb-2">
                <table class="table-auto w-full">
                    <thead class="bg-gray-200">
                    <tr>
                        <th class="w-1/2 px-4 py-2">
                            <a role="button">
                                String
                            </a>
                        </th>
                        <th class="w-1/4 px-4 py-2">
                            <a role="button">
                                Locales
                            </a>
                        </th>
                        <th class="w-1/8 px-4 py-2">
                            <a role="button">
                                Project
                            </a>
                        </th>
                        <th class="w-1/4 px-4 py-2">
                            <a role="button">
                                Actions
                            </a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($conflictsArray as $key => $conflictSubArray)
                        @foreach($conflictSubArray as  $conflict)
                            <tr class="{{$key%2 == 0 ?'bg-gray-400'  : 'bg-white' }} @if($loop->last) border border-b-2 border-black @endif @if($loop->first)border border-t-2 border-black @endif">
                                <td class="border px-4 py-2">{{$conflict->string ?? 'a'}}</td>
                                <td class="border px-4 py-2 text-center items-center">
                                    @if(!empty($conflict->locales))
                                        @foreach($conflict->locales as $language => $locale)
                                            {{$language}} : <span class="italic text-xs"> {{empty($locale)? 'No translation.' : $locale}}</span>
                                        @endforeach
                                    @else
                                        No locales found.
                                    @endif
                                </td>
                                <td class="border w-auto">{{$conflict->project ?? 'a'}}</td>
                                <td class="border px-4 py-2">
                                    <button class="{{$key%2 == 0 ?'bg-gray-600 hover:bg-gray-700'  : 'bg-gray-100 hover:bg-gray-200' }}  text-black font-bold py-2 px-4"
                                            wire:click.prevent="$emit('confirmDelete','merge translations','all the translations in the group',[{{json_encode($conflictSubArray)}},{{$conflict}}],'<p class=\'bg-yellow-400 border font-bold border-red-400 text-black px-4 py-3 rounded relative\'>CAREFUL!</p> This will replace every other string with this, in the database and files.')"

                                    >
                                        Unify into this.
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>

                <div class="w-full mt-2">
                </div>
            </div>
        @endif
        <h1 class="text-2xl font-bold text-gray-800 opacity-75">Text not wrapped for translation</h1>
        <p class="text-base font-bold text-gray-400 mb-2">Changes will reflect the database as well as the files.</p>
        <p class="text-center opacity-50 text-red-700 font-bold">You can undo your actions with Ctrl(or CMD for macOS) + z</p>

        <div class="w-full mb-2">
            <table class="table-auto w-full">
                <thead class="bg-gray-200">
                <tr>
                    <th class="w-1/2 px-4 py-2">
                        <a role="button">
                            String
                        </a>
                    </th>
                    <th class="w-1/4 px-4 py-2">
                        <a role="button">
                            Position
                        </a>
                    </th>
                    <th class="w-1/4 px-4 py-2">
                        <a role="button">
                            Actions
                        </a>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($missed as $missedArray)

                    <tr class="bg-white">
                        <td class="border px-4 py-2">{{$missedArray[0]}}</td>
                        <td class="border px-4 py-2 text-center items-center">
                            {{$missedArray[1]}} {{$missedArray[2]}}
                        </td>
                        <td class="border px-4 py-2">
                            <button class="bg-gray-100 hover:bg-gray-200  text-black font-bold py-2 px-4"
                                    wire:click.prevent="wrap('{{$missedArray[0]}}','{{$missedArray[1]}}')"
                            >
                                Wrap in tag for translation.
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div wire:loading class="w-full h-full fixed block top-0 left-0 bg-indigo-200 opacity-75 z-50 text-center align-center">
                <div class="absolute inset-0 flex items-center justify-center ">
                    <span class="lds-dual-ring"></span>
                </div>

            </div>
        </div>
        <script>
					document.addEventListener('livewire:load', function() {

						function KeyPress(e) {
							var evtobj = window.event ? event : e;
							if ((evtobj.ctrlKey || evtobj.metaKey) && e.keyCode === 90)
							{
								evtobj.preventDefault();
								evtobj.stopPropagation();
							@this.undoWrap();
							}
						}

						document.onkeydown = KeyPress;

					});
        </script>

</div>
