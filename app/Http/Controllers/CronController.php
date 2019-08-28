<?php


namespace App\Http\Controllers;

use App\Setting;
use App\User;
use App\GiveHelp;
use Carbon\Carbon;

class CronController extends Controller
{
    public function helpMatching()
    {
        $setting = Setting::first();
        $time = Carbon::now('Asia/Kolkata');
        $hour = $time->format('H');
        $t=date('d-m-Y');
        $day = date("D",strtotime($t));
        if($setting->link_status == 1 && $day != 'Sun' && time() >= strtotime('10:30:00') && $hour < 16)
        {
            helpMatchingCycle();
        }
        userPool();
        userAccountActivation();
    }

    public function helpGeneration()
    {
        helpGeneration();
    }

    public function userStatusUpdate()
    {
        $users = User::get();
        foreach ($users as $user)
        {
            $id = $user->id;
            $giveHelp = GiveHelp::where('user_id', $id)
                ->orderBy('id', 'DESC')
                ->first();
            if(!is_null($giveHelp)) {
                if ($giveHelp->status == 'rejected') {
                    $user->update([
                        'status' => 'rejected'
                    ]);
                } elseif ($giveHelp->status == 'accepted') {
                    $user->update([
                        'status' => 'active'
                    ]);
                } else {
                    $giveHelp = GiveHelp::where('user_id', $id)
                        ->orderBy('id', 'ASC')
                        ->first();
                    if ($giveHelp->status == 'pending') {
                        $user->update([
                            'status' => 'pending'
                        ]);
                    }
                }
            }
            else
            {
                $user->update([
                    'status' => 'pending'
                ]);
            }
        }
    }
}

