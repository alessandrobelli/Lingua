<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lingua') }}</title>


    @if (file_exists(public_path('js/manifest.js')))
        <script src="{{ asset('js/manifest.js') }}"></script>
    @endif
    @if(file_exists(public_path('js/vendor.js')))
        <script src="{{ asset('js/vendor.js') }}"></script>
    @endif

    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .box:not(:last-child), .content:not(:last-child), .notification:not(:last-child), .progress:not(:last-child), .table:not(:last-child), .table-container:not(:last-child), .title:not(:last-child), .subtitle:not(:last-child), .block:not(:last-child), .highlight:not(:last-child), .breadcrumb:not(:last-child), .level:not(:last-child), .list:not(:last-child), .message:not(:last-child), .tabs:not(:last-child) {
            margin-bottom: inherit !important;
        }
    </style>

    @livewireStyles

    @yield('pagespecificscripts')
</head>
<body class="bg-gray-100 h-screen antialiased">
@livewireScripts


@include('lingua::layouts.mainnav')
<div class="flex items-center">
    <livewire:toast-message-show>

        <div class="w-2/3 mx-auto mx-10">
            @if(in_array(auth()->user()->email, config('lingua.translator')) || in_array(auth()->user()->email, config('lingua.admin')))
                <div class="flex items-center justify-center mb-2">
                    <div class="mr-2">
                        <a @if(\Route::current()->getName() != 'lingua.index') href="{{route('lingua.index')}}" @endif
                        class="bg-white  font-bold rounded border-b-2 border-blue-500 select-none hover:border-blue-600 hover:bg-blue-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center
                                @if(\Route::current()->getName() == 'lingua.index') bg-blue-500 text-white cursor-none  hover:text-white shadow-inner @endif
                            ">
                            <span class="mr-2">Dashboard</span>
                        </a>
                    </div>

                    @endif
                    @if(in_array(auth()->user()->email, config('lingua.admin')))
                        <div class="">
                            <a @if(\Route::current()->getName() != 'lingua.create') href="{{route('lingua.create')}}" @endif
                            class="bg-white font-bold rounded border-b-2 border-blue-500 select-none hover:border-blue-600 hover:bg-blue-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center
                            @if(\Route::current()->getName() == 'lingua.create') bg-blue-500 text-white cursor-none disabled hover:text-white @endif
                                ">
                                <span class="mr-2">Upload</span>
                            </a>
                        </div>
                </div>
            @endif

            @yield('content')
        </div>
</div>

</body>
</html>

