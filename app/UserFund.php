<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class UserFund extends Model
{
    protected $table = 'user_funds';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function getPinWalletTransferredFund($id)
    {
        return $this->where('to_wallet','pin-wallet')
            ->where('type','debit')
            ->where('user_id',$id)
            ->sum('amount');
    }
}