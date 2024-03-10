<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use WendellAdriel\Lift\Attributes\Config;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Lift;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, Lift;

    #[PrimaryKey]
    public int $id;
    #[Fillable]
    public string $foto_profil;
    #[Fillable]
    public string $username;
    #[Fillable]
    public string $email;
    #[Config(hidden: true, fillable: true, cast: 'hashed')]
    public string $password;
    #[Fillable]
    public string $alamat;
    #[Fillable]
    public bool $admin;
}
