<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WendellAdriel\Lift\Attributes\DB;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Lift;

#[DB(table: 'keranjang', timestamps: false)]
class Keranjang extends Model
{
    use Lift;

    #[Fillable]
    #[PrimaryKey(incrementing: false)]
    public int $id_user;
    #[Fillable]
    #[PrimaryKey(incrementing: false)]
    public int $id_barang;
    #[Fillable]
    public int $jumlah;
}
