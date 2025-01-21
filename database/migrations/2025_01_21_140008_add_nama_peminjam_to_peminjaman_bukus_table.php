<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('peminjaman_bukus', function (Blueprint $table) {
        $table->string('nama_peminjam')->nullable(); // Menambahkan kolom nama_peminjam
    });
}

public function down()
{
    Schema::table('peminjaman_bukus', function (Blueprint $table) {
        $table->dropColumn('nama_peminjam');
    });
}

};
