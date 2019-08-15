<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class UserEpin extends Model
{
    protected $table = 'user_pins';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}