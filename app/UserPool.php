<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class UserPool extends Model
{
    protected $table = 'user_pools';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function getUserPool($id)
    {
        return $this->where('status','pending')
            ->where('user_id',$id)
            ->get();
    }
}