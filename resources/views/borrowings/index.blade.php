<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Peminjaman Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg transition-colors duration-200">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if (session('success'))
                        <div class="bg-green-100 dark:bg-green-900/30 border-l-4 border-green-500 text-green-700 dark:text-green-400 p-4 mb-4 shadow-sm" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <a href="{{ route('borrowings.create') }}" class="bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-700 dark:hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded shadow transition-colors">
                                + Catat Peminjaman Baru
                            </a>
                            <a href="{{ route('borrowings.export_pdf') }}" class="bg-red-600 hover:bg-red-700 dark:bg-red-700 dark:hover:bg-red-600 text-white font-bold py-2 px-4 rounded ml-2 shadow transition-colors">
                                Export PDF
                            </a>
                        </div>

                        <form action="{{ route('borrowings.index') }}" method="GET" class="flex">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari nama peminjam..."
                                class="border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mr-2 transition-colors">
                            <button type="submit"
                                class="bg-gray-800 dark:bg-gray-700 hover:bg-gray-700 dark:hover:bg-gray-600 text-white font-bold py-2 px-4 rounded shadow transition-colors">
                                Cari
                            </button>
                        </form>
                    </div>

                    <div class="overflow-x-auto rounded-lg border dark:border-gray-700">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 dark:text-gray-300 uppercase bg-gray-50 dark:bg-gray-900/50 border-b dark:border-gray-700">
                                <tr>
                                    <th class="px-6 py-3">Nama Peminjam</th>
                                    <th class="px-6 py-3">Barang (Kode)</th>
                                    <th class="px-6 py-3">Jumlah</th>
                                    <th class="px-6 py-3">Tgl Pinjam</th>
                                    <th class="px-6 py-3">Status</th>
                                    <th class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($borrowings as $borrowing)
                                    <tr class="bg-white dark:bg-gray-800 border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-gray-100">{{ $borrowing->nama_peminjam }}</td>

                                        <td class="px-6 py-4">{{ $borrowing->product->nama_barang ?? 'Barang Dihapus' }} <br>
                                            <span class="text-xs text-gray-400 dark:text-gray-500">{{ $borrowing->product->kode_barang ?? '-' }}</span>
                                        </td>

                                        <td class="px-6 py-4 font-bold">{{ $borrowing->jumlah_pinjam }}</td>
                                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($borrowing->tanggal_pinjam)->format('d M Y') }}</td>

                                        <td class="px-6 py-4">
                                            @if($borrowing->status == 'Dipinjam')
                                                <span class="px-3 py-1 rounded text-xs font-semibold bg-yellow-100 text-yellow-800 border border-yellow-200 dark:bg-yellow-900/40 dark:text-yellow-400 dark:border-yellow-800 shadow-sm">
                                                    Sedang Dipinjam
                                                </span>
                                            @else
                                                <span class="px-3 py-1 rounded text-xs font-semibold bg-green-100 text-green-800 border border-green-200 dark:bg-green-900/40 dark:text-green-400 dark:border-green-800 shadow-sm">
                                                    Dikembalikan
                                                </span>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 text-center">
                                            @if($borrowing->status == 'Dipinjam')
                                                <form action="{{ route('borrowings.return', $borrowing->id) }}" method="POST" onsubmit="return confirm('Konfirmasi: Barang sudah diterima kembali ke gudang?');">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="text-white bg-green-500 hover:bg-green-600 dark:bg-green-600 dark:hover:bg-green-500 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center transition-colors">
                                                        Kembalikan Barang
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-gray-400 dark:text-gray-500 italic text-sm">Selesai pada <br>{{ \Carbon\Carbon::parse($borrowing->tanggal_kembali)->format('d M Y') }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                            <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-600 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                            Belum ada riwayat peminjaman barang.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if(isset($borrowings) && $borrowings->hasPages())
                        <div class="mt-4">
                            {{ $borrowings->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
