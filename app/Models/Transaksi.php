<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WendellAdriel\Lift\Attributes\DB;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Lift;

enum MetodePembayaran
{
    case COD;
    case PRIS;
}
enum StatusTransaksi
{
    case MenungguPembayaran;
    case Diproses;
    case Selesai;
    case Gagal;
    case Dibatalkan;
}

#[DB(table: 'transaksi')]
class Transaksi extends Model
{
    use Lift;

    #[Fillable]
    #[PrimaryKey(type: 'string', incrementing: false)]
    public string $id;
    #[Fillable]
    public int $id_user;
    #[Fillable]
    public int $total_harga;
    #[Fillable]
    public MetodePembayaran $metode_pembayaran;
    #[Fillable]
    public StatusTransaksi $status;
}
