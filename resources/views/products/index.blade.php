<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Master Data Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-center mb-6">

                        <a href="{{ route('products.create') }}"
                            class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            + Tambah Barang
                        </a>
                        <a href="{{ route('products.export_pdf') }}"
                            class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Export PDF
                        </a>

                        <form action="{{ route('products.index') }}" method="GET" class="flex">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari kode/nama barang..."
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mr-2">
                            <button type="submit"
                                class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cari
                            </button>
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 border">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 border-b">Kode</th>
                                    <th class="px-6 py-3 border-b">Nama Barang</th>
                                    <th class="px-6 py-3 border-b">Stok</th>
                                    <th class="px-6 py-3 border-b">Lokasi</th>
                                    <th class="px-6 py-3 border-b">Kondisi</th>
                                    <th class="px-6 py-3 border-b text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <td class="px-6 py-4">{{ $product->kode_barang }}</td>
                                        <td class="px-6 py-4">{{ $product->nama_barang }}</td>
                                        <td class="px-6 py-4">{{ $product->stok }}</td>
                                        <td class="px-6 py-4">{{ $product->lokasi_penyimpanan }}</td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 py-1 rounded text-xs text-white
                                                {{ $product->kondisi_barang == 'Baik' ? 'bg-green-500' : ($product->kondisi_barang == 'Rusak Ringan' ? 'bg-yellow-500' : 'bg-red-500') }}">
                                                {{ $product->kondisi_barang }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center flex justify-center space-x-2">
                                            <a href="{{ route('products.edit', $product->id) }}"
                                                class="text-blue-600 hover:underline">Edit</a>

                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus barang ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:underline">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                            Belum ada data barang.
                                        </td>
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
