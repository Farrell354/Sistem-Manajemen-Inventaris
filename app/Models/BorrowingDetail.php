<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BorrowingDetail extends Model
{
    protected $guarded = [];

    // Relasi ke Produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    // Relasi balik ke tabel peminjaman utama
    public function borrowing()
    {
        return $this->belongsTo(Borrowing::class);
    }
}
