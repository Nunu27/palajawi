<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use WendellAdriel\Lift\Attributes\Cast;
use WendellAdriel\Lift\Attributes\Config;
use WendellAdriel\Lift\Attributes\Fillable;
use WendellAdriel\Lift\Attributes\PrimaryKey;
use WendellAdriel\Lift\Lift;

// TODO: finish up the rule

class User extends Authenticatable
{
    use HasApiTokens, Lift;

    #[PrimaryKey]
    public int $id;
    #[Fillable]
    public ?string $foto_profil;
    #[Config(fillable: true, rules: ['required', 'string', 'min:5', 'max:255'])]
    public string $username;
    #[Config(fillable: true, rules: ['required', 'string', 'email', 'max:255'])]
    public string $email;
    #[Config(hidden: true, fillable: true, cast: 'hashed', rules: ['required'])]
    public string $password;
    #[Fillable]
    public ?string $alamat;
    #[Config(fillable: true, cast: 'boolean', default: false, rules: ['boolean'])]
    public bool $admin;
    #[Config(hidden: true, fillable: true)]
    public ?string $remember_token;
    #[Cast('datetime')]
    public Carbon $created_at;
    #[Cast('datetime')]
    public Carbon $updated_at;
}
