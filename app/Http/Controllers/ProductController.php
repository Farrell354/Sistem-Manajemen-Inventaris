<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_barang', 'like', '%' . $request->search . '%');
        }

        $products = $query->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:products,kode_barang',
            'nama_barang' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'stok' => 'required|integer|min:0',
            'lokasi_penyimpanan' => 'required|string|max:255',
            'kondisi_barang' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'kode_barang' => 'required|unique:products,kode_barang,' . $product->id,
            'nama_barang' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'stok' => 'required|integer|min:0',
            'lokasi_penyimpanan' => 'required|string|max:255',
            'kondisi_barang' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Data berhasil diperbarui!');
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
}
