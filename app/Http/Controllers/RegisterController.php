<?php


namespace App\Http\Controllers;
use App\CompanyPool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JsValidator;
use Validator;
use App\State;
use App\Bank;
use App\District;
use App\User;
use App\UserPassword;
use App\UserDetail;
use App\UserSetting;
use App\Mail\RegistrationMail;
use Illuminate\Support\Facades\Mail;
use DB;

class RegisterController extends Controller
{
    /*
    * Define your validation rules in a property in
    * the controller to reuse the rules.
    */
    protected $validationRules = [
        'sponsor_id' => 'required|exists:users,user_name',
        'sponsor_name' => 'required',
        'name' => ['required','string','min:3','max:41','regex:/(^[a-zA-Z\\s]*$)/u'],
        'email' => 'required|email',
        'user_name' => 'required|string|min:3|max:255|alpha_num|unique:users|regex:/^[a-zA-Z]{3}[A-Z0-9a-z]*$/',
        'mob_no' => 'required|numeric|digits:10',
        'district_id' => 'required',
        'state_id' => 'required',
        'bank_id' => 'required',
        'account_no' => 'required|numeric',
        'account_type' => 'required|string|max:255',
        'ifsc_code' => ['required','string','max:255','regex:/(^([A-Z|a-z]{4}[0][A-Z0-9a-z]{6}$))/u'],
        'branch' => 'required|string|max:255',
        'password' => 'required|string|min:6|confirmed',
        'paytm_no' => 'numeric|nullable',
        'bitcoin_add' => 'string|nullable',
        'gpay' => 'numeric|nullable'
    ];
    protected $customAttributes = [
        'sponsor_id' => 'Sponsor ID',
        'sponsor_name' => 'Sponsor Name',
        'name' => 'Name',
        'email' => 'Email',
        'user_name' => 'Username',
        'mob_no' => 'Mobile Number',
        'district_id' => 'District',
        'state_id' => 'State',
        'account_no' => 'Account Number',
        'account_type' => 'Account Type',
        'ifsc_code' => 'IFSC Code',
        'branch' => 'Branch',
        'password' => 'Password',
        'paytm_no' => 'Paytm Number',
        'gpay_no' => 'Gpay Number',
        'bitcoin_add' => 'Bitcoin Address',
        'bank_id' => 'Bank Name'
    ];

    public function showRegistrationForm(Request $request)
    {
        if($request->has('sponsor-id')) {
            $sponsorId = $request['sponsor-id'];
            $sponsorDetails = User::where('user_name',$sponsorId)->first();
            $validator = JsValidator::make($this->validationRules, [], $this->customAttributes);
            $states = State::orderBy('name','ASC')->get();
            $banks = Bank::orderBy('name','ASC')->get();
            return view('auth.register', compact('validator', 'states', 'banks','sponsorDetails'));
        }
        else
        {
            $sponsorDetails = array();
            $validator = JsValidator::make($this->validationRules, [], $this->customAttributes);
            $states = State::orderBy('name','ASC')->get();
            $banks = Bank::orderBy('name','ASC')->get();
            return view('auth.register', compact('validator', 'states', 'banks','sponsorDetails'));
        }
    }

    public function getDistricts(Request $request)
    {
        $requestData = $request->all();
        if(!empty($requestData))
        {
            $stateId = $requestData['state_id'];
            $data = District::select('id','name')->where('state_id',$stateId)->get();
            $districts = array();
            foreach ($data as $value)
            {
                $key = $value->id;
                $name = $value->name;
                $districts[$key] = $name;
            }
            return response()->json(['success'=>'true','districts' => $districts]);
        }
        else
        {
            return response()->json(['success' =>'false']);
        }

    }

    public function getSponsorDetails(Request $request)
    {
        if($request->has('sponsorId'))
        {
            $requestData = $request->all();
            $sponsorId = $requestData['sponsorId'];
            $sponsor = User::select('name')->where('user_name',$sponsorId)->first();
            if(!empty($sponsor))
            {
                return response()->json(['success'=>'true','sponsorName' => $sponsor->name]);
            }
            else
            {
                return response()->json(['error' => 'Invalid Sponsor'], 401);
            }
        }
        else
        {
            return response()->json(['error' => 'Something went wrong!'], 401);
        }
    }

    public function sendOtp(Request $request)
    {
        $otp = rand(100000,999999);
        $mobNo = $request->get('number');
        $message = 'DEAR MUDRASHAKTI GUEST YOUR MOBILE VERIFICATION CODE IS- '.$otp.' ,PLEASE ENTER AND SUBMIT FOR SIGNUP WWW.MUDRASHAKTI.COM THANK YOU.';
        sendMessage($mobNo, $message);
        session(['otp' => $otp]);
        return response()->json(['success'=>'true','message' => 'An OTP has been sent to your Mobile number','otp' => $otp]);
    }

    public function verifyOtp(Request $request)
    {
        if(session()->get('otp') == $request->get('otp'))
        {
            return response()->json(['success'=>'true','message' => 'Mobile Number Verified Successfully']);
        }
        else
        {
            return response()->json(['error'=>'OTP did not match'],401);
        }
    }

    public function verifyDetails(Request $request)
    {
        $data = $request->all();
        $users = UserDetail::with('user')
            ->join('users','users.id','=','user_details.user_id')
            ->select('user_details.*')
            ->where(function ($query) use ($data) {
                $query->where('mob_no', '=', $data['mob_no'])
                    ->orWhere('account_no', '=', $data['account_no'])
                    ->orWhere('users.email','=',$data['email']);
            })
            ->where('users.status', '=', 'rejected')
            ->get();
        $count = count($users);
        if($count > 0)
        {
            return response()->json(['status'=>'error','message' => 'These details have been neglected']);
        }

        $sameUsers = UserDetail::with('user')
            ->join('users','users.id','=','user_details.user_id')
            ->select('user_details.*')
            ->where(function ($query) use ($data) {
                $query->where('mob_no', '=', $data['mob_no'])
                    ->orWhere('account_no', '=', $data['account_no'])
                    ->orWhere('users.email','=',$data['email']);
            })
            ->get();

        $userCount = count($sameUsers);
        if($userCount >= 3)
        {
            return response()->json(['status'=>'error','message' => 'You can only register 3 account with same details']);
        }
        return response()->json(['status'=>'ok']);
    }

    protected function create(Request $request)
    {
        $validation = Validator::make($request->all(), $this->validationRules,[],$this->customAttributes);
        if ($validation->fails()) {
            flash($validation->errors())->error()->overlay();
            return redirect()->back()->withInput();
        }

        $data = $request->all();
        $user = array();
        $userDetails = array();
        $user['sponsor_id'] = strtolower($data['sponsor_id']);
        $user['name'] = strtoupper($data['name']);
        $user['email'] = strtolower($data['email']);
        $user['user_name'] = strtolower($data['user_name']);
        $user['password'] = bcrypt($data['password']);
        $user['status'] = 'pending';

        $userDetails['mob_no'] = $data['mob_no'];
        $userDetails['state_id'] = $data['state_id'];
        $userDetails['district_id'] = $data['district_id'];
        $userDetails['bank_id'] = $data['bank_id'];
        $userDetails['account_no'] = $data['account_no'];
        $userDetails['account_type'] = $data['account_type'];
        $userDetails['ifsc_code'] = strtoupper($data['ifsc_code']);
        $userDetails['branch'] = strtoupper($data['branch']);
        $userDetails['gpay_no'] = $data['gpay_no'];
        $userDetails['paytm_no'] = $data['paytm_no'];
        $userDetails['bitcoin_add'] = $data['bitcoin_add'];

        DB::beginTransaction(); // <-- first line
        $saved = true;
        try{
            //create User
            $user = User::create($user);
            $user->assignRole('User');

            //create user details
            $userDetails = UserDetail::create($userDetails);
            $user->userDetails()->save($userDetails);

            //create user password
            $userPassword = UserPassword::create([
                'user_id' => $user->id,
                'password'=> $data['password']
            ]);

            $companyPool = CompanyPool::create([
                'user_id' => $user->id
            ]);

            $userSetting = UserSetting::create([
                    'user_id' => $user->id,
                    'account_status' => 'inactive'
            ]);
            $number = $data['mob_no'];
            $message = 'THANKS FOR JOIN WWW.MUDRASHAKTI.COM YOUR LOGIN ID- '.$data['user_name'].' AND PASSWORD-'.$data['password'].' ,PLEASE SECURE YOUR LOGIN PASSWORD FOR SAFETY.';
            sendMessage($number, $message);
            // Mail::to($data['email'])->send(new RegistrationMail($user));
            if($user && $userDetails && $userPassword && $userSetting && $companyPool)
                $saved = true;
            else
                $saved = false;
        }
        catch(\Throwable $e)
        {
            alert()->error($e->getMessage(), 'Error')->persistent("Close");
            return redirect()->back()->withInput();
        }

        if($saved)
        {
            DB::commit(); // YES --> finalize it
            alert()->success('Thanks for Registration! Your Username and Password has been sent to your Mobile', 'Success')->persistent("Close");
            return redirect()->route('login');
        }
        else
        {
            DB::rollBack(); // NO --> some error has occurred undo the whole thing
            alert()->error('Something went wrong', 'Error')->persistent("Close");
            return redirect()->back()->withInput();
        }
    }
}
