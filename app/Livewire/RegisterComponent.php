<?php
namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class RegisterComponent extends Component
{
    public $nama, $email, $password, $password_confirmation, $alamat, $telepon;

    // Menambahkan validasi untuk input
    protected $rules = [
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed|min:4',
        'alamat' => 'required|string|max:255',
        'telepon' => 'required|string|max:15',
    ];

    // Menambahkan custom message untuk validasi
    protected $messages = [
        'nama.required' => 'Nama wajib diisi.',
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Email tidak valid.',
        'email.unique' => 'Email sudah terdaftar.',
        'password.required' => 'Password wajib diisi.',
        'password.confirmed' => 'Password dan konfirmasi password tidak cocok.',
        'password.min' => 'Password harus memiliki minimal 4 karakter.',
        'alamat.required' => 'Alamat wajib diisi.',
        'telepon.required' => 'Nomor telepon wajib diisi.',
    ];

    public function register()
    {
        
        // Melakukan validasi
        $this->validate();

        // Membuat user baru dengan data yang sudah tervalidasi
        User::create([
            'nama' => $this->nama,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'alamat' => $this->alamat,
            'telepon' => $this->telepon,
            'jenis' => 'user', // Jenis diatur otomatis menjadi 'user'
        ]);

        // Menampilkan pesan sukses dan mengarahkan ke halaman login
        session()->flash('success', 'Registrasi berhasil! Silakan login.');
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.register-component');
    }
}
