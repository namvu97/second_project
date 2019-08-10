<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    public $timestamps = false;
    protected $table = 'transaction';
    protected $primaryKey = 'id';
    protected $fillable = array(
        "id",
        "amount",
        "time",
        "from_wallet",
        "to_wallet",
        "category_id",
        "user_id",
    );

    public function category()
    {
        return $this->belongsTo('App\Category', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id');
    }
}
