<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    protected $guarded = [];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Detail Peminjaman
    public function details()
    {
        return $this->hasMany(BorrowingDetail::class);
    }
}
