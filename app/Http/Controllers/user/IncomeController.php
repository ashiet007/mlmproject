<?php

namespace App\Http\Controllers\User;

use App\DailyGrowth;
use App\User;
use App\UserDetail;
use App\GiveHelp;
use App\GetHelp;
use App\UserFund;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class IncomeController extends Controller
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
    public function directIncome()
    {
        $username = Auth::User()->user_name;
        $id = Auth::User()->id;

        $income = totalIncome($username);
        $availableBalance = availableBalance($username,$id);
        return view('user.income.withdraw',compact('income','availableBalance'));
    }

    public function workingWithrawal(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric'
        ]);
        $id = Auth::User()->id;
        $isOnHold = checkUserforOnHold($id);
        if(!$isOnHold)
        {
            $maxAmount= 1000;
            if(Auth::User()->identity == 'fake')
            {
                $maxAmount = 10000;
            }
            $time = Carbon::now('Asia/Kolkata');
            $date = $time->format('Y-m-d');
            $workingAmountSum = GetHelp::working()
                ->where('user_id', $id)
                ->whereDate('created_at', '=', $date)
                ->sum('amount');
            $requestData = $request->all();
            if(!empty($requestData))
            {
                $balance = $requestData['balance'];
                $amount = $requestData['amount'];
                if($balance >= $amount)
                {
                    if($workingAmountSum < $maxAmount)
                    {
                        $workingAmountSum = $workingAmountSum + $amount;
                        if($workingAmountSum <= $maxAmount)
                        {
                            $modulo = $amount % 500;
                            if($modulo == 0)
                            {
                                GetHelp::create([
                                    'user_id' => $id,
                                    'amount' => $amount,
                                    'identity' => 'real',
                                    'status' => 'pending',
                                    'type' => 'working',
                                    'balance' => $amount,
                                    'completion_state' => 'none',
                                ]);
                                alert()->success('Withdrawal Created!!!', 'Success')->persistent("Close");
                                return redirect()->route('income.direct');
                            }
                            else
                            {
                                alert()->error('Withdrawal must be multiple of 500!!!', 'Error')->persistent("Close");
                                return redirect()->route('income.direct');
                            }
                        }
                        else
                        {
                            alert()->error('Working income withdrawal maximum limit 1000 per day. Please enter right amount!!!', 'Error')->persistent("Close");
                            return redirect()->route('income.direct');
                        }
                    }
                    else
                    {
                        alert()->error('Maximum Limit Of Withdrawal has been Reached!!!', 'Error')->persistent("Close");
                        return redirect()->route('income.direct')->with('flash_message', '');
                    }
                }
                else
                {
                    alert()->error('You do not have enough balance for this withdrawal!!!', 'Error')->persistent("Close");
                    return redirect()->route('income.direct');
                }

            }
            else
            {
                alert()->error('Please Enter Valid Amount!!!', 'Error')->persistent("Close");
                return redirect()->route('income.direct');
            }
        }
        else
        {
            alert()->error('Your Account Put on hold, You can not withdraw money!!!', 'Error')->persistent("Close");
            return redirect()->route('income.direct');
        }
    }

    public function reports()
    {
        $getHelps = GetHelp::report($this->userId)
            ->working()
            ->get();
        return view('user.income.txn',compact('getHelps'));
    }

    public function fundTransfer(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric'
        ]);
        $requestData = $request->all();
        $availableFund = $requestData['available_fund'];
        $amount = $requestData['amount'];
        if($availableFund >= $amount)
        {
            try
            {
                 UserFund::create([
                     'user_id' => $this->userId,
                     'type' => 'debit',
                     'amount' => $amount,
                     'purpose' => 'transfer',
                     'from_wallet' => 'fund-wallet',
                     'to_wallet' => 'pin-wallet'
                ]);
                alert()->success('Fund Transferred Successfully!!!', 'Success')->persistent("Close");
                return redirect()->back();
            }
            catch(\Throwable $e)
            {
                alert()->error($e->getMessage(), 'Error')->persistent("Close");
                return redirect()->back()->withInput();
            }
        }
        else
        {
            alert()->error('You do not have enough balance for this transfer!!!', 'Error')->persistent("Close");
            return redirect()->back()->withInput();
        }
    }
}
