<nav class="bg-blue-900 shadow mb-8 py-4">
    <div class="container mx-auto px-6 md:px-0">
        <div class="flex items-center justify-center">
            <div class="mr-6 flex">
                <div class="flex-shrink-0">
                    <a href="{{ url('/') }}" class="flex items-center text-lg font-semibold text-gray-100 no-underline">
                        {!! config('app.logo')  !!}
                        {{ config('app.name', 'Lingua') }}
                    </a>
                </div>
            </div>
            <div class="flex-1 text-right">
                @guest
                    <a class="no-underline hover:underline text-gray-300 text-sm p-3" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @if (\Route::has('register'))
                        <a class="no-underline hover:underline text-gray-300 text-sm p-3" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                @else
                    <div class="inline-block relative" x-data="{ open: false }">
                        <span class="text-gray-300 text-sm pr-4 cursor-pointer" @click="open = !open">{{ auth()->user()->email }}</span>

                        <img class="w-10 h-10 rounded-full mr-4 inline cursor-pointer"
                             src="https://www.gravatar.com/avatar/{{md5( strtolower( trim( auth()->user()->email) ) ) }}"
                             alt="Avatar of {{auth()->user()->email}}" @click="open = !open">
                        <ul class="bg-white absolute mt-2 shadow w-40 py-1 text-indigo-600" x-show="open">
                            <li><a href="{{ route('logout') }}" class="py-1 px-3 block hover:bg-indigo-100 text-blue-900" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">{{ __('Logout') }}</a></li>
                        </ul>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        {{ csrf_field() }}
                    </form>

                @endguest
            </div>
        </div>
    </div>
</nav>
