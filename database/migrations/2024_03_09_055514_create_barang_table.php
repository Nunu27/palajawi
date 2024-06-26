<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('cover');
            $table->string('nama');
            $table->bigInteger('id_kategori');
            $table->index('id_kategori');
            $table->foreign('id_kategori')->references('id')->on('kategori')->onDelete('cascade');
            $table->string('deskripsi');
            $table->float('rating');
            $table->integer('jumlah_rating');
            $table->integer('harga');
            $table->integer('stok');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
