<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $guarded = ['id'];

    // TAMBAHKAN FUNGSI INI DI BAWAH
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
