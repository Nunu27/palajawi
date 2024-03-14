<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Config;
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
    public int $total_harga;
    #[Config(fillable: true, cast: MetodePembayaran::class)]
    public MetodePembayaran $metode_pembayaran;
    #[Config(cast: StatusTransaksi::class, default: StatusTransaksi::MenungguPembayaran)]
    public StatusTransaksi $status;
    #[Cast('datetime')]
    public Carbon $created_at;
    #[Cast('datetime')]
    public Carbon $updated_at;
}
