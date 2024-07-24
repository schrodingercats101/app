<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Loopple/loopple-public-assets@main/riva-dashboard-tailwind/riva-dashboard.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/exif-js/2.2.1/exif.min.js"></script>
        @if(auth('admin')->user())
            @vite(['resources/css/app.css', 'resources/js/app.js','resources/js/admin/admin.js',])
        @else
            @vite(['resources/css/app.css', 'resources/js/app.js'])
            @stack('scripts')
        @endif
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @if(auth('admin')->user())
                @include('layouts.admin-navigation')
            @elseif(auth('users')->user())
                @include('layouts.user-navigation')
            @else
                @include('layouts.guest-navigation')
            @endif

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
                @if(auth('admin')->user())
                <main class="flex">
                    {{ $slot }}
                </main>
                @else
                    <main class="">
                        {{ $slot }}
                    </main>
                @endif
            </div>
    </body>
</html>
