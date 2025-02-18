<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BukuKategori;

class BukuKategoriController extends Controller
{
    public function index()
    {
        $categories = BukuKategori::all(); // Ambil semua data kategori

        return view('admin.katagori', compact('categories')); // Gunakan 'categories' (bukan 'category')
    }

    public function Petugas()
    {
        $categories = BukuKategori::all(); // Ambil semua data kategori

        return view('petugas.kategori', compact('categories')); // Gunakan 'categories' (bukan 'category')
    }



    public function store(Request $request)
    {
        $request->validate(['nama_kategori' => 'required|string|max:100']);
        BukuKategori::create(['nama_kategori' => $request->nama_kategori]);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $category = BukuKategori::findOrFail($id);
        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $request->validate(['nama_kategori' => 'required|string|max:100']);
        $category = BukuKategori::findOrFail($id);
        $category->update(['nama_kategori' => $request->nama_kategori]);

        return redirect()->back()->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        BukuKategori::destroy($id);
        return redirect()->back()->with('success', 'Kategori berhasil dihapus!');
    }
    public function storePetugas(Request $request)
    {
        $request->validate(['nama_kategori' => 'required|string|max:100']);
        BukuKategori::create(['nama_kategori' => $request->nama_kategori]);

        return redirect()->route('petugas.kategori')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function updatePetugas(Request $request, $id)
    {
        $request->validate(['nama_kategori' => 'required|string|max:100']);
        $category = BukuKategori::findOrFail($id);
        $category->update(['nama_kategori' => $request->nama_kategori]);

        return redirect()->route('petugas.kategori')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroyPetugas($id)
    {
        BukuKategori::destroy($id);
        return redirect()->route('petugas.kategori')->with('success', 'Kategori berhasil dihapus!');
    }
}
