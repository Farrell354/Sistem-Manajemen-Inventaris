<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Peminjaman Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-center mb-6">
                        <a href="{{ route('borrowings.create') }}" class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            + Pinjam Barang
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 border">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 border-b">Nama Peminjam</th>
                                    <th class="px-6 py-3 border-b">Barang (Jumlah)</th>
                                    <th class="px-6 py-3 border-b">Tgl Pinjam</th>
                                    <th class="px-6 py-3 border-b">Tgl Kembali</th>
                                    <th class="px-6 py-3 border-b">Status</th>
                                    <th class="px-6 py-3 border-b text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($borrowings as $borrowing)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <td class="px-6 py-4">{{ $borrowing->user->name }}</td>
                                        <td class="px-6 py-4">
                                            @foreach($borrowing->details as $detail)
                                                {{ $detail->product->nama_barang }} ({{ $detail->jumlah }})
                                            @endforeach
                                        </td>
                                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($borrowing->tanggal_pinjam)->format('d M Y') }}</td>
                                        <td class="px-6 py-4">
                                            {{ $borrowing->tanggal_kembali ? \Carbon\Carbon::parse($borrowing->tanggal_kembali)->format('d M Y') : '-' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 py-1 rounded text-xs text-white {{ $borrowing->status == 'Dipinjam' ? 'bg-yellow-500' : 'bg-green-500' }}">
                                                {{ $borrowing->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center flex justify-center">
                                            @if($borrowing->status == 'Dipinjam')
                                                <form action="{{ route('borrowings.return', $borrowing->id) }}" method="POST" onsubmit="return confirm('Konfirmasi pengembalian barang?');">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-1 px-3 rounded text-xs">
                                                        Kembalikan
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-gray-400 text-xs italic">Selesai</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                            Belum ada riwayat peminjaman.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $borrowings->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
