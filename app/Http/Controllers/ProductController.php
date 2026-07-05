<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Tangkap kata kunci pencarian dari URL
        $search = $request->search;

        // Cari barang berdasarkan nama ATAU kode, lalu potong 10 per halaman
        $products = Product::with('category')
            ->when($search, function ($query, $search) {
                return $query->where('nama_barang', 'like', "%{$search}%")
                    ->orWhere('kode_barang', 'like', "%{$search}%");
            })
            ->paginate(10); // Angka 10 ini bisa kamu ubah sesuai selera

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        dd($request->all(), $request->hasFile('gambar'));
        $request->validate([
            'kode_barang' => 'required|unique:products,kode_barang',
            'nama_barang' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'stok' => 'required|integer|min:0',
            'lokasi_penyimpanan' => 'required|string|max:255',
            'kondisi_barang' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
        ]);

        Product::create($request->all());

        // 1. Siapkan array data yang mau disimpan
        $data = $request->all();

        // 2. Cek apakah ada file gambar yang diupload
        if ($request->hasFile('gambar')) {
            // Simpan gambar ke folder 'storage/app/public/gambar_barang'
            $path = $request->file('gambar')->store('gambar_barang', 'public');
            // Masukkan path/jalur gambarnya ke array data
            $data['gambar'] = $path;
        }

        // 3. Simpan ke database
        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // 1. Cari barang
        $product = Product::findOrFail($id);

        // 2. Validasi ketat
        $request->validate([
            'kode_barang' => 'required|unique:products,kode_barang,' . $product->id,
            'nama_barang' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'stok' => 'required|integer|min:0',
            'lokasi_penyimpanan' => 'required|string|max:255',
            'kondisi_barang' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'gambar' => 'nullable|image|max:2048'
        ]);

        // 3. Masukkan data teks ke model (tanpa save dulu)
        $product->kode_barang = $request->kode_barang;
        $product->nama_barang = $request->nama_barang;
        $product->category_id = $request->category_id;
        $product->stok = $request->stok;
        $product->lokasi_penyimpanan = $request->lokasi_penyimpanan;
        $product->kondisi_barang = $request->kondisi_barang;

        // 4. MESIN GAMBAR JALUR VVIP
        if ($request->hasFile('gambar')) {
            // Hapus fisik gambar lama
            if ($product->gambar) {
                Storage::disk('public')->delete($product->gambar);
            }
            // Simpan gambar baru ke folder
            $path = $request->file('gambar')->store('gambar_barang', 'public');

            // PAKSA masukkan nama gambar ke kolom database
            $product->gambar = $path;
        }

        // 5. JURUS PAMUNGKAS: Simpan semua perubahan secara paksa ke Database!
        $product->save();

        return redirect()->route('products.index')->with('success', 'Data dan foto berhasil diperbarui!');
    }
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Data berhasil dihapus!');
    }
    public function exportPdf()
    {
        $products = Product::all();

        // Load view khusus untuk bentuk PDF
        $pdf = Pdf::loadView('products.pdf', compact('products'));

        // Download file dengan nama 'laporan-inventaris.pdf'
        return $pdf->download('laporan-inventaris.pdf');
    }
    public function show($id)
    {
        // Mengambil data barang berdasarkan ID, sekalian narik data relasi kategori
        $product = Product::with('category')->findOrFail($id);

        return view('products.show', compact('product'));
    }
    public function exportExcel()
    {
        // Akan mengunduh file bernama Laporan_Stok_Barang.xlsx
        return Excel::download(new ProductsExport, 'Laporan_Stok_Barang.xlsx');
    }
}
