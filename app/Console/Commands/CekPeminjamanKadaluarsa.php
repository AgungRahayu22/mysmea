<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\PeminjamanBuku;

class cekPeminjamanKadaluarsa extends Command
{
    protected $signature = 'peminjaman:cek-kadaluarsa';
    protected $description = 'Cek dan kembalikan buku yang sudah melewati batas waktu peminjaman';

    public function handle()
    {
        $now = Carbon::now();

        // Ambil semua peminjaman yang belum dikembalikan dan sudah melewati batas waktu
        $peminjamanTerlambat = PeminjamanBuku::whereNull('tanggal_kembali')
            ->where('tanggal_pinjam', '<', $now->subDays(7)) // Jika sudah lebih dari 7 hari
            ->get();

        foreach ($peminjamanTerlambat as $item) {
            // Update tanggal kembali jadi sekarang
            $item->update(['tanggal_kembali' => $now]);

            // Tambah stok buku kembali
            $item->book->increment('jumlah');

            $this->info("Buku ID {$item->book_id} otomatis dikembalikan.");
        }

        $this->info("Cek peminjaman kadaluarsa selesai.");
    }
}
