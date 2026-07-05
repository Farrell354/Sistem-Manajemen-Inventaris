<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsExport implements FromCollection, WithHeadings, WithMapping
{
    // Mengambil data barang beserta relasi kategorinya
    public function collection()
    {
        return Product::with('category')->get();
    }

    // Membuat Judul Kolom di baris paling atas Excel
    public function headings(): array
    {
        return [
            'No',
            'Kode Barang',
            'Nama Barang',
            'Kategori',
            'Stok',
            'Lokasi Penyimpanan',
            'Kondisi'
        ];
    }

    // Memetakan data dari database ke masing-masing kolom Excel
    public function map($product): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $product->kode_barang,
            $product->nama_barang,
            $product->category ? $product->category->nama_kategori : '-',
            $product->stok,
            $product->lokasi_penyimpanan,
            $product->kondisi_barang,
        ];
    }
}
