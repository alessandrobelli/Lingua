<nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex flex-shrink-0 items-center">
                    <img class="hidden h-8 w-auto lg:block"
                        src="{!! config('app.logo', 'https://user-images.githubusercontent.com/3796324/193805249-5e340316-3b62-40e8-9d3d-77449045b794.png' )!!}"
                        alt="{{ config('app.name', 'Lingua') }}">
                </div>
                <div class="hidden sm:ml-6 sm:block">
                    <div class="flex space-x-4">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <a href="{{route('lingua.index')}}" class="@if(\Route::current()->getName() == 'lingua.index') bg-gray-900 text-white @else
                            hover:bg-gray-700 text-gray-300 hover:text-white @endif px-3 py-2 rounded-md text-sm
                            font-medium" @if(\Route::current()->getName() == 'lingua.index') aria-current="page"
                            @endif>Dashboard</a>

                        <a href="{{route('lingua.create')}}" @if(\Route::current()->getName() == 'lingua.create')
                            aria-current="page" @endif
                            class="@if(\Route::current()->getName() == 'lingua.create') bg-gray-900 text-white @else
                            hover:bg-gray-700 text-gray-300 hover:text-white @endif px-3 py-2 rounded-md text-sm
                            font-medium">Upload</a>

                        <a href="{{route('lingua.conflicts')}}" @if(\Route::current()->getName() == 'lingua.conflicts')
                            aria-current="page" @endif
                            class="@if(\Route::current()->getName() == 'lingua.conflicts') bg-gray-900 text-white @else
                            hover:bg-gray-700 text-gray-300 hover:text-white @endif px-3 py-2 rounded-md text-sm
                            font-medium">Conflict
                            Dashboard</a>
                    </div>
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">

                <!-- Profile dropdown -->
                <div class="relative ml-3 focus:r" x-data="{ open: false }">
                    <div>
                        <button type="button" @click="open = !open"
                            class="flex bg-gray-800 text-sm text-white justify-center align-center focus:outline-none focus:ring-0"
                            id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="sr-only">Open user menu</span>
                            <div class="p-2 justify-center align-center">{{ auth()->user()->email }}</div>
                            <div><img class="h-8 w-8 rounded-full"
                                    src="https://www.gravatar.com/avatar/{{md5( strtolower( trim( auth()->user()->email) ) ) }}"
                                    alt=""></div>
                        </button>
                    </div>
                    <div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1"
                        x-show="open">

                        <a href="{{ route('logout') }}" class="py-1 px-3 block hover:bg-indigo-100 text-blue-900"
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"
                            class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                            id="user-menu-item-0">{{__('Logout')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        {{ csrf_field() }}
    </form>
</nav>