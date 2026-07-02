<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Autentikasi - InventorySys</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <script src="https://cdn.tailwindcss.com"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-50">
        <div class="min-h-screen flex">

            <div class="hidden lg:flex w-1/2 bg-red-700 justify-center items-center relative overflow-hidden shadow-2xl z-10">
                <div class="absolute inset-0 bg-gradient-to-br from-red-800 to-gray-900 opacity-90"></div>

                <div class="relative z-10 text-center px-12 text-white">
                    <svg class="w-24 h-24 mx-auto mb-6 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <h2 class="text-4xl font-extrabold mb-4 tracking-wider">Inventory<span class="text-red-300">Sys</span></h2>
                    <p class="text-lg font-medium text-gray-300 leading-relaxed max-w-md mx-auto">
                        Portal autentikasi terpusat untuk operasional logistik dan manajemen rantai pasok Anda.
                    </p>
                </div>
            </div>

            <div class="w-full lg:w-1/2 flex flex-col justify-center items-center pt-6 sm:pt-0 px-4 sm:px-6 lg:px-8 bg-gray-100">
                <div class="w-full max-w-md">

                    <div class="lg:hidden text-center mb-8">
                        <h2 class="text-3xl font-extrabold text-red-700">Inventory<span class="text-gray-900">Sys</span></h2>
                    </div>

                    <div class="bg-white py-10 px-8 shadow-2xl rounded-2xl border border-gray-100">
                        {{ $slot }}
                    </div>

                </div>
            </div>

        </div>
    </body>
</html>
