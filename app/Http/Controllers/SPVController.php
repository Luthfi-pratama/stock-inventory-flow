<?php

namespace App\Http\Controllers;

use App\Models\StockItem;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SPVController extends Controller
{
    // Menampilkan dashboard SPV dengan data barang yang statusnya pending dan approved
    public function index()
    {
        // Mengambil data barang yang statusnya pending
        $pendingStocks = StockItem::where('status', 'pending')->paginate(10);
        $approvedStocks = StockItem::where('status', 'approved')->paginate(5);

        // Mengirimkan data ke view dashboard SPV
        return view('spv.dashboard', compact('pendingStocks', 'approvedStocks'));
    }


    public function master()
    {
        // Mengambil data barang yang statusnya pending
        $pendingStocks = StockItem::where('status', 'pending')->paginate(10);
        $approvedStocks = StockItem::where('status', 'approved')->paginate(5);
        $categories = Category::all(); // Ambil semua kategori
        $suppliers = Supplier::all(); // Ambil semua supplier

        // Mengirimkan data ke view master SPV
        return view('spv.master', compact('pendingStocks', 'approvedStocks', 'categories', 'suppliers'));
    }

    // Fungsi untuk menyetujui barang yang pending
    public function approve($id)
    {
        // Mencari barang berdasarkan ID yang diberikan
        $stock = StockItem::findOrFail($id);

        // Mengubah status barang menjadi approved
        $stock->status = 'approved';
        $stock->save();

        // Menyimpan pesan sukses ke dalam sesi
        session()->flash('success', 'Barang berhasil disetujui!');

        // Redirect kembali ke halaman dashboard SPV dengan pesan sukses
        return redirect()->route('spv.dashboard')->with('success', 'Barang berhasil disetujui.');
    }

    public function edit($id)
    {
        $stock = StockItem::findOrFail($id); // Ambil data berdasarkan ID
        $categories = Category::all(); // Ambil semua kategori
        $suppliers = Supplier::all(); // Ambil semua supplier


        return view('spv.edit', compact('stock', 'categories', 'suppliers'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'satuan' => 'required|string',
            'kategori' => 'required|integer',
            'harga' => 'required|numeric',
            'supplier' => 'required|integer',
        ]);

        $stock = StockItem::findOrFail($id);
        $stock->update([
            'name' => $validated['nama'],
            'quantity' => $validated['jumlah'],
            'satuan' => $validated['satuan'],
            'category_id' => $validated['kategori'],
            'price' => $validated['harga'],
            'supplier_id' => $validated['supplier'],
        ]);

        return redirect()->route('spv.master')->with('success', 'Data berhasil diupdate!');
    }





    public function destroy($id)
    {
        try {
            $stock = StockItem::findOrFail($id);
            $stock->delete();

            // Mengembalikan respons JSON untuk AJAX
            return response()->json([
                'message' => 'Data berhasil dihapus!'
            ], 200);
        } catch (\Exception $e) {
            // Menangani jika terjadi kesalahan
            return response()->json([
                'message' => 'Gagal menghapus data. Silakan coba lagi.'
            ], 500);
        }
    }
}
