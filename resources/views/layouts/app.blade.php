<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">

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
        .box:not(:last-child),
        .content:not(:last-child),
        .notification:not(:last-child),
        .progress:not(:last-child),
        .table:not(:last-child),
        .table-container:not(:last-child),
        .title:not(:last-child),
        .subtitle:not(:last-child),
        .block:not(:last-child),
        .highlight:not(:last-child),
        .breadcrumb:not(:last-child),
        .level:not(:last-child),
        .list:not(:last-child),
        .message:not(:last-child),
        .tabs:not(:last-child) {
            margin-bottom: inherit !important;
        }

        .lds-dual-ring {
            display: inline-block;
            width: 64px;
            height: 64px;
        }

        .lds-dual-ring:after {
            content: " ";
            display: block;
            width: 46px;
            height: 46px;
            margin: 1px;
            border-radius: 50%;
            border: 5px solid #cef;
            border-color: #cef transparent #cef transparent;
            animation: lds-dual-ring 1.2s linear infinite;
        }

        @keyframes lds-dual-ring {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    @livewireStyles

    @yield('pagespecificscripts')
</head>

<body class="h-full antialiased">
    @livewireScripts

    <div class="min-h-full">
        @include('lingua::layouts.mainnav')

        <livewire:toast-message-show>

            <main class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">

                @yield('content')

            </main>



    </div>

</body>

</html>