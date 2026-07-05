<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class BorrowingController extends Controller
{
    // Menampilkan Riwayat Peminjaman
    public function index()
    {
        // Ambil data peminjaman beserta nama user dan detail produknya
        $borrowings = Borrowing::with(['user', 'details.product'])->latest()->paginate(10);
        return view('borrowings.index', compact('borrowings'));
    }

    // Menampilkan Form Peminjaman
    public function create()
{
    // Ambil barang yang stoknya masih ada aja biar gak error
    $products = Product::where('stok', '>', 0)->get();
    return view('borrowings.create', compact('products'));
}

    // Memproses Data Peminjaman (Kurangi Stok)
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($request->jumlah > $product->stok) {
            return back()->withErrors(['jumlah' => 'Stok tidak mencukupi! Stok tersisa: ' . $product->stok]);
        }

        // Gunakan DB Transaction agar jika ada error, data tidak tersimpan setengah-setengah
        DB::transaction(function () use ($request, $product) {
            // 1. Buat record peminjaman utama
            $borrowing = Borrowing::create([
                'user_id' => Auth::id(), // ID user yang sedang login
                'tanggal_pinjam' => now(),
                'status' => 'Dipinjam',
            ]);

            // 2. Buat record detail peminjaman
            BorrowingDetail::create([
                'borrowing_id' => $borrowing->id,
                'product_id' => $product->id,
                'jumlah' => $request->jumlah,
                'status_barang' => $product->kondisi_barang,
            ]);

            // 3. Kurangi stok barang
            $product->decrement('stok', $request->jumlah);
        });

        return redirect()->route('borrowings.index')->with('success', 'Barang berhasil dipinjam!');
    }

    // Memproses Pengembalian Barang (Tambah Stok Kembali)
    public function returnProduct(Borrowing $borrowing)
    {
        if ($borrowing->status === 'Dikembalikan') {
            return back()->with('error', 'Barang ini sudah dikembalikan.');
        }

        DB::transaction(function () use ($borrowing) {
            // 1. Ubah status dan tanggal kembali
            $borrowing->update([
                'status' => 'Dikembalikan',
                'tanggal_kembali' => now(),
            ]);

            // 2. Kembalikan stok untuk setiap barang yang dipinjam
            foreach ($borrowing->details as $detail) {
                $detail->product->increment('stok', $detail->jumlah);
            }
        });

        return redirect()->route('borrowings.index')->with('success', 'Barang berhasil dikembalikan!');
    }
    public function exportPdf()
    {
        // Ambil semua data peminjaman beserta relasinya
        $borrowings = Borrowing::with(['user', 'details.product'])->latest()->get();

        $pdf = Pdf::loadView('borrowings.pdf', compact('borrowings'));
        return $pdf->download('laporan-riwayat-peminjaman.pdf');
    }
}
