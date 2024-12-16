<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function categories()
    {
        // Mengambil semua data kategori
        $categories = Category::all();


        return view('spv.category', compact('categories'));
    }

    public function addCategory(Request $request)
    {
        // Validasi data yang dimasukkan
        $request->validate([
            'name' => 'required|string|max:255', // Pastikan nama kategori wajib diisi dan berupa string
        ]);

        // Menyimpan data kategori baru ke dalam tabel Category
        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('spv.category')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id); // Mencari kategori berdasarkan ID
            $category->delete(); // Menghapus kategori dari database

            return response()->json([
                'message' => 'Kategori berhasil dihapus!'
            ], 200); // Mengembalikan respons sukses
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus kategori. Silakan coba lagi.'
            ], 500); // Mengembalikan respons error jika terjadi kesalahan
        }
    }
}
