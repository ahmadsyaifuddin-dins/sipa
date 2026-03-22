<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['nama_kategori', 'slug'];

    // Relasi 1 Kategori memiliki Banyak Item
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
