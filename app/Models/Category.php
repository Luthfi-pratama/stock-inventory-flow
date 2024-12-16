<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories'; // Nama tabel

    protected $fillable = [
        'name', // Kolom yang bisa diisi
    ];

    // Jika ada relasi, tambahkan di sini. Misalnya, satu kategori memiliki banyak barang:
    public function stockItems()
    {
        return $this->hasMany(StockItem::class);
    }
}
