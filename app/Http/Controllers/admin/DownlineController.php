<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\UserDetail;
use App\GiveHelp;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
class DownlineController extends Controller
{

    public function totalDownline(Request $request)
    {
        $requestData = $request->get('user_name');
        $username = User::pluck('user_name','user_name')->toArray();
        $teamDetails = null;
        if(!empty($requestData))
        {
            $teamDetails = getTotalTeam($requestData);
            return view('admin.downline.total',compact('teamDetails','username'));
        }
        else{
            return view('admin.downline.total',compact('teamDetails','username'));
        }
    }
    public function directTeam(Request $request)
    {
        $requestData = $request->get('user_name');
        $username = User::pluck('user_name','user_name')->toArray();
        $teamDetails = null;
        if(!empty($requestData))
        {
            $teamDetails = User::with('UserDetails')
                         ->where('sponsor_id', '=', $requestData)  
                         ->get();
            return view('admin.downline.direct',compact('teamDetails','username'));
        }
        else{
            return view('admin.downline.direct',compact('teamDetails','username'));
        }     
        
    }
    
    public function rejectedMembers(Request $request)
    {
        $requestData = $request->get('user_name');
        $username = User::pluck('user_name','user_name')->toArray();
        if(!empty($requestData))
        {
            $users = User::with('UserDetails')
                     ->where('user_name', '=', $requestData)
                     ->rejected()
                     ->orderBy('updated_at','DESC')  
                     ->get();
            return view('admin.downline.rejected',compact('users','username'));
        }     
        else
        {
            $users = User::with('UserDetails')
                     ->rejected()
                     ->orderBy('updated_at','DESC')  
                     ->get();
            return view('admin.downline.rejected',compact('users','username'));
        }
      }

    public function blockedMembers(Request $request)
    {
        $requestData = $request->get('user_name');
        $username = User::pluck('user_name','user_name')->toArray();
        if(!empty($requestData))
        {
            $users = User::with('UserDetails')
                     ->where('user_name', '=', $requestData)
                     ->blocked()
                     ->orderBy('updated_at','DESC')  
                     ->get();
            return view('admin.downline.blocked',compact('users','username'));
        }     
        else
        {
            $users = User::with('UserDetails')
                     ->blocked()
                     ->orderBy('updated_at','DESC')  
                     ->get();
            return view('admin.downline.blocked',compact('users','username'));
        }
    }

    public function neglectedMembers()
    {
        $rejectedUsers = User::real()->rejected()->get();
        $neglectedUsers = [];
        foreach($rejectedUsers as $user)
        {
            $detail = UserDetail::where('user_id',$user->id)
                        ->select('mob_no','account_no')
                        ->first();
            $data = UserDetail::with('user')
                    ->where(function ($query) use ($detail) {
                        $query->where('mob_no', '=', $detail->mob_no)
                            ->orWhere('account_no', '=', $detail->account_no);
                    })
                    ->where('user_id','!=',$user->id)
                    ->get()
                    ->toArray();
            $neglectedUsers = array_merge($neglectedUsers,$data);
        }
        return view('admin.downline.neglected',compact('neglectedUsers'));
    }
}