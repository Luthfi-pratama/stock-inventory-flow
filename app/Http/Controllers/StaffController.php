<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\StockItem;
use App\Models\Supplier;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $categories = Category::all(); //mengambil categori di db
        $suppliers = Supplier::all();
        return view('staff.dashboard', compact('categories', 'suppliers')); //merender resources/views/staff/dashboard.blade.php
    }

    public function create()
    {
        $categories = Category::all(); // Mengambil semua kategori
        $suppliers = Supplier::all();
        return view('staff.create', compact('categories', 'suppliers')); // Mengirimkan data kategori ke view
    }

    // Menambahkan Stok ke dalam database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string',
            'jumlah' => 'required|integer',
            'satuan' => 'required|string',
            'kategori' => 'required|exists:categories,id',
            'harga' => 'required|numeric',
            'supplier' => 'required|string',
        ]);

        // Simpan data ke database
        StockItem::create([
            'name' => $request->nama,
            'category_id' => $request->kategori,
            'quantity' => $request->jumlah,
            'price' => $request->harga,
            'supplier_id' => $request->supplier,
            'satuan' => $request->satuan,
        ]);

        // Redirect kembali ke halaman create dengan pesan sukses
        return redirect()->route('staff.create')->with('success', 'Data barang berhasil ditambahkan');
    }

    public function addStock(Request $request)
    {
        $request->validate([
            'name' => 'required|exists:stock_items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $stockItem = StockItem::where('name', $request->name)->first();

        if ($stockItem) {
            $stockItem->quantity += $request->jumlah;
            $stockItem->save();

            return response()->json([
                'message' => 'Stok barang berhasil ditambahkan!',
            ], 200);
        }

        return response()->json([
            'message' => 'Barang tidak ditemukan!',
        ], 404);
    }
}
