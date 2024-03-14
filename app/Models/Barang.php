<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Config;
use WendellAdriel\Lift\Attributes\DB;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Attributes\Relations\HasMany;
use WendellAdriel\Lift\Attributes\Relations\HasManyThrough;
use WendellAdriel\Lift\Lift;

// TODO: finish up the rule

#[DB(table: 'barang')]
#[HasMany(KategoriBarang::class)]
#[HasManyThrough(Kategori::class, KategoriBarang::class, 'kategori')]
class Barang extends Model
{
    use Lift;

    #[PrimaryKey]
    public int $id;
    #[Config(fillable: true, rules: ['required', 'string'])]
    public string $cover;
    #[Config(cast: 'array', fillable: true)]
    public array $list_gambar;
    #[Config(fillable: true, rules: ['required', 'string'])]
    public string $nama;
    #[Config(cast: 'array', fillable: true)]
    public array $nama_lain;
    #[Config(fillable: true, rules: ['required', 'string'])]
    public string $deskripsi;
    #[Config(cast: 'float', default: 0.0)]
    public float $rating;
    #[Config(cast: 'int', default: 0.0)]
    public int $jumlah_rating;
    #[Config(cast: 'int', fillable: true, rules: ['required', 'integer'])]
    public int $harga;
    #[Config(cast: 'int', fillable: true, rules: ['required', 'integer'])]
    public int $stok;
    #[Cast('datetime')]
    public Carbon $created_at;
    #[Cast('datetime')]
    public Carbon $updated_at;
}
