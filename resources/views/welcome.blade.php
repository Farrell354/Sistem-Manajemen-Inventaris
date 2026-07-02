<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Manajemen Gudang</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="max-w-4xl w-full mx-auto p-6">
        <div class="text-center mb-10">
            <h1 class="text-5xl font-extrabold text-red-600 tracking-tight">
                Inventory<span class="text-gray-900">Sys</span>
            </h1>
            <p class="mt-3 text-gray-500 font-medium tracking-wide uppercase">
                Enterprise Warehouse Management
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="p-10 sm:p-14 text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-6">
                    <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>

                <h2 class="text-3xl font-bold text-gray-900 mb-4">Selamat Datang di Portal Logistik</h2>
                <p class="text-gray-600 text-lg mb-10 max-w-2xl mx-auto">
                    Aplikasi terintegrasi untuk mengelola siklus master data barang, pencatatan transaksi masuk-keluar, serta pelaporan audit operasional gudang secara real-time.
                </p>

                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 md:py-4 md:text-lg md:px-10 transition duration-150">
                                Masuk ke Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="w-full sm:w-auto flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 md:py-4 md:text-lg md:px-10 transition duration-150 shadow-md">
                                Log In
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="w-full sm:w-auto flex items-center justify-center px-8 py-3 border border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 md:py-4 md:text-lg md:px-10 transition duration-150 shadow-sm">
                                    Register Akun Baru
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>

            <div class="bg-gray-50 py-4 px-6 border-t border-gray-200 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} Sistem Informasi Operasional. All rights reserved.
            </div>
        </div>
    </div>

</body>
</html>
