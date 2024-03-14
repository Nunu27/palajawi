<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WendellAdriel\Lift\Attributes\Config;
use WendellAdriel\Lift\Attributes\DB;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Lift;

#[DB(table: 'keranjang', timestamps: false)]
class Keranjang extends Model
{
    use Lift;

    #[Config(cast: 'int', fillable: true, rules: ['required', 'int'])]
    #[PrimaryKey(incrementing: false)]
    public int $id_user;
    #[Config(cast: 'int', fillable: true, rules: ['required', 'int'])]
    #[PrimaryKey(incrementing: false)]
    public int $id_barang;
    #[Config(cast: 'int', fillable: true, rules: ['required', 'int', 'min:1'])]
    public int $jumlah;
}
