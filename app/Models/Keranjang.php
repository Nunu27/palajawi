<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WendellAdriel\Lift\Attributes\Config;
use WendellAdriel\Lift\Attributes\DB;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Attributes\Relations\HasOne;
use WendellAdriel\Lift\Lift;

#[DB(table: 'keranjang', timestamps: false)]
#[HasOne(Barang::class, 'barang', 'id', 'id_barang')]
class Keranjang extends Model
{
    use Lift;

    #[PrimaryKey]
    public int $id;
    #[Config(cast: 'int', fillable: true, rules: ['required', 'int'])]
    public int $id_user;
    #[Config(cast: 'int', fillable: true, rules: ['required', 'int'])]
    public int $id_barang;
    #[Config(cast: 'int', fillable: true, rules: ['required', 'int', 'min:1'])]
    public int $jumlah;
}
