<?php


namespace App\Http\Controllers\user;

use App\GiveHelp;
use App\PoolUser;
use App\UserFund;
use App\UserPool;
use App\Http\Controllers\Controller;
use App\UserPoolFund;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

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
        return view('user.pool.view',compact('pooledUsers'));
    }

    public function index()
    {
        $userPool = new UserPool;
        $userPools = $userPool->getUserPool($this->userId);
        return view('user.pool.index',compact('userPools'));
    }

    public function action(Request $request)
    {
        $requestData = $request->all();
        $userPool = UserPool::find($requestData['pool_id']);
        DB::beginTransaction(); // <-- first line
        $saved = true;
        try
        {
            if($requestData['action'] == 'agree')
            {
                $giveHelp = GiveHelp::create([
                    'user_id' => $this->userId,
                    'amount' => 2000,
                    'status' => 'pending',
                    'balance' => 2000,
                    'type' => 'pool',
                    'completion_state' => 'none',
                ]);
                $statusUpdate = $userPool->update([
                   'status' => 'agree'
                ]);

                if($giveHelp && $statusUpdate)
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
                $statusUpdate = $userPool->update([
                    'status' => 'deny'
                ]);
                if($statusUpdate)
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
            DB::commit(); // YES --> finalize it
            alert()->success('Pool Request Accepted Successfully!!!', 'Success')->persistent("Close");
            return redirect()->back();
        }
        else
        {
            DB::rollBack(); // NO --> some error has occurred undo the whole thing
            alert()->error('Something went wrong', 'Error')->persistent("Close");
            return redirect()->back()->withInput();
        }
    }

    public function transferForm()
    {
        $userPoolFund = UserPoolFund::where('user_id',$this->userId)
                                    ->sum('amount');
        $transferFund = UserFund::where('from_wallet','pool-wallet')
                                    ->where('user_id',$this->userId)
                                    ->sum('amount');
        $availableFund = $userPoolFund - $transferFund;
        return view('user.pool.transfer',compact('userPoolFund','availableFund'));
    }

    public function fundTransfer(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric'
        ]);
        $isOnHold = checkUserforOnHold($this->userId);
        if(!$isOnHold)
        {
            $lastTransferredAmountTime = UserFund::where('user_id', $this->userId)
                                                ->where('from_wallet','pool-wallet')
                                                ->orderBy('id','DESC')
                                                ->first();
            $hours = getDateTime($lastTransferredAmountTime->created_at);
            if($hours >= 48)
            {
                $maxAmount= 1000;
                $time = Carbon::now('Asia/Kolkata');
                $date = $time->format('Y-m-d');
                $transferredAmountOnDay = UserFund::where('user_id', $this->userId)
                    ->where('from_wallet','pool-wallet')
                    ->whereDate('created_at', '=', $date)
                    ->sum('amount');
                $requestData = $request->all();
                if(!empty($requestData))
                {
                    $balance = $requestData['available_fund'];
                    $amount = $requestData['amount'];
                    if($balance >= $amount)
                    {
                        if($transferredAmountOnDay < $maxAmount)
                        {
                            $transferredAmountOnDay = $transferredAmountOnDay + $amount;
                            if($transferredAmountOnDay <= $maxAmount)
                            {
                                $modulo = $amount % 500;
                                if($modulo == 0)
                                {
                                    UserFund::create([
                                        'user_id' => $this->userId,
                                        'amount' => $amount,
                                        'type' => 'credit',
                                        'purpose' => 'transfer',
                                        'from_wallet' => 'pool-wallet',
                                        'to_wallet' => 'fund-wallet',
                                    ]);
                                    alert()->success('Fund Transferred Successfully!!!', 'Success')->persistent("Close");
                                    return redirect()->back();
                                }
                                else
                                {
                                    alert()->error('transfer amount must be multiple of 500!!!', 'Error')->persistent("Close");
                                    return redirect()->back();
                                }
                            }
                            else
                            {
                                alert()->error('Transfer amount maximum limit 1000 per day. Please enter right amount!!!', 'Error')->persistent("Close");
                                return redirect()->back();
                            }
                        }
                        else
                        {
                            alert()->error('Maximum Limit Of transfer has been Reached!!!', 'Error')->persistent("Close");
                            return redirect()->back();
                        }
                    }
                    else
                    {
                        alert()->error('You do not have enough balance for this transfer!!!', 'Error')->persistent("Close");
                        return redirect()->back();
                    }

                }
                else
                {
                    alert()->error('Please Enter Valid Amount!!!', 'Error')->persistent("Close");
                    return redirect()->back();
                }
            }
            else
            {
                alert()->error('You can not withdraw money at this time!!!', 'Error')->persistent("Close");
                return redirect()->back();
            }
        }
        else
        {
            alert()->error('Your Account Put on hold, You can not transfer money!!!', 'Error')->persistent("Close");
            return redirect()->back();
        }
    }
}
