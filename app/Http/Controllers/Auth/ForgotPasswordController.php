<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\UserDetail;
use App\UserPassword;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\ForgetPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateNumber($request);

        $requestData = $request->all();
        if(!empty($requestData))
        {
            $username = $requestData['user_name'];
            $user = User::where('user_name',$username)->first();
            if($user)
            {
                $id = $user->id;
                $userPassword = UserPassword::where('user_id',$id)->first();
                $userDetails = UserDetail::where('user_id',$id)->first();
                if($userDetails && $user)
                {
                    // $password = $userPassword->password;
                    // $number = $userDetails->mob_no;
                    // $message = 'MOST WELCOME AGAIN HERE YOUR LOGIN  ID- '.$username.' AND PASSWORD IS-'.$password.' , WWW.MUDRASHAKTI.COM  THANK YOU.';
                    // sendMessage($number,$message);
                    Mail::to($user->email)->send(new ForgetPasswordMail($user));
                    return redirect()->back()->with('status','DEAR MUDRASHAKTI PARTNER YOUR LOGIN ID AND PASSWORD HAS BEEN SENT ON YOUR REGISTERED EMAIL,PLEASE CHECK YOUR EMAIL FOR LOGIN THANK YOU.');
                }
                else
                {
                    alert()->error('Something went wrong', 'Error')->persistent("Close");
                    return redirect()->back();
                }
            }
            else
            {
                alert()->error('Username is invalid!!!', 'Error')->persistent("Close");
                return redirect()->back();
            }
        }
        else
        {
            alert()->error('Please provide valid username!!!', 'Error')->persistent("Close");
            return redirect()->back();
        }

    }

    protected function validateNumber(Request $request)
    {
        $this->validate($request, ['user_name' => 'required|exists:users,user_name']);
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
}
