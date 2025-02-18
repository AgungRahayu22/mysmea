<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class PetugasBukuController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit_id' => 'required|exists:penerbit,id',
            'kategori_id' => 'required|exists:buku_kategori,id',
            'tahun' => 'required|integer',
            'jumlah' => 'required|integer',
            'image_url' => 'required|url',
            'pdf_file' => 'required|mimes:pdf|max:10240',
            'deskripsi' => 'nullable|string',
        ]);

        // Simpan file PDF
        $pdfPath = $request->file('pdf_file')->store('pdfs', 'public');

        Book::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit_id' => $request->penerbit_id,
            'kategori_id' => $request->kategori_id,
            'tahun' => $request->tahun,
            'jumlah' => $request->jumlah,
            'image_url' => $request->image_url,
            'pdf_path' => $pdfPath,
            'deskripsi' => $request->deskripsi,
        ]);



        return redirect()->back()->with('success', 'Buku berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit_id' => 'required|exists:penerbit,id',
            'kategori_id' => 'required|exists:buku_kategori,id',
            'tahun' => 'required|integer',
            'jumlah' => 'required|integer',
            'image_url' => 'required|url',
            'pdf_file' => 'nullable|mimes:pdf|max:10240',
            'deskripsi' => 'nullable|string',
        ]);

        $book = Book::findOrFail($id);
        $updateData = [
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit_id' => $request->penerbit_id,
            'kategori_id' => $request->kategori_id,
            'tahun' => $request->tahun,
            'jumlah' => $request->jumlah,
            'image_url' => $request->image_url,
            'deskripsi' => $request->deskripsi,
        ];

        // Jika ada file PDF baru diunggah
        if ($request->hasFile('pdf_file')) {
            // Hapus file PDF lama jika ada
            if ($book->pdf_path) {
                Storage::disk('public')->delete($book->pdf_path);
            }

            // Simpan file PDF baru
            $updateData['pdf_path'] = $request->file('pdf_file')->store('pdfs', 'public');
        }

        $book->update($updateData);

        return redirect()->back()->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        // Hapus file PDF jika ada
        if ($book->pdf_path) {
            Storage::disk('public')->delete($book->pdf_path);
        }

        $book->delete();

        return redirect()->back()->with('success', 'Buku berhasil dihapus!');
    }
}
