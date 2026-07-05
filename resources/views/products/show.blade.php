<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 overflow-hidden shadow-sm sm:rounded-lg transition-colors duration-200">
                <div class="p-6 flex flex-col md:flex-row gap-8">

                    <div class="w-full md:w-1/3 flex flex-col items-center justify-start">
                        @if($product->gambar)
                            <img src="{{ asset('storage/' . $product->gambar) }}" alt="Foto {{ $product->nama_barang }}"
                                 class="w-full max-w-sm rounded-lg shadow-md border dark:border-gray-700 object-cover">
                        @else
                            <div class="w-full max-w-sm h-64 bg-gray-50 dark:bg-gray-700 rounded-lg flex flex-col items-center justify-center border-2 border-dashed border-gray-300 dark:border-gray-600">
                                <svg class="w-12 h-12 text-gray-400 dark:text-gray-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-gray-400 dark:text-gray-500 italic text-sm">Belum ada foto</span>
                            </div>
                        @endif
                    </div>

                    <div class="w-full md:w-2/3">
                        <h3 class="text-2xl font-bold mb-6 border-b dark:border-gray-700 pb-2">Informasi Aset: {{ $product->nama_barang }}</h3>

                        <table class="table-auto w-full text-left border-collapse">
                            <tbody>
                                <tr class="border-b dark:border-gray-700">
                                    <th class="py-3 w-1/3 text-gray-600 dark:text-gray-400">Kode Barang</th>
                                    <td class="py-3 font-semibold">: {{ $product->kode_barang }}</td>
                                </tr>
                                <tr class="border-b dark:border-gray-700">
                                    <th class="py-3 text-gray-600 dark:text-gray-400">Kategori</th>
                                    <td class="py-3">: {{ $product->category->nama_kategori ?? '-' }}</td>
                                </tr>
                                <tr class="border-b dark:border-gray-700">
                                    <th class="py-3 text-gray-600 dark:text-gray-400">Stok Aktual</th>
                                    <td class="py-3 font-bold text-blue-600 dark:text-blue-400 text-lg">: {{ $product->stok }} Unit</td>
                                </tr>
                                <tr class="border-b dark:border-gray-700">
                                    <th class="py-3 text-gray-600 dark:text-gray-400">Lokasi Penyimpanan</th>
                                    <td class="py-3">: {{ $product->lokasi_penyimpanan }}</td>
                                </tr>
                                <tr class="border-b dark:border-gray-700">
                                    <th class="py-3 text-gray-600 dark:text-gray-400">Kondisi Barang</th>
                                    <td class="py-3">:
                                        <span class="px-3 py-1 bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300 font-semibold rounded text-sm shadow-sm border border-green-200 dark:border-green-800">
                                            {{ $product->kondisi_barang }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="mt-8 flex gap-3">
                            <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-600 dark:bg-gray-600 dark:hover:bg-gray-500 text-white font-bold py-2 px-4 rounded shadow transition">
                                ← Kembali ke Master Data
                            </a>
                            <a href="{{ route('products.edit', $product->id) }}" class="bg-yellow-500 hover:bg-yellow-600 dark:bg-yellow-600 dark:hover:bg-yellow-500 text-white font-bold py-2 px-4 rounded shadow transition">
                                Edit Barang
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
