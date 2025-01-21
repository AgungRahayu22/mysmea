<?php
namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class RegisterComponent extends Component
{
    public $nama, $email, $password, $password_confirmation, $alamat, $telepon, $jenis;

    // Menambahkan validasi password_confirmation
    protected $rules = [
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed|min:4',
        'alamat' => 'required|string|max:255',
        'telepon' => 'required|string|max:15',
        'jenis' => 'required|in:admin,petugas,user',
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
            'jenis' => $this->jenis,
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
