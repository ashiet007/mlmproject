<?php


namespace App\Http\Controllers\user;

use App\PoolUser;
use App\Http\Controllers\Controller;

class PoolController extends Controller
{
    public function viewPool()
    {
        $pooledUsers = PoolUser::with('user')->get();
        return view('user.pool.view',compact('pooledUsers'));
    }
}