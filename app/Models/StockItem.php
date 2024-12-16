<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockItem extends Model
{
    use HasFactory;

    // Menambahkan 'category_id' ke dalam fillable
    protected $fillable = [
        'name',
        'quantity',
        'satuan',
        'price',
        'supplier_id',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //hubungan stock 1 stok 1 kategori
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
