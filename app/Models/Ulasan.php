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

// TODO: finish up the rule

#[DB(table: 'ulasan')]
class Ulasan extends Model
{
    use Lift;

    #[PrimaryKey(incrementing: false)]
    #[Fillable]
    public int $id_user;
    #[PrimaryKey(incrementing: false)]
    #[Fillable]
    public int $id_barang;
    #[Fillable]
    public float $rating;
    #[Config(fillable: true, cast: 'array')]
    public array $lampiran;
    #[Fillable]
    public string $deskripsi;
    #[Cast('datetime')]
    public Carbon $created_at;
    #[Cast('datetime')]
    public Carbon $updated_at;
}
