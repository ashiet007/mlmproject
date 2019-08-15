<?php
use App\User;
use App\UserDetail;
use App\GiveHelp;
use App\GetHelp;
use App\UserFund;
use App\UserSetting;
use App\HelpSetting;
use App\CompanyPool;
use App\LevelIncome;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Carbon\Carbon;

function sendMessage($number, $message)
{
//    $client = new GuzzleHttp\Client();
//    $res = $client->request('GET', 'http://mysmsshop.in/http-api.php?username=radiomaker&password=Helpdd*999&senderid=MAGICB&route=1&number='.$number.'&message='.$message);
//    $res->getStatusCode();
//    // "200"
//
//    $res->getBody();
//    // {"type":"User"...'
}

function helpMatchingCycle()
{
    $giveHelps = GiveHelp::select('give_helps.*')->with('user.userDetails')
        ->join('users', 'users.id', '=', 'give_helps.user_id')
        ->where('users.status','!=','blocked')
        ->where('give_helps.status','=','pending')
        ->where('type', 'helping')
        ->where(function ($query) {
            $query->where('completion_state', 'partially-assigned')
                ->orWhere('completion_state', 'none');
        })
        ->orderBY('match_order_date','ASC')
        ->get();
    if(count($giveHelps))
    {
        foreach ($giveHelps as $giveHelp)
        {
            $getHelps = GetHelp::select('get_helps.*')->with('user.userDetails')
                ->join('users', 'users.id', '=', 'get_helps.user_id')
                ->where('users.status','!=','blocked')
                ->where('get_helps.status','pending')
                ->where(function ($query) {
                    $query->where('completion_state', 'partially-assigned')
                        ->orWhere('completion_state', 'none');
                })
                ->orderBy('match_order_date','ASC')
                ->get();
            if(count($getHelps))
            {
                foreach ($getHelps as $getHelp)
                {
                    helpAssign($giveHelp, $getHelp);
                    break;
                }
            }
        }
    }
}

function helpAssign($giveHelp, $getHelp)
{
    $giveHelpBalance = 0;
    $getHelpBalance = 0;
    if($giveHelp->balance == $getHelp->balance)
    {
        $amount = $giveHelp->balance;
        $giveHelp->getHelps()->attach($getHelp->id,['assigned_amount' => $giveHelp->balance, 'status' => 'pending']);
        $giveHelp->update([
            'balance' => $giveHelpBalance,
            'completion_state' => 'assigned',
        ]);
        $getHelp->update([
            'balance' => $getHelpBalance,
            'completion_state' => 'assigned',

        ]);
        $senderNumber = $giveHelp->user->userDetails->mob_no;
        $receiverNumber = $getHelp->user->userDetails->mob_no;
        $senderMessage = 'OUR MAGIC PARTNER- '.$giveHelp->user->user_name.' ,YOU HAVE GOT A LINK FOR PROVIDE HELP AMT- '.$amount.' ,PLEASE CONT- '.$receiverNumber.','.$getHelp->user->name.',WWW.MAGICBANDHAN.COM THANKS.';
        $receiverMessage = 'OUR MAGIC PARTNER - '.$getHelp->user->user_name.' ,YOU HAVE GOT A LINK FOR RECEIVE HELP AMT-'.$amount.' ,PLEASE CONT- '.$senderNumber.','.$giveHelp->user->name.' ,WWW.MAGICBANDHAN.COM THANKS.';
        sendMessage($senderNumber, $senderMessage);
        sendMessage($receiverNumber, $receiverMessage);
    }
    elseif($giveHelp->balance > $getHelp->balance)
    {
        $amount = $getHelp->balance;
        $giveHelpBalance = $giveHelp->balance - $getHelp->balance;
        $giveHelp->getHelps()->attach($getHelp->id,['assigned_amount' => $getHelp->balance, 'status' => 'pending']);
        $giveHelp->update([
            'balance' => $giveHelpBalance,
            'completion_state' => 'partially-assigned',

        ]);
        $getHelp->update([
            'balance' => $getHelpBalance,
            'completion_state' => 'assigned',
        ]);
        $senderNumber = $giveHelp->user->userDetails->mob_no;
        $receiverNumber = $getHelp->user->userDetails->mob_no;
        $senderMessage = 'OUR MAGIC PARTNER- '.$giveHelp->user->user_name.' ,YOU HAVE GOT A LINK FOR PROVIDE HELP AMT- '.$amount.' ,PLEASE CONT- '.$receiverNumber.','.$getHelp->user->name.',WWW.MAGICBANDHAN.COM THANKS.';
        $receiverMessage = 'OUR MAGIC PARTNER - '.$getHelp->user->user_name.' ,YOU HAVE GOT A LINK FOR RECEIVE HELP AMT-'.$amount.' ,PLEASE CONT- '.$senderNumber.','.$giveHelp->user->name.' ,WWW.MAGICBANDHAN.COM THANKS.';
        sendMessage($senderNumber, $senderMessage);
        sendMessage($receiverNumber, $receiverMessage);
    }
    else
    {
        $amount = $giveHelp->balance;
        $getHelpBalance = $getHelp->balance - $giveHelp->balance;
        $giveHelp->getHelps()->attach($getHelp->id,['assigned_amount' => $giveHelp->balance, 'status' => 'pending']);
        $giveHelp->update([
            'balance' => $giveHelpBalance,
            'completion_state' => 'assigned',

        ]);
        $getHelp->update([
            'balance' => $getHelpBalance,
            'completion_state' => 'partially-assigned',
        ]);
        $senderNumber = $giveHelp->user->userDetails->mob_no;
        $receiverNumber = $getHelp->user->userDetails->mob_no;
        $senderMessage = 'OUR MAGIC PARTNER- '.$giveHelp->user->user_name.' ,YOU HAVE GOT A LINK FOR PROVIDE HELP AMT- '.$amount.' ,PLEASE CONT- '.$receiverNumber.','.$getHelp->user->name.',WWW.MAGICBANDHAN.COM THANKS.';
        $receiverMessage = 'OUR MAGIC PARTNER - '.$getHelp->user->user_name.' ,YOU HAVE GOT A LINK FOR RECEIVE HELP AMT-'.$amount.' ,PLEASE CONT- '.$senderNumber.','.$giveHelp->user->name.' ,WWW.MAGICBANDHAN.COM THANKS.';
        sendMessage($senderNumber, $senderMessage);
        sendMessage($receiverNumber, $receiverMessage);
    }
}

function getDateTime($dateTime)
{
   $seconds = time() - strtotime($dateTime);
   $hours = $seconds / (60*60);
   return sprintf('%0.2f', $hours);
}

function helpGeneration()
{
    $users = User::with('userDetails','singleLineIncome','userSetting')->get();
    $helpSetting = HelpSetting::orderBy('order_no')->first();
    foreach($users as $user)
    {
        if($user->status != 'rejected' && $user->status != 'blocked' && $user->identity != 'fake')
        {
            $giveHelp = new GiveHelp;
            $helpCount = $giveHelp->getHelpCount($user->id);
            $lastGiveHelp = GiveHelp::where('user_id', $user->id)
                ->where('type', 'helping')
                ->orderBy('id', 'DESC')
                ->first();
            if ($lastGiveHelp) {
                if ($lastGiveHelp->status == 'accepted') {
                    $lastGetHelp = GetHelp::where('user_id', $user->id)
                        ->where('type', 'helping')
                        ->orderBy('id', 'DESC')
                        ->first();
                    if ($lastGetHelp) {
                        if ($lastGetHelp->status == 'accepted') {
                            if ($lastGiveHelp->created_at < $lastGetHelp->created_at)
                            {
                                $activeIds = getTotalDirectActiveTeam($user->user_name);
                                foreach ($helpSetting as $item)
                                {
                                    if ($activeIds >= $item->needed_active_ids) {
                                        if ($helpCount <= $item->round)
                                        {
                                            GiveHelp::create([
                                                'user_id' => $user->id,
                                                'amount' => $user->userSetting->give_help_amount,
                                                'status' => 'pending',
                                                'balance' => $user->userSetting->give_help_amount,
                                                'type' => 'helping',
                                                'completion_state' => 'none',
                                            ]);
                                            break;
                                        }
                                    }
                                }
                            }
                            else if ($lastGiveHelp->created_at > $lastGetHelp->created_at)
                            {
                                $isOnHold = checkUserforOnHold($user->id);
                                if(!$isOnHold)
                                {
                                    if($user->singleLineIncome->amount >= 1000)
                                    {
                                        if($helpCount == 1)
                                            $hour = 2;
                                        elseif ($helpCount == 2)
                                            $hour = 24;
                                        else
                                            $hour = 36;

                                        $currentHour = getDateTime($user->singleLineIncome->updated_at);
                                        if($currentHour >= $hour)
                                        {
                                            GetHelp::create([
                                                'user_id' => $user->id,
                                                'amount' => $user->userSetting->get_help_amount,
                                                'status' => 'pending',
                                                'type' => 'helping',
                                                'balance' => $user->userSetting->get_help_amount,
                                                'completion_state' => 'none',
                                            ]);
                                            $user->singleLineIncome->update([
                                                'amount' => 0,
                                                'status' => 'stop'
                                            ]);
                                        }
                                        if($user->singleLineIncome->status == 'start')
                                        {
                                            $user->singleLineIncome->update([
                                                'status' => 'stop'
                                            ]);
                                        }
                                    }
                                }
                            }
                        }
                    }
                    else
                    {
                        $isOnHold = checkUserforOnHold($user->id);
                        if(!$isOnHold)
                        {
                            if($user->singleLineIncome->amount >= 1000)
                            {
                                if($helpCount == 1)
                                    $hour = 2;
                                elseif ($helpCount == 2)
                                    $hour = 24;
                                else
                                    $hour = 36;

                                $currentHour = getDateTime($user->singleLineIncome->updated_at);
                                if($currentHour >= $hour)
                                {
                                    GetHelp::create([
                                        'user_id' => $user->id,
                                        'amount' => $user->userSetting->get_help_amount,
                                        'status' => 'pending',
                                        'type' => 'helping',
                                        'balance' => $user->userSetting->get_help_amount,
                                        'completion_state' => 'none',
                                    ]);
                                    $user->singleLineIncome->update([
                                        'amount' => 0,
                                        'status' => 'stop'
                                    ]);
                                }
                                if($user->singleLineIncome->status == 'start')
                                {
                                    $user->singleLineIncome->update([
                                        'status' => 'stop'
                                    ]);
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

function totalTeam($totalTeam,$members, $level)
{
    if(!$members->isEmpty())
    {
        foreach ($members as $member)
        {
            $member->level = $level ;
        }
        foreach ($members as $member)
        {
            $username = $member->username;
            $totalTeam->push($member);
            $newmembers = User::with('userDetails')
                ->where('sponsor_id', '=', $username)
                ->orderBy('created_at','DESC')
                ->get();
            $level = $member->level;
            $level = $level + 1;
            $totalTeam = totalTeam($totalTeam, $newmembers, $level);
        }
    }
    return $totalTeam;
}

function getTotalTeam($username)
{
    $teamDetails = User::with('userDetails')
        ->where('sponsor_id', '=', $username)
        ->orderBy('created_at','DESC')
        ->get();
    $totalTeam = $teamDetails;
    if(!$teamDetails->isEmpty())
    {
        $level = 1;
        foreach ($teamDetails as $teamDetail)
        {
            $teamDetail->level = $level ;
        }
        foreach ($teamDetails as $teamDetail)
        {
            $username = $teamDetail->user_name;
            $members = User::with('userDetails')
                ->where('sponsor_id', '=', $username)
                ->orderBy('created_at','DESC')
                ->get();
            if(!$members->isEmpty())
            {
                $level = $teamDetail->level;
                $level = $level + 1;
                foreach ($members as $member)
                {
                    $member->level = $level ;
                }
                foreach ($members as $member)
                {
                    $username = $member->user_name;
                    $totalTeam->push($member);
                    $newmembers = User::with('userDetails')
                        ->where('sponsor_id', '=', $username)
                        ->orderBy('created_at','DESC')
                        ->get();
                    $level = $member->level;
                    $level = $level + 1;
                    $totalTeam = totalTeam($totalTeam,$newmembers, $level);
                }
            }

        }
    }
    return $totalTeam;
}

function getTotalDirectActiveTeam($username)
{
    $count = User::with('userDetails')
        ->where('sponsor_id', '=', $username)
        ->where('status','=','active')
        ->orderBy('created_at','DESC')
        ->count();
    return $count;
}

function getTotalDirectTeam($username)
{
    $totalDirectTeam = User::with('userDetails')
        ->where('sponsor_id', '=', $username)
        ->orderBy('created_at','DESC')
        ->get();
    return $totalDirectTeam;
}

function totalIncome($username)
{
    $levelIncome = LevelIncome::orderBy('level','ASC')->get();
    $totalTeam = getTotalTeam($username);
    $income = 0;
    foreach ($totalTeam as $member)
    {
        foreach ($levelIncome as $data)
        {
            if($data->level == $member->level)
            {
                $userSetting = UserSetting::where('user_id',$member->id)->first();
                $giveHelpIncome = $userSetting->give_help_income;
                $income = $income + $giveHelpIncome * $data->income;
            }
        }
    }
    $totalIncome['level'] = $totalIncome['working'] = $income/2;
    $id = Auth::User()->id;
    $addedFund = UserFund::where('user_id',$id)
        ->where('type','credit')
        ->sum('amount');
    $totalIncome['working'] = $totalIncome['working']+$addedFund ;
    return $totalIncome;
}

function helpingIncome()
{
    $id = Auth::User()->id;
    $gethelp = new GetHelp;
    $totalHelpingIncome = $gethelp->totalHelpingIncome($id);
    return $totalHelpingIncome;
}

function sumOfIncomes($username)
{
    $workingIncome = totalIncome($username);
    $totalHelpingIncome = helpingIncome();
    $sum = $workingIncome['working'] + $totalHelpingIncome;
    return $sum;
}

function availableBalance($username,$id)
{
    $income = totalIncome($username);
    $withdrawalAmount = GetHelp::where('user_id',$id)
        ->where('type','working')
        ->sum('amount');
    return $availableBalance = $income['working'] - $withdrawalAmount;
}

function getDetails($username)
{
    $data = User::with('userDetails')
                  ->where('user_name',$username)
                  ->first();
    return $data;

}

function checkUserforOnHold($id)
{
    $detail = UserDetail::where('user_id',$id)
                        ->select('mob_no','account_no')
                        ->first();
    $users = UserDetail::with('user')
                ->join('users','users.id','=','user_details.user_id')
                ->select('user_details.*')
                ->where(function ($query) use ($detail) {
                    $query->where('mob_no', '=', $detail->mob_no)
                        ->orWhere('account_no', '=', $detail->account_no);
                })
                ->where('users.status', '=', 'rejected')
                ->get();
    $count = count($users);
    if($count > 0)
        return true;
    else
        return false;
}

function addSingleLineIncome()
{
    $companyPool = CompanyPool::with('user')
                                    ->start()
                                    ->get();
    foreach ($companyPool as $data)
    {
        if($data->user->status == 'active')
        {
            $activeIds = getTotalDirectActiveTeam($data->user->user_name);
            $helpSettings = HelpSetting::orderBy('order_no','DESC')->get();
            foreach ($helpSettings as $helpSetting)
            {
                if ($activeIds >= $helpSetting->needed_active_ids )
                {
                    $amount =  $data->amount + $helpSetting->income_per_id;
                    $data->update([
                        'amount' => $amount
                    ]);
                    break;
                }
            }
        }
    }
}