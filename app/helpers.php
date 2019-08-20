<?php

use App\Epin;
use App\User;
use App\UserDetail;
use App\GiveHelp;
use App\GetHelp;
use App\UserFund;
use App\UserSetting;
use App\HelpSetting;
use App\CompanyPool;
use App\LevelIncome;
use App\UserPool;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Carbon\Carbon;

function sendMessage($number, $message)
{
    $client = new GuzzleHttp\Client();
    $res = $client->request('GET', 'http://mysmsshop.in/http-api.php?username=radiomaker&password=Helpdd*999&senderid=MODINM&route=1&number='.$number.'&message='.$message);
    $res->getStatusCode();
    // "200"

    $res->getBody();
    // {"type":"User"...'
}


function helpMatchingCycle()
{
    $giveHelps = GiveHelp::select('give_helps.*')->with('user.userDetails')
        ->join('users', 'users.id', '=', 'give_helps.user_id')
        ->where('users.status','!=','blocked')
        ->where('give_helps.status','=','pending')
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
        $senderMessage = 'DEAR MODINAAMA ID- '.$giveHelp->user->user_name.' ,YOU HAVE GOT A LINK FOR PROVIDE HELP AMT- '.$amount.' ,PLEASE CALL- '.$receiverNumber.','.$getHelp->user->name.' ,WWW.MODINAAMA.IN THANK YOU.';
        $receiverMessage = 'DEAR MODINAAMA ID- '.$getHelp->user->user_name.' ,YOU HAVE GOT A LINK FOR RECEIVE HELP AMT-'.$amount.' ,PLEASE CALL- '.$senderNumber.','.$giveHelp->user->name.' ,WWW.MODINAAMA.IN THANK YOU.';
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
        $senderMessage = 'DEAR MODINAAMA ID- '.$giveHelp->user->user_name.' ,YOU HAVE GOT A LINK FOR PROVIDE HELP AMT- '.$amount.' ,PLEASE CALL- '.$receiverNumber.','.$getHelp->user->name.' ,WWW.MODINAAMA.IN THANK YOU.';
        $receiverMessage = 'DEAR MODINAAMA ID- '.$getHelp->user->user_name.' ,YOU HAVE GOT A LINK FOR RECEIVE HELP AMT-'.$amount.' ,PLEASE CALL- '.$senderNumber.','.$giveHelp->user->name.' ,WWW.MODINAAMA.IN THANK YOU.';
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
        $senderMessage = 'DEAR MODINAAMA ID- '.$giveHelp->user->user_name.' ,YOU HAVE GOT A LINK FOR PROVIDE HELP AMT- '.$amount.' ,PLEASE CALL- '.$receiverNumber.','.$getHelp->user->name.' ,WWW.MODINAAMA.IN THANK YOU.';
        $receiverMessage = 'DEAR MODINAAMA ID- '.$getHelp->user->user_name.' ,YOU HAVE GOT A LINK FOR RECEIVE HELP AMT-'.$amount.' ,PLEASE CALL- '.$senderNumber.','.$giveHelp->user->name.' ,WWW.MODINAAMA.IN THANK YOU.';
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
    $helpSetting = HelpSetting::orderBy('order_no','DESC')->get();
    foreach($users as $user)
    {
        if($user->status != 'rejected' && $user->status != 'blocked' && $user->identity != 'fake' && $user->userSetting->account_status == 'active')
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
    if(count($members))
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
    if(count($teamDetails))
    {
        $level = 1;
        foreach ($teamDetails as $teamDetail)
        {
            $teamDetail->level = $level ;
        }
        getTeamRecursive($teamDetails,$totalTeam);

    }
    return $totalTeam;
}

function getTeamRecursive($teamDetails,$totalTeam)
{
    foreach ($teamDetails as $teamDetail)
    {
        $username = $teamDetail->user_name;
        $members = User::with('userDetails')
            ->where('sponsor_id', '=', $username)
            ->orderBy('created_at','DESC')
            ->get();
        if(count($members))
        {
            $level = $teamDetail->level;
            foreach ($members as $member)
            {
                $member->level = $level + 1 ;
                $totalTeam->push($member);
            }
            getTeamRecursive($members,$totalTeam);
        }
    }
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
    $totalIncome['pin'] = $totalIncome['working'] = $income/2;
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
    $debitedFund = UserFund::where('user_id',$id)
        ->where('type','debit')
        ->sum('amount');
    return $availableBalance = $income['working'] - ($withdrawalAmount + $debitedFund);
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

function addSingleLineIncome($amount)
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
                    if($data->amount < 1000)
                    {
                        $singleLineIncome =  $data->amount + ($amount*$helpSetting->income_per_id);
                        $data->update([
                            'amount' => $singleLineIncome
                        ]);
                    }
                    break;
                }
            }
        }
    }
}

function userPool()
{
   $users = User::with('userPools','userDetails')->real()->get();
   foreach ($users as $user)
   {
       $totalDirectActiveIds = getTotalDirectActiveTeam($user->user_name);
       $moduloCount = intval($totalDirectActiveIds/5);
       $currentPoolCount = $user->userPools->count();
       if($moduloCount-$currentPoolCount)
       {
           $diff = $moduloCount-$currentPoolCount;
           for($i=1;$i<=$diff;$i++)
           {
               $count = $currentPoolCount?$currentPoolCount:0;
               $nextCount = $count++;
               UserPool::create([
                  'user_id' => $user->id,
                  'pool_no' => $nextCount,
                   'status' => 'pending'
               ]);
               $number = $user->userDetails->mob_no;
               $message = 'DEAR WWW.MODINAAMA.IN ID- '.$user->user_name.','.$user->name.' YOU ARE ELIGIBLE TO AUTO POOL IF YOU WANT TO ENTER GO IN POOL WALLET FOR PERMISSION THANK YOU.';
               sendMessage($number, $message);
           }
       }
   }
}

function userAccountActivation()
{
    $users = User::with('userSetting','userDetails')->real()->get();
    foreach ($users as $user)
    {
        $helpingFund = $user->userSetting->helping_fund;
        if($helpingFund >= 7500)
        {
            $user->userSetting->update([
               'account_status' => 'inactive',
                'helping_fund' => 0
            ]);
        }
    }
}

function totalEpinIncome()
{
    $username = Auth::User()->user_name;
    $id = Auth::User()->id;

    $income = totalIncome($username);
    $pinWallet = $income['pin'];
    $userFund = new UserFund;
    $transferredFund = $userFund->getPinWalletTransferredFund($id);
    $totalFund = $pinWallet + $transferredFund;
    return $totalFund;
}

function availableEpinIncome()
{
    $id = Auth::User()->id;
    $totalFund = totalEpinIncome();
    $epin = new Epin;
    $usedFund = $epin->getPinWalletUsedFund($id);
    $availableEpinWalletFund = $totalFund - $usedFund;
    return $availableEpinWalletFund;
}

