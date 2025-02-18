<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('penerbit', function (Blueprint $table) {
            $table->id();
            $table->string('nama_penerbit', 255);
            $table->string('alamat', 255);
            $table->bigInteger('kontak');
            $table->timestamps(); // Menambahkan created_at & updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('penerbit');
    }
};
