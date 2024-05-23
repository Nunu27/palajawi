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
        Schema::create('barang_transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('id_transaksi');
            $table->index('id_transaksi');
            $table->foreign('id_transaksi')->references('id')->on('transaksi')->onDelete('cascade');
            $table->unsignedBigInteger('id_barang');
            $table->index('id_barang');
            $table->foreign('id_barang')->references('id')->on('barang')->onDelete('cascade');
            $table->integer('jumlah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_transaksi');
    }
};
