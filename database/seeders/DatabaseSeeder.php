<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Kategori;
use App\Models\MetodePembayaran;
use App\Models\StatusTransaksi;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $password = Hash::make('123456');
        User::castAndCreate([
            'username' => 'Admin',
            'email' => 'admin@palajawi.com',
            'password' => $password,
            'admin' => true,
        ]);
        User::factory()->count(100)->create();

        Kategori::castAndCreate([
            'nama' => 'Mentah',
            'gambar' => 'https://sikepoku.kulonprogokab.go.id/assets/image/1704160536_ec562eb5f39e8a7275dd.png'
        ]);
        Kategori::castAndCreate([
            'nama' => 'Cemilan',
            'gambar' => 'https://sikepoku.kulonprogokab.go.id/assets/image/1704160536_ec562eb5f39e8a7275dd.png'
        ]);
        Kategori::castAndCreate([
            'nama' => 'Minuman',
            'gambar' => 'https://sikepoku.kulonprogokab.go.id/assets/image/1704160536_ec562eb5f39e8a7275dd.png'
        ]);

        Transaksi::castAndCreate([
            'id' => uuid_create(),
            'id_user' => 1,
            'total_harga' => 50000,
            'metode_pembayaran' => MetodePembayaran::PRIS,
            'status' => StatusTransaksi::MenungguPembayaran,
        ]);
    }
}
