<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Master Data Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg transition-colors duration-200">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session('success'))
                        <div class="bg-green-100 dark:bg-green-900/30 border-l-4 border-green-500 text-green-700 dark:text-green-400 p-4 mb-4" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <a href="{{ route('products.create') }}" class="bg-gray-800 dark:bg-gray-700 hover:bg-gray-700 dark:hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition">
                                + Tambah Barang
                            </a>
                            <a href="{{ route('products.export_pdf') }}" class="bg-red-600 hover:bg-red-700 dark:bg-red-700 dark:hover:bg-red-600 text-white font-bold py-2 px-4 rounded ml-2 transition">
                                Export PDF
                            </a>
                            <a href="{{ route('products.export.excel') }}" class="bg-green-600 hover:bg-green-800 dark:bg-green-700 dark:hover:bg-green-600 text-white font-bold py-2 px-4 rounded ml-2 transition">
                                Export Excel
                            </a>
                        </div>

                        <form action="{{ route('products.index') }}" method="GET" class="flex">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari kode/nama barang..."
                                class="border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mr-2 transition-colors">
                            <button type="submit"
                                class="bg-gray-800 dark:bg-gray-700 hover:bg-gray-700 dark:hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition">
                                Cari
                            </button>
                        </form>
                    </div>

                    <div class="overflow-x-auto rounded-lg border dark:border-gray-700">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 dark:text-gray-300 uppercase bg-gray-50 dark:bg-gray-900/50 border-b dark:border-gray-700">
                                <tr>
                                    <th class="px-6 py-3">Kode</th>
                                    <th class="px-6 py-3">Nama Barang</th>
                                    <th class="px-6 py-3">Stok</th>
                                    <th class="px-6 py-3">Lokasi</th>
                                    <th class="px-6 py-3">Kondisi</th>
                                    <th class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr class="bg-white dark:bg-gray-800 border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                        <td class="px-6 py-4">{{ $product->kode_barang }}</td>
                                        <td class="px-6 py-4 font-bold text-gray-900 dark:text-gray-100">{{ $product->nama_barang }}</td>
                                        <td class="px-6 py-4">{{ $product->stok }}</td>
                                        <td class="px-6 py-4">{{ $product->lokasi_penyimpanan }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 py-1 rounded text-xs font-semibold shadow-sm border
                                                {{ $product->kondisi_barang == 'Baik' ? 'bg-green-100 text-green-800 border-green-200 dark:bg-green-900/40 dark:text-green-400 dark:border-green-800' :
                                                ($product->kondisi_barang == 'Rusak Ringan' ? 'bg-yellow-100 text-yellow-800 border-yellow-200 dark:bg-yellow-900/40 dark:text-yellow-400 dark:border-yellow-800' :
                                                'bg-red-100 text-red-800 border-red-200 dark:bg-red-900/40 dark:text-red-400 dark:border-red-800') }}">
                                                {{ $product->kondisi_barang }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center flex justify-center space-x-3">
                                            <a href="{{ route('products.show', $product->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline font-semibold">Detail</a>
                                            <a href="{{ route('products.edit', $product->id) }}" class="text-blue-600 dark:text-blue-400 hover:underline font-semibold">Edit</a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus barang ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 dark:text-red-400 hover:underline font-semibold">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">Belum ada data barang.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
