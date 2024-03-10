<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WendellAdriel\Lift\Attributes\DB;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Attributes\Relations\BelongsTo;
use WendellAdriel\Lift\Lift;


#[DB(table: 'kategori_barang', timestamps: false)]
#[BelongsTo(Kategori::class, 'kategori', 'id_kategori', 'id')]
#[BelongsTo(Barang::class, 'barang', 'id_barang', 'id')]
class KategoriBarang extends Model
{
    use Lift;

    #[PrimaryKey(type: 'string', incrementing: false)]
    #[Fillable]
    public string $id_kategori;
    #[PrimaryKey(incrementing: false)]
    #[Fillable]
    public int $id_barang;
}
