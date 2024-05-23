<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Config;
use WendellAdriel\Lift\Attributes\DB;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Attributes\Relations\HasMany;
use WendellAdriel\Lift\Attributes\Relations\HasOne;
use WendellAdriel\Lift\Lift;

enum MetodePembayaran: string
{
    case COD = 'COD';
    case PRIS = 'PRIS';
}
enum StatusTransaksi: string
{
    case WAITING = 'Menunggu Pembayaran';
    case PROCESSING = 'Diproses';
    case DONE = 'Selesai';
    case FAIL = 'Gagal';
    case CANCELLED = 'Dibatalkan';
}

#[DB(table: 'transaksi')]
#[HasOne(User::class, 'user', 'id', 'id_user')]
#[HasMany(BarangTransaksi::class, 'daftar_barang', 'id_transaksi', 'id')]
class Transaksi extends Model
{
    use Lift;

    #[Fillable]
    #[PrimaryKey(type: 'string', incrementing: false)]
    public string $id;
    #[Fillable]
    public int $id_user;
    #[Config(default: 0)]
    public int $total_harga;
    #[Config(fillable: true, cast: MetodePembayaran::class)]
    public MetodePembayaran $metode_pembayaran;
    #[Config(cast: StatusTransaksi::class, default: StatusTransaksi::WAITING)]
    public StatusTransaksi $status;
    #[Cast('datetime')]
    public Carbon $created_at;
    #[Cast('datetime')]
    public Carbon $updated_at;
}
