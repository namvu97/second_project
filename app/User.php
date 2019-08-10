<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    public $timestamps = false;
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $fillable = array(
        "id",
        "username",
        "password",
        "email",
        "full_name",
        "photo",
        "token",
        "verified",
        "change_password_at",
    );

    public function wallet()
    {
        return $this->hasMany('App\Wallet', 'id');
    }

    public function category()
    {
        return $this->hasMany('App\Category', 'id');
    }

    public function transaction()
    {
        return $this->hasMany('App\Transaction', 'id');
    }
}
