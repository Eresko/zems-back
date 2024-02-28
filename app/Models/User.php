<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends  Authenticatable
{
    use HasApiTokens;
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

}