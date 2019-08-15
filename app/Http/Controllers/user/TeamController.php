<?php


namespace App\Http\Controllers\user;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
    public function registeredList()
    {
        $username = Auth::User()->user_name;
        $user = new User;
        $registerUsers = $user->getRegisteredUser($username);
        return view('user.team.register',compact('registerUsers'));
    }

    public function activeList()
    {
        $username = Auth::User()->user_name;
        $user = new User;
        $activeUsers = $user->getActiveUser($username);
        return view('user.team.active',compact('activeUsers'));
    }
    public function directList()
    {
        $username = Auth::User()->user_name;

        $team = User::with('userDetails')->where('sponsor_id',$username)->get();
        return view('user.team.directTeam', compact('team'));
    }

    public function rejectedList()
    {
        $username = Auth::User()->user_name;
        $rejectedList = User::with('userDetails')->where('sponsor_id',$username)
            ->rejected()->get();
        return view('user.team.rejected',compact('rejectedList'));
    }
}