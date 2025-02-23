<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    public function kelola()
    {
        return view('admin.kelola');
    }
     public function Databuku()
    {
        return view('admin.databuku');
    }
     public function penerbit()
    {
        return view('admin.penerbit');
    }
     public function peminjamanbuku()
    {
        return view('admin.peminjamanbuku');
    }
     public function ulasanbuku()
    {
        return view('admin.ulasanbuku');
    }
     public function laporanbuku()
    {
        return view('admin.laporanbuku');
    }
    public function Katagoribuku()
    {
        return view('admin.katagori');
    }
    public function Data()
    {
        // Ambil daftar file backup dari hari kemarin
        $backupPath = storage_path('app/backups');
        $yesterdayBackups = [];

        if (is_dir($backupPath)) {
            $files = scandir($backupPath);
            $yesterday = now()->yesterday()->format('Y-m-d');

            foreach ($files as $file) {
                // Perbaiki pattern pencarian untuk mencocokkan format nama file yang benar
                if (pathinfo($file, PATHINFO_EXTENSION) === 'sql' &&
                    strpos($file, 'backup_' . env('DB_DATABASE') . '_' . $yesterday) !== false) {
                    $filepath = $backupPath . '/' . $file;
                    $yesterdayBackups[] = [
                        'filename' => $file,
                        'size' => filesize($filepath),
                        'created_at' => filectime($filepath)
                    ];
                }
            }

            // Urutkan dari yang terbaru
            usort($yesterdayBackups, function($a, $b) {
                return $b['created_at'] - $a['created_at'];
            });
        }

        // Debug: tambahkan log untuk memeriksa hasil
        \Log::info('Yesterday Backups:', [
            'date' => now()->yesterday()->format('Y-m-d'),
            'found_files' => $yesterdayBackups
        ]);

        return view('admin.data', compact('yesterdayBackups'));
    }
    public function downloadBackup($filename)
    {
        $backupPath = storage_path('app/backups/' . $filename);

        if (file_exists($backupPath)) {
            return response()->download($backupPath, $filename, [
                'Content-Type' => 'application/sql',
            ]);
        }

        return back()->with('error', 'File backup tidak ditemukan');
    }
    public function exportDatabase()
    {
        // Debug: Periksa koneksi database
        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            return back()->with('error', 'Koneksi database gagal: ' . $e->getMessage());
        }

        $database = env('DB_DATABASE'); // Gunakan dari environment
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $host = env('DB_HOST', '127.0.0.1');

        $filename = 'backup_' . $database . '_' . date('Y-m-d_H-i-s') . '.sql';
        $backupPath = storage_path('app/backups');

        // Buat direktori jika tidak ada
        if (!file_exists($backupPath)) {
            mkdir($backupPath, 0755, true);
        }

        $filepath = $backupPath . '/' . $filename;

        // Metode alternatif dengan PHP
        try {
            // Koneksi database
            $conn = new \mysqli($host, $username, $password, $database);

            if ($conn->connect_error) {
                throw new \Exception("Koneksi gagal: " . $conn->connect_error);
            }

            // Ambil semua tabel
            $tables = [];
            $result = $conn->query("SHOW TABLES");
            while ($row = $result->fetch_array()) {
                $tables[] = $row[0];
            }

            // Mulai backup
            $backup = "-- Database: $database\n";
            $backup .= "-- Backup pada: " . date('Y-m-d H:i:s') . "\n\n";
            $backup .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

            // Backup struktur dan data setiap tabel
            foreach ($tables as $table) {
                $result = $conn->query("SHOW CREATE TABLE $table");
                $row = $result->fetch_array();

                $backup .= "-- Struktur tabel $table\n";
                $backup .= $row[1] . ";\n\n";

                $result = $conn->query("SELECT * FROM $table");

                // Jika ada data
                if ($result->num_rows > 0) {
                    $backup .= "-- Data untuk tabel $table\n";
                    while ($row = $result->fetch_assoc()) {
                        $insertValues = [];
                        foreach ($row as $value) {
                            $insertValues[] = $conn->real_escape_string($value);
                        }

                        $backup .= "INSERT INTO $table VALUES ('"
                            . implode("','", $insertValues) . "');\n";
                    }
                    $backup .= "\n";
                }
            }

            $backup .= "SET FOREIGN_KEY_CHECKS=1;\n";

            // Simpan backup
            if (file_put_contents($filepath, $backup) === false) {
                throw new \Exception("Gagal menulis file backup");
            }

            // Close koneksi
            $conn->close();

            // Download file
            return response()->download($filepath, $filename, [
                'Content-Type' => 'application/sql',
            ])->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            \Log::error('Backup Database Error: ' . $e->getMessage());
            return back()->with('error', 'Gagal membuat backup: ' . $e->getMessage());
        }
    }
    public function importDatabase(Request $request)
{
    try {
        $request->validate([
            'importFile' => 'required|file',
        ]);

        $file = $request->file('importFile');
        $extension = strtolower($file->getClientOriginalExtension());

        if ($extension !== 'sql') {
            return back()->with('error', 'File harus berformat SQL');
        }

        // Buat nama file dengan format yang sama seperti backup
        $database = env('DB_DATABASE');
        $yesterday = now()->yesterday()->format('Y-m-d');
        $time = now()->format('H-i-s');
        $filename = "backup_{$database}_{$yesterday}_{$time}.sql";

        // Simpan file ke folder backup
        $backupPath = storage_path('app/backups');
        if (!file_exists($backupPath)) {
            mkdir($backupPath, 0755, true);
        }

        // Pindahkan file yang diupload ke folder backup
        $file->move($backupPath, $filename);

        return back()->with('success', 'File berhasil diimport ke riwayat backup');

    } catch (\Exception $e) {
        \Log::error('Import File Error: ' . $e->getMessage());
        return back()->with('error', 'Gagal import file: ' . $e->getMessage());
    }
}

public function previewImport(Request $request)
{
    try {
        $request->validate([
            'importFile' => 'required|file',
        ]);

        $file = $request->file('importFile');
        $extension = strtolower($file->getClientOriginalExtension());

        if ($extension !== 'sql') {
            return response()->json(['error' => 'File harus berformat SQL'], 400);
        }

        // Preview sederhana dari file SQL
        $preview = [
            'file' => [
                'exists' => true,
                'count' => 1,
                'status' => 'File akan disimpan di riwayat backup'
            ]
        ];

        return response()->json($preview);

    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 400);
    }
}

}
