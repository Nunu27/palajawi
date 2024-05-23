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
        DB::statement('
        CREATE OR REPLACE FUNCTION update_stock_and_total_price_on_insert_transaction_product()
        RETURNS TRIGGER AS $$
        DECLARE total_price INT DEFAULT 0;
        BEGIN

        -- Calculate total price for the transaction
        SELECT SUM(b.harga * bt.jumlah) INTO total_price
        FROM barang b
        INNER JOIN barang_transaksi bt ON bt.id_barang = b.id
        WHERE bt.id_transaksi = NEW.id_transaksi;

        -- Update transaction total price
        UPDATE transaksi
        SET total_harga = total_price
        WHERE id = NEW.id_transaksi;

        -- Update stock for the inserted product
        UPDATE barang
        SET stok = stok - NEW.jumlah
        WHERE id = NEW.id_barang;

        RETURN NEW;
        END;
        $$ LANGUAGE plpgsql;
    ');

        DB::statement('
        CREATE TRIGGER update_stock_and_total_price_on_insert_transaction_product_trigger
        AFTER INSERT OR UPDATE OR DELETE ON barang_transaksi
        FOR EACH ROW
        EXECUTE FUNCTION update_stock_and_total_price_on_insert_transaction_product();
    ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
