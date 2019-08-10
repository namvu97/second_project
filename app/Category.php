<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    public $timestamps = false;
    protected $table = 'category';
    protected $primaryKey = 'id';
    protected $fillable = array(
        "id",
        "category_name",
        "category_type",
        "user_id",
    );

    public function user()
    {
        return $this->belongsTo('App\User', 'id');
    }

    public function transaction()
    {
        return $this->hasMany('App\Transaction', 'id');
    }

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

}
