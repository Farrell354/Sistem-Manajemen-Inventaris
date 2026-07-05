<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pusat Laporan Audit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg transition-colors duration-200">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h3 class="text-lg font-bold mb-4">Unduh Dokumen Laporan</h3>
                    <p class="mb-6 text-gray-600 dark:text-gray-400">Pilih jenis laporan operasional yang ingin Anda unduh untuk keperluan
                        audit atau rekapitulasi data.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="border dark:border-gray-700 p-6 rounded-lg shadow-sm bg-gray-50 dark:bg-gray-700/50 flex flex-col items-center text-center transition-colors">
                            <svg class="w-12 h-12 text-red-500 dark:text-red-400 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                </path>
                            </svg>
                            <h4 class="font-bold text-lg mb-2">Laporan Stok Master Barang</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Mencetak seluruh daftar barang, kategori, lokasi rak,
                                beserta sisa stok fisik saat ini.</p>
                            <a href="{{ route('products.export_pdf') }}"
                                class="mt-auto bg-red-600 hover:bg-red-700 dark:bg-red-700 dark:hover:bg-red-600 text-white font-bold py-2 px-4 rounded w-full transition-colors">
                                Unduh PDF
                            </a>
                        </div>

                        <div class="border dark:border-gray-700 p-6 rounded-lg shadow-sm bg-gray-50 dark:bg-gray-700/50 flex flex-col items-center text-center transition-colors">
                            <svg class="w-12 h-12 text-blue-500 dark:text-blue-400 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            <h4 class="font-bold text-lg mb-2">Laporan Riwayat Peminjaman</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Mencetak rekapitulasi data barang keluar, nama
                                peminjam, tanggal, dan status pengembalian.</p>

                            <a href="{{ route('borrowings.export_pdf') }}"
                                class="mt-auto bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-600 text-white font-bold py-2 px-4 rounded w-full transition-colors">
                                Unduh PDF
                            </a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
