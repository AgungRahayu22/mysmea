<?php
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LoginComponent extends Component
{
    public $email, $password;

    public function proses()
{
    // Validasi input
    $this->validate([
        'email' => 'required|email',
        'password' => 'required',
    ], [
        'email.required' => 'Email harus diisi',
        'password.required' => 'Password harus diisi',
    ]);

    // Autentikasi
    if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
        $user = Auth::user();

        // Arahkan pengguna ke halaman yang sesuai dengan perannya
        if ($user->jenis === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->jenis === 'petugas') {
            return redirect()->route('petugas.dabuk');
        } else {
            return redirect()->route('user.pinjam'); // Pastikan rute ini sesuai
        }
    } else {
        // Jika login gagal
        session()->flash('error', 'Email atau password salah.');
    }
}

}
