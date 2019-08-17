<?php


namespace App;


use Arcanedev\Support\Database\Model;

class UserPoolFund extends Model
{
    protected $table = 'user_pool_funds';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

}