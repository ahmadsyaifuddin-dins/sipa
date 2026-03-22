<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'category_id', 'type', 'kode', 'nama', 'harga', 'stok', 'foto',
    ];

    // Relasi: Banyak Item dimiliki oleh 1 Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
