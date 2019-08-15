<?php


namespace App\Http\Middleware;

use Closure;
use App\UserSetting;
use Illuminate\Support\Facades\Auth;

class CheckAccountStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userId = Auth::User()->id;
        $userSetting = UserSetting::where('user_id',$userId)->first();
        if($userSetting)
        {
            if($userSetting->account_status == 'inactive')
            {
                return redirect()->route('user.activateAccount');
            }
        }
        return $next($request);
    }
}