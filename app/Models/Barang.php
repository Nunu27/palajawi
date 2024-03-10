<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WendellAdriel\Lift\Attributes\Config;
use WendellAdriel\Lift\Attributes\DB;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Attributes\Relations\HasMany;
use WendellAdriel\Lift\Attributes\Relations\HasManyThrough;
use WendellAdriel\Lift\Lift;

#[DB(table: 'barang')]
#[HasMany(KategoriBarang::class)]
#[HasManyThrough(Kategori::class, KategoriBarang::class, 'kategori')]
class Barang extends Model
{
    use Lift;

    #[PrimaryKey]
    public int $id;
    #[Fillable]
    public string $cover;
    #[Config(cast: 'array', fillable: true)]
    public array $list_gambar;
    #[Fillable]
    public string $nama;
    #[Config(cast: 'array', fillable: true)]
    public array $nama_lain;
    #[Fillable]
    public string $deskripsi;
    public float $rating;
    public int $jumlah_rating;
    #[Fillable]
    public int $harga;
    #[Fillable]
    public int $stok;
    #[Fillable]
    public string $satuan;
}
