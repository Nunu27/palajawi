<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WendellAdriel\Lift\Attributes\DB;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Lift;

#[DB(table: 'barang_transaksi', timestamps: false)]
class BarangTransaksi extends Model
{
    use Lift;

    #[Fillable]
    #[PrimaryKey(type: 'string', incrementing: false)]
    public string $id_transaksi;
    #[Fillable]
    #[PrimaryKey(incrementing: false)]
    public int $id_barang;
    #[Fillable]
    public int $jumlah;
}
