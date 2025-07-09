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

        <!-- CSS Tambahan -->
        <link href="{{ asset('css/auth.css') }}" rel="stylesheet" />

        <!-- Vite Assets -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans text-gray-900 antialiased">
        <!-- Ganti div wrapper dengan background gambar -->
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0"
             style="background-image: url('/images/fabric/fabric3.jpeg');
                    background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;
                    background-attachment: fixed;
             ">
             
            <!-- Optional: Overlay hitam transparan -->
            <div style="
                position: absolute;
                top: 0; left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0,0,0,0.3);
                z-index: 0;
            "></div>

            <!-- Logo atau header lain jika ada -->
            <div class="z-10">
                <!-- bisa diisi logo -->
            </div>

            <!-- Card konten -->
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white bg-opacity-95 shadow-md overflow-hidden sm:rounded-lg relative z-10">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
