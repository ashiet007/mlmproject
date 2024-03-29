<?php


namespace App\Http\Controllers\admin;


use App\GiveHelp;
use App\Http\Controllers\Controller;
use App\PoolUser;
use App\UserPool;
use App\UserPoolFund;
use Illuminate\Http\Request;

class PoolController extends Controller
{
    /**
     * The authenticated user ID.
     *
     * @var int
     */
    protected $userId;

    public function __construct()
    {
        $this->middleware(function (Request $request, $next) {
            if (!\Auth::check()) {
                return redirect('/login');
            }
            $this->userId = \Auth::id(); // you can access user id here

            return $next($request);
        });
    }
    public function viewPool()
    {
        $pooledUsers = PoolUser::with('user')->get();
        return view('admin.pool.view',compact('pooledUsers'));
    }

    public function viewList()
    {
        $pooledUsers = PoolUser::with('user.userDetails')->get();
        return view('admin.pool.list',compact('pooledUsers'));
    }

    public function pendingPoolReport()
    {
        $userData = GiveHelp::with('user.userDetails')
                            ->where('type','pool')
                            ->where('status','pending')
                            ->get();
        return view('admin.pool.pending',compact('userData'));
    }

    public function poolActionReport()
    {
        $data = UserPool::with('user.userDetails')
                        ->get();
        return view('admin.pool.action',compact('data'));
    }

    public function pooledOutUsers()
    {
        $pooledOutUsers = UserPoolFund::with('user.userDetails')->get();
        return view('admin.pool.pooledout',compact('pooledOutUsers'));
    }
}