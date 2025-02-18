<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penerbit;

class PenerbitController extends Controller
{
    public function index()
    {
        $penerbits = Penerbit::all(); // Ambil semua data penerbit
        return view('admin.penerbit', compact('penerbits'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_penerbit' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'kontak' => 'required|numeric',
        ]);

        Penerbit::create($request->all());

        return redirect()->route('admin.penerbit')->with('success', 'Penerbit berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_penerbit' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'kontak' => 'required|numeric',
        ]);

        $penerbit = Penerbit::findOrFail($id);
        $penerbit->update($request->all());

        return redirect()->route('admin.penerbit')->with('success', 'Penerbit berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $penerbit = Penerbit::findOrFail($id);
        $penerbit->delete();

        return redirect()->route('admin.penerbit')->with('success', 'Penerbit berhasil dihapus!');
    }
    public function penerbit()
    {
        $penerbits = Penerbit::all(); // Ambil semua data penerbit
        return view('petugas.penerbit', compact('penerbits'));
    }

    public function storePenerbit(Request $request)
    {
        $request->validate([
            'nama_penerbit' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'kontak' => 'required|numeric',
        ]);

        Penerbit::create($request->all());

        return redirect()->route('petugas.penerbit')->with('success', 'Penerbit berhasil ditambahkan!');
    }

    public function updatePenerbit(Request $request, $id)
    {
        $request->validate([
            'nama_penerbit' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'kontak' => 'required|numeric',
        ]);

        $penerbit = Penerbit::findOrFail($id);
        $penerbit->update($request->all());

        return redirect()->route('petugas.penerbit')->with('success', 'Penerbit berhasil diperbarui!');
    }

    public function destroyPenerbit($id)
    {
        $penerbit = Penerbit::findOrFail($id);
        $penerbit->delete();

        return redirect()->route('petugas.penerbit')->with('success', 'Penerbit berhasil dihapus!');
    }

}
