<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class PoolUser extends Model
{
    protected $table = 'pool_users';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}