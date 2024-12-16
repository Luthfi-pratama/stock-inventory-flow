<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'contact', 'address', 'description'];

    // definisi hubungan 1 kategori banyak barang
    public function stockItems()
    {
        return $this->hasMany(StockItem::class, 'supplier_id');
    }
}
