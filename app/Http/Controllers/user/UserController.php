<?php

namespace App\Http\Controllers\User;
use App\CompanyPool;
use App\PoolUser;
use App\User;
use App\GiveHelp;
use App\GetHelp;
use App\Message;
use App\News;
use App\UserFund;
use App\UserPoolFund;
use App\UserPreStatus;
use App\Epin;
use App\UserSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;

class UserController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $id = Auth::User()->id;
        $userDetail = User::with('userDetails','singleLineIncome')->findOrFail($id);

        $giveHelp = new GiveHelp;
        $assignedGiveHelps = $giveHelp->getAssignedHelps($id);
        $getHelp = new GetHelp;
        $assignedGetHelps = $getHelp->getAssignedHelps($id);

        $isUnmatchedGetHelpHelping = $getHelp->isUnmatchedGetHelpHelping($id);
        $news = News::horizontal()->first();
        $userSetting = UserSetting::where('user_id',$id)->first();
        return view('user.dashboard',compact('userDetail','assignedGiveHelps','assignedGetHelps','news','isUnmatchedGetHelpHelping','userSetting'));
    }

    public function rejectHelp(Request $request)
    {
        $requestData = $request->all();
        $helpId = $requestData['give_help_id'];
        $id = $requestData['get_help_id'];
        $amt = $requestData['amount'];
        $senderId = $requestData['sender_id'];
        DB::beginTransaction(); // <-- first line
        $saved = true;
        try
        {
            $getHelp = GetHelp::with(['giveHelps' => function($query) use($helpId)
                    {
                        $query->where('give_get_helps.give_help_id', '=', $helpId)
                            ->where('give_get_helps.status', '=', 'pending');
                    }
                ])
                ->findOrFail($id);
            $balance = $getHelp->balance + $amt;
            if($getHelp->amount == $balance)
            {
                $getHelp->update([
                    'completion_state' => 'none',
                    'balance' => $balance,
                ]);
            }
            else
            {
                $getHelp->update([
                    'completion_state' => 'partially-assigned',
                    'balance' => $balance,
                ]);
            }
            $getHelp->giveHelps()->updateExistingPivot($helpId, ['status' => 'rejected']);
            $giveHelp = GiveHelp::findOrFail($helpId);
            $userId = $giveHelp->user_id;
            $giveHelp->update([
                'status' => 'rejected',
            ]);
            $user = User::findOrFail($userId);
            if($user->status != 'blocked')
            {
                $userPreStatus = UserPreStatus::where('user_id',$userId)->first();
                if($userPreStatus)
                {
                    $userPreStatus->update([
                        'status' => $user->status
                    ]);
                }
                else
                {
                    $userPreStatus = UserPreStatus::create([
                        'user_id' => $userId,
                        'status' => $user->status
                    ]);
                }
                if($userPreStatus)
                {
                    $saved = true;
                }
                else
                {
                    $saved = false;
                }
                $user->update([
                    'status' => 'rejected',
                ]);
            }
            $name = Auth()->User()->name;
            $user_name = Auth()->User()->user_name;
            $sender = User::with('userDetails')->findOrFail($senderId);
            $number = $sender->userDetails->mob_no;
            $message = 'DEAR MODINAAMA ID- '.$sender->user_name.' ,HAS BEEN REJECTED BY ID- '.$user_name.','.$name.', WWW.MODINAAMA.IN THANK YOU.';
            if($saved)
            {
                if($getHelp && $giveHelp && $user)
                {
                    $saved = true;
                }
                else
                {
                    $saved = false;
                }
            }
        }
        catch (\Throwable $e)
        {
            alert()->error($e->getMessage(), 'Error')->persistent("Close");
            return redirect()->back();
        }
        if($saved)
        {
            sendMessage($number, $message);
            DB::commit(); // YES --> finalize it
            alert()->success('Help Rejected!!!', 'Success')->persistent("Close");
            return redirect()->back();
        }
        else
        {
            DB::rollBack(); // NO --> some error has occurred undo the whole thing
            alert()->error('Something went wrong', 'Error')->persistent("Close");
            return redirect()->back()->withInput();
        }
    }
    public function acceptHelp(Request $request)
    {
        $requestData = $request->all();
        $id = $requestData['get_help_id'];
        $helpId = $requestData['give_help_id'];
        $senderId = $requestData['sender_id'];
        $getHelp = GetHelp::with(['giveHelps' => function($query) use($helpId)
                                {
                                    $query->where('give_get_helps.give_help_id', '=', $helpId)
                                        ->where('give_get_helps.status', '=', 'pending');
                                }
                            ])
                            ->findOrFail($id);
        DB::beginTransaction(); // <-- first line
        $saved = true;
        try
        {
            $getHelp->giveHelps()->updateExistingPivot($helpId, ['status' => 'accepted']);

            $getHelpUpdated = GetHelp::with(['giveHelps' => function($query)
                    {
                        $query->where('give_get_helps.status', '=', 'pending');
                    }
                ])
                ->find($id);

            /************* Update Get Help Status **********/
            if($getHelpUpdated->completion_state == 'assigned')
            {
                if($getHelpUpdated->giveHelps->isEmpty())
                {
                    $getHelpUpdated->update([
                        'status' => 'accepted',
                    ]);
                }
            }
            /************* Update Get Help Status **********/
            $getHelpUserId = $getHelpUpdated->user_id;

            /*************** Update User Get Help Helping Fund ***********/
            if($getHelpUpdated->type == 'helping')
            {
                $getHelpUserSetting = UserSetting::where('user_id',$getHelpUserId)->first();
                $helpingFund = $getHelpUserSetting->helping_fund;
                $updatedHelpingFund = $helpingFund + $getHelpUpdated->amount;
                $getHelpUserSetting->update([
                    'helping_fund' => $updatedHelpingFund
                ]);
            }
            /*************** Update User Get Help Helping Fund ***********/

            $giveHelp = GiveHelp::with(['getHelps' => function($query)
                    {
                        $query->where('give_get_helps.status', '=', 'pending');
                    }
                ])
                ->findOrFail($helpId);

            if($giveHelp->completion_state == 'assigned' && $giveHelp->status != 'rejected')
            {
                if($giveHelp->getHelps->isEmpty())
                {
                    /************ Update Give Help Status *************/
                    $giveHelp->update([
                        'status' => 'accepted',
                    ]);
                    /************ Update Give Help Status *************/

                    if($giveHelp->type == 'pool')
                    {
                        $errorStatus = $this->addUserToPool($giveHelp->user_id);
                        if($errorStatus)
                        {
                            $saved = false;
                        }
                        else
                        {
                            $saved = true;
                        }

                    }
                    else
                    {
                        $userId = $giveHelp->user_id;
                        $user = User::findOrFail($userId);
                        $currentUserStatus = $user->status;

                        /************ Update Total Give Help Income ***********/
                        $userSetting = UserSetting::where('user_id',$userId)->first();
                        $giveHelpIncome = $userSetting->give_help_income;
                        $updatedGiveHelpIncome = $giveHelpIncome + $giveHelp->amount;
                        $userSetting->update([
                            'give_help_income' => $updatedGiveHelpIncome
                        ]);
                        /************ Update Total Give Help Income ***********/

                        /************ Add Single Line Income ************/
                        if($currentUserStatus == 'pending')
                        {
                            addSingleLineIncome($userSetting->give_help_amount);
                        }
                        /************ Add Single Line Income ************/

                        /************ Update User Status ****************/
                        if($user->status != 'blocked' && $user->status != 'rejected')
                        {
                            $user->update([
                                'status' => 'active',
                            ]);
                        }
                        /************ Update User Status ****************/

                        /************ Start User Single Line Income ***********/
                        CompanyPool::where('user_id',$user->id)
                            ->update([
                                'status' => 'start'
                            ]);
                        /************ Start User Single Line Income ***********/
                        if($user && $giveHelp)
                        {
                            $saved = true;
                        }
                        else
                        {
                            $saved = false;
                        }
                    }
                }

            }

            $name = Auth()->User()->name;
            $user_name = Auth()->User()->user_name;
            $sender = User::with('userDetails')->findOrFail($senderId);
            $number = $sender->userDetails->mob_no;
            $message = 'DEAR MODINAAMA ID- '.$sender->user_name.' ,HAS BEEN ACCEPTED BY ID-'.$user_name.','.$name.', HAVE A GOOD DAY, WWW.MODINAAMA.IN THANK YOU.';
            if($saved)
            {
                if($getHelp && $getHelpUpdated && $giveHelp)
                {
                    $saved = true;
                }
                else
                {
                    $saved = false;
                }
            }
        }
        catch (\Throwable $e)
        {
            alert()->error($e->getMessage(), 'Error')->persistent("Close");
            return redirect()->back();
        }
        if($saved)
        {
            sendMessage($number, $message);
            DB::commit(); // YES --> finalize it
            alert()->success('Help Accepted!!!', 'Success')->persistent("Close");
            return redirect()->back();
        }
        else
        {
            DB::rollBack(); // NO --> some error has occurred undo the whole thing
            alert()->error('Something went wrong', 'Error')->persistent("Close");
            return redirect()->back()->withInput();
        }

    }

    public function addUserToPool($userId)
    {
        $pooledUser = PoolUser::get();
        $count = count($pooledUser);
        DB::beginTransaction(); // <-- first line
        $saved = true;
        try
        {
            if($count < 20)
            {
                $poolUser = PoolUser::create([
                    'user_id' => $userId
                ]);
                if($poolUser)
                {
                    $saved = true;
                }
                else
                {
                    $saved = false;
                }
            }
            else
            {
                $firstPoolUser = PoolUser::first();
                $userPoolFUnd = UserPoolFund::create([
                    'user_id' => $firstPoolUser->id,
                    'amount' => 10000
                ]);
                $firstPoolUser->delete();
                $poolUser = PoolUser::create([
                    'user_id' => $userId
                ]);
                if($poolUser && $userPoolFUnd && $firstPoolUser)
                {
                    $saved = true;
                }
                else
                {
                    $saved = false;
                }
            }
        }
        catch (\Throwable $e)
        {
            return $error = true;
        }
        if($saved)
        {
            DB::commit(); // YES --> finalize it
            return $error = false;
        }
        else
        {
            DB::rollBack(); // NO --> some error has occurred undo the whole thing
            return $error = true;
        }
    }

    public function message(Request $request)
    {
        $requestData = $request->all();
        $sender_id = Auth::User()->id;
        Message::create([
            'sender_id' => $sender_id,
            'receiver_id' => $requestData['receiver_id'],
            'message' => $requestData['message'],
            'status' => 'unread'
        ]);
        alert()->success('Message Sent!!!', 'Success')->persistent("Close");
        return redirect()->route('user.index');
    }

    public function extendTimer(Request $request)
    {
        $requestData = $request->all();
        $id = $requestData['get_help_id'];
        $helpId = $requestData['give_help_id'];
        $getHelp = GetHelp::with(['giveHelps' => function($query) use($helpId)
        {
            $query->where('give_get_helps.give_help_id', '=', $helpId);
        }
        ])
            ->findOrFail($id);
        $getHelp->giveHelps()->updateExistingPivot($helpId, ['extend_timer_count' => 1]);
        alert()->success('Timer Extended by 12 hours!!!', 'Success')->persistent("Close");
        return redirect()->route('user.index');
    }

    public function activateAccount()
    {
        $userSetting = UserSetting::where('user_id',$this->userId)->first();
        if($userSetting)
        {
            if($userSetting->account_status == 'active')
            {
                return redirect()->route('user.index');
            }
            $epin = new Epin;
            $unusedEpins = $epin->getUnusedEpin($this->userId);
            return view('user.activate',compact('unusedEpins'));
        }
        return redirect()->route('user.index');
    }

    public function activate(Request $request)
    {
        $requestData = $request->all();
        DB::beginTransaction(); // <-- first line
        $saved = true;
        $epin = Epin::find($requestData['epin_id']);
        if($epin)
        {
            try
            {
                $epin->update([
                    'status' => 'used'
                ]);
                $userSetting = UserSetting::where('user_id',$this->userId)
                    ->update([
                        'account_status' => 'active',
                        'give_help_amount' => $requestData['amount']*2,
                        'get_help_amount' => $requestData['amount']*3
                    ]);
                $giveHelp = GiveHelp::create([
                    'user_id' => $this->userId,
                    'amount' => $requestData['amount'],
                    'status' => 'pending',
                    'balance' => $requestData['amount'],
                    'type' => 'helping',
                    'completion_state' => 'none',
                ]);
                if($giveHelp && $userSetting && $epin)
                {
                    $saved =true;
                }
            }
            catch(\Throwable $e)
            {
                alert()->error($e->getMessage(), 'Error')->persistent("Close");
                return redirect()->back()->withInput();
            }
            if($saved)
            {
                DB::commit(); // YES --> finalize it
                alert()->success('Account has ben activated successfully', 'Success')->persistent("Close");
                return redirect()->route('user.index');
            }
            else
            {
                DB::rollBack(); // NO --> some error has occurred undo the whole thing
                alert()->error('Something went wrong', 'Error')->persistent("Close");
                return redirect()->back()->withInput();
            }
        }
        else
        {
            alert()->error('Something went wrong', 'Error')->persistent("Close");
            return redirect()->back()->withInput();
        }

    }
}
