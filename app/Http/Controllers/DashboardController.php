<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung Total Jenis Barang
        $totalBarang = Product::count();

        // 2. Hitung Total Stok Tersedia
        $barangTersedia = Product::sum('stok');

        // 3. Hitung Total Barang Sedang Dipinjam
        $barangDipinjam = BorrowingDetail::whereHas('borrowing', function($query) {
            $query->where('status', 'Dipinjam');
        })->sum('jumlah');

        // --- TAMBAHAN BARU: Deteksi Stok Menipis (Stok <= 5) ---
        $stokMenipis = Product::where('stok', '<=', 5)->get();

        // 4. Siapkan Data Grafik Peminjaman per Bulan
        $tahunIni = date('Y');
        $peminjamanTahunIni = Borrowing::whereYear('tanggal_pinjam', $tahunIni)->get();

        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = $peminjamanTahunIni->filter(function($b) use ($i) {
                return \Carbon\Carbon::parse($b->tanggal_pinjam)->month == $i;
            })->count();
        }

        // Jangan lupa tambahkan 'stokMenipis' ke dalam compact
        return view('dashboard', compact(
            'totalBarang',
            'barangTersedia',
            'barangDipinjam',
            'chartData',
            'tahunIni',
            'stokMenipis'
        ));
    }
}
