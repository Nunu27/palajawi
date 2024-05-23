<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WendellAdriel\Lift\Attributes\Config;
use WendellAdriel\Lift\Attributes\DB;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Attributes\Relations\HasOne;
use WendellAdriel\Lift\Lift;

#[DB(table: 'barang_transaksi', timestamps: false)]
#[HasOne(Barang::class, 'barang', 'id', 'id_barang')]
class BarangTransaksi extends Model
{
    use Lift;


    #[PrimaryKey]
    public int $id;
    #[Config(fillable: true, rules: ['required', 'string'])]
    public string $id_transaksi;
    #[Config(fillable: true, rules: ['required', 'integer'])]
    public int $id_barang;
    #[Config(fillable: true, rules: ['required', 'integer'])]
    public int $jumlah;
}
