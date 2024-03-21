<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Config;
use WendellAdriel\Lift\Attributes\DB;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Attributes\Relations\HasOne;
use WendellAdriel\Lift\Lift;

// TODO: finish up the rule

#[DB(table: 'barang')]
#[HasOne(KategoriBarang::class, 'id_kategori')]
class Barang extends Model
{
    use Lift;

    #[PrimaryKey]
    public int $id;
    #[Config(fillable: true, rules: ['required', 'string'])]
    public string $cover;
    #[Config(fillable: true, rules: ['required', 'string', 'max:255'])]
    public string $nama;
    #[Config(fillable: true, rules: ['required', 'int'])]
    public int $id_kategori;
    #[Config(fillable: true, rules: ['required', 'string', 'max:4095'])]
    public string $deskripsi;
    #[Config(cast: 'float', default: 0.0)]
    public float $rating;
    #[Config(cast: 'int', default: 0)]
    public int $jumlah_rating;
    #[Config(cast: 'int', fillable: true, rules: ['required', 'integer', 'min:1'])]
    public int $harga;
    #[Config(cast: 'int', fillable: true, rules: ['required', 'integer', 'min:1'])]
    public int $stok;
    #[Cast('datetime')]
    public Carbon $created_at;
    #[Cast('datetime')]
    public Carbon $updated_at;
}
