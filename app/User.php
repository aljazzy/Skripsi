<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected $fillable = [
        'id_user','username', 'email','password','handphone','role','avatar','api_token'
    ];

    protected $hidden = [
        'password','api_token',
    ];

    public function units(){
        return $this->hasMany(Unit::class);
    }
    public function pesanans(){
        return $this->hasMany(Pesanan::class);
    }
}
