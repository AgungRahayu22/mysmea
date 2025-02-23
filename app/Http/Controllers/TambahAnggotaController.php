<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TambahAnggotaController extends Controller
{
    public function index()
    {
        // Mendapatkan semua pengguna
         $users = User::whereIn('jenis', ['user', 'petugas','admin'])->get();
        return view('admin.kelola', compact('users'));
    }

    public function store(Request $request)
    {

        // Validasi data input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'jenis' => 'required|in:admin,petugas,user,superadmin',
            'alamat' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
        ]);

        // Simpan pengguna ke database
        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'jenis' => $request->jenis,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ]);

        return redirect()->route('admin.kelola')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.kelola', compact('user')); // Membuka view editUser untuk mengedit pengguna
    }

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    if ($user->jenis === 'admin') {
        return redirect()->route('admin.kelola')->with('error', 'Admin tidak dapat diubah.');
    }

    // Validasi data input
    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'jenis' => 'required|in:petugas,user',
        'alamat' => 'required|string|max:255',
        'telepon' => 'required|string|max:15',
    ]);

    $user->update([
        'nama' => $request->nama,
        'email' => $request->email,
        'jenis' => $request->jenis,
        'alamat' => $request->alamat,
        'telepon' => $request->telepon,
    ]);

    return redirect()->route('admin.kelola')->with('success', 'Pengguna berhasil diperbarui.');
}



public function destroy($id)
{
    $user = User::findOrFail($id);

    if ($user->jenis === 'admin') {
        return redirect()->route('admin.kelola')->with('error', 'Admin tidak dapat dihapus.');
    }

    $user->delete();
    return redirect()->route('admin.kelola')->with('success', 'Pengguna berhasil dihapus.');
}

}
