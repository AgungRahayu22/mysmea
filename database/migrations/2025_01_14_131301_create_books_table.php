<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('katagori_id');
            $table->unsignedBigInteger('penerbit_id');
            $table->string('judul');
            $table->string('penulis');
            $table->foreign('kategori_id')->references('id')->on('buku_kategori');
            $table->foreign('penerbit_id')->references('id')->on('penerbit');
            $table->integer('tahun');
            $table->integer('jumlah');
            $table->string('image_url');
            $table->string('pdf_path')->nullable();
            $table->string('deskripsi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
}
