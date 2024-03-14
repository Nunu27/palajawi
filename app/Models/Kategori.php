<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use WendellAdriel\Lift\Attributes\DB;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Lift;

// TODO: finish up the rule

#[DB(table: 'kategori', timestamps: false)]
class Kategori extends Model
{
    use Lift;

    #[PrimaryKey(type: 'string', incrementing: false)]
    #[Fillable]
    public string $id;
    #[Fillable]
    public string $nama;
    #[Fillable]
    public string $barang;
}
