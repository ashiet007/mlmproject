<?php


namespace App\Http\Controllers\user;

use App\User;
use App\Epin;
use App\UserFund;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EpinController extends Controller
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

    public function generateEpin()
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $epin = substr(str_shuffle($permitted_chars), 0, 16);

        // call the same function if the barcode exists already
        if ($this->ePinExists($epin))
        {
            return $this->generateEpin();
        }
        // otherwise, it's valid and can be used
        return $epin;
    }

    public function ePinExists($epin) {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return Epin::where('pin', $epin)->exists();
    }

    public function unusedEpin()
    {
        $epin = new Epin;
        $unusedEpins = $epin->getUnusedEpin($this->userId);
        return view('user.epin.unused',compact('unusedEpins'));
    }

    public function create()
    {
        $totalFund = totalEpinIncome();
        $availableEpinWalletFund = availableEpinIncome();
        return view('user.epin.create', compact('totalFund','availableEpinWalletFund'));
    }

    public function store(Request $request)
    {
        $requestData = $request->all();
        $availableFund = $requestData['available_fund'];
        $requiredFund = $requestData['amount']*$requestData['no_of_epin'];
        if($requiredFund <= $availableFund)
        {
            for($i=1;$i<=$requestData['no_of_epin'];$i++)
            {
                $epin = $this->generateEpin();
                $userEpinsData[] = [
                    'user_id' => $this->userId,
                    'pin' => $epin,
                    'transaction_type' => 'generate',
                    'amount' => $requestData['amount'],
                    'status' => 'unused'
                ];
            }
            try
            {
                $epin = Epin::insert($userEpinsData);
                alert()->success('Epin created Successfully', 'Success')->persistent("Close");
                return redirect()->back();
            }
            catch (\Throwable $e)
            {
                alert()->error($e->getMessage(), 'Error')->persistent("Close");
                return redirect()->back()->withInput();
            }

        }
        else
        {
            alert()->error('Insufficient Fund', 'Error')->persistent("Close");
            return redirect()->back()->withInput();
        }
    }

    public function transferEpin(Request $request)
    {
        $this->validate($request,[
            'user_name' => 'required',
            'name' => 'required',
            'pin_id' =>'required',
        ],[
            'user_name.required' =>'Username Field is required',
            'name.required' => 'Name Field is required',
            'pin_id.required' => 'Please Select pin to transfer'
        ]);
        $requestData = $request->all();
        $user = User::where('user_name',$requestData['user_name'])->first();
        if($user)
        {
            if($user->id != $this->userId)
            {
                $epins = Epin::whereIn('id',$requestData['pin_id'])->get();
                // Create Data
                DB::beginTransaction();
                $saved = true;
                try
                {
                    foreach ($epins as $epin)
                    {
                        $data[] = [
                            'user_id' => $user->id,
                            'pin' => $epin->pin,
                            'transaction_type' => 'credit',
                            'amount' => $epin->amount,
                            'status' => 'unused'
                        ];
                        $epin->update([
                            'status' => 'used',
                            'transaction_type' => 'debit',
                            'transferred_to' => $user->id
                        ]);
                    }
                    $transferredEpins = Epin::insert($data);
                    if($epins && $transferredEpins)
                    {
                        $saved = true;
                    }
                }
                catch (\Throwable $e)
                {
                    alert()->error($e->getMessage(), 'Error')->persistent("Close");
                    return redirect()->back()->withInput();
                }
                if($saved)
                {
                    DB::commit(); // YES --> finalize it
                    alert()->success('Epin transferred Successfully', 'Success')->persistent("Close");
                    return redirect()->back();
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
                alert()->error('Please Select another user', 'Error')->persistent("Close");
                return redirect()->back()->withInput();
            }

        }
        alert()->error('Select User', 'Error')->persistent("Close");
        return redirect()->back()->withInput();
    }

    public function getUser(Request $request)
    {
        $result = [];
        $users= User::where('name', 'LIKE', "%{$request->input('query')}%")
                    ->orWhere('user_name','LIKE',"%{$request->input('query')}%")
                    ->get();
        foreach ($users as $user)
        {
            $result[] = [
                'id' => $user->id,
                'name' => $user->name.' ('.$user->user_name.')'
            ];
        }
        return response()->json($result);
    }

    public function report()
    {
        $epin = new Epin;
        $report = $epin->getEpinReport($this->userId);

        return view('user.epin.report',compact('report'));
    }
}