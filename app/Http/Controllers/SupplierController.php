<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;


class SupplierController extends Controller
{
    public function suppliers()
    {
        // Mengambil semua data supplier
        $suppliers = Supplier::all();

        return view('spv.supplier', compact('suppliers'));
    }

    public function addSupplier(Request $request)
    {
        // Validasi data yang dimasukkan
        $request->validate([
            'name' => 'required|string|max:255', // Pastikan nama supplier wajib diisi dan berupa string
        ]);

        // Menyimpan data supplier baru ke dalam tabel Supplier
        Supplier::create([
            'name' => $request->name,
            'contact' => $request->contact,  // Menambahkan data kontak supplier
            'address' => $request->address,  // Menambahkan data alamat supplier
            'description' => $request->description,  // Menambahkan deskripsi supplier
        ]);


        return redirect()->route('spv.supplier')->with('success', 'Supplier berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        try {
            $category = Supplier::findOrFail($id); // Mencari kategori berdasarkan ID
            $category->delete(); // Menghapus kategori dari database

            return response()->json([
                'message' => 'Supplier berhasil dihapus!'
            ], 200); // Mengembalikan respons sukses
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus Supplier. Silakan coba lagi.'
            ], 500); // Mengembalikan respons error jika terjadi kesalahan
        }
    }
}
