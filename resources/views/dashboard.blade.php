<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Gudang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($stokMenipis->count() > 0)
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 shadow-sm sm:rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">
                                Peringatan: Terdapat {{ $stokMenipis->count() }} barang yang stoknya menipis (Sisa &le;
                                5)
                            </h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($stokMenipis as $item)
                                        <li>
                                            <span class="font-bold">{{ $item->kode_barang }}</span> -
                                            {{ $item->nama_barang }}
                                            (Tersisa: <span class="font-bold">{{ $item->stok }}</span>)
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                    <div class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Jenis Barang</div>
                    <div class="mt-2 text-3xl font-semibold text-gray-900">{{ $totalBarang }}</div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500">
                    <div class="text-sm font-medium text-gray-500 uppercase tracking-wider">Stok Barang Tersedia</div>
                    <div class="mt-2 text-3xl font-semibold text-gray-900">{{ $barangTersedia }}</div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-yellow-500">
                    <div class="text-sm font-medium text-gray-500 uppercase tracking-wider">Barang Sedang Dipinjam</div>
                    <div class="mt-2 text-3xl font-semibold text-gray-900">{{ $barangDipinjam }}</div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Grafik Peminjaman Tahun {{ $tahunIni }}</h3>
                    <div class="w-full" style="height: 400px;">
                        <canvas id="peminjamanChart"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('peminjamanChart').getContext('2d');
            const dataGrafik = @json($chartData); // Ambil data array dari controller

            new Chart(ctx, {
                type: 'bar', // Bisa diganti 'line' kalau mau bentuk garis
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov',
                        'Des'
                    ],
                    datasets: [{
                        label: 'Jumlah Transaksi Peminjaman',
                        data: dataGrafik,
                        backgroundColor: 'rgba(59, 130, 246, 0.5)',
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1 // Angka di sumbu Y bulat
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
