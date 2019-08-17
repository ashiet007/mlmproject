<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Epin extends Model
{
    protected $table = 'user_epins';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function scopeUnused()
    {
        return $this->where('status','unused');
    }

    public function scopeUsed()
    {
        return $this->where('status','used');
    }

    public function getUnusedEpin($id)
    {
        return $this->unused()
            ->where('user_id',$id)
            ->get();
    }

    public function getEpinReport($id)
    {
        return $this->used()
            ->where('user_id',$id)
            ->get();
    }

    public function getPinWalletUsedFund($id)
    {
        return $this->where('transaction_type','generate')
            ->where('user_id',$id)
            ->sum('amount');
    }
}