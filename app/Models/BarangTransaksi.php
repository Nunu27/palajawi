<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WendellAdriel\Lift\Attributes\Config;
use WendellAdriel\Lift\Attributes\DB;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Lift;

#[DB(table: 'barang_transaksi', timestamps: false)]
class BarangTransaksi extends Model
{
    use Lift;

    #[Config(fillable: true, rules: ['required', 'string'])]
    #[PrimaryKey(type: 'string', incrementing: false)]
    public string $id_transaksi;
    #[Config(fillable: true, rules: ['required', 'integer'])]
    #[PrimaryKey(incrementing: false)]
    public int $id_barang;
    #[Config(fillable: true, rules: ['required', 'integer'])]
    public int $jumlah;
}
