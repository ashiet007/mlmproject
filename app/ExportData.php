<?php


namespace App;

use App\User;
use Maatwebsite\Excel\Concerns\FromArray;

class ExportData implements FromArray
{
    public function array(): array
    {
        $users = User::with('userDetails.userState','userDetails.userDistrict','userDetails.userBank','userPassword')->get();
        $userData[] = [
            'Sr No', 'Username', 'Name', 'Email', 'Password', 'Mobile Number', 'State', 'District', 'Bank Name', 'Account Number', 'IFSC Code', 'Branch Name', 'Account Type', 'Paytm Number', 'Gpay/Phonepe Number', 'Bitcoin Address', 'Identity', 'Status', 'DOJ'
        ];
        $count = 1;
        foreach ($users as $user)
        {
            $userData[] = [
                'Sr No' => $count,
                'Username' => $user->user_name,
                'Name' => $user->name,
                'Email' => $user->email,
                'Password' => $user->userPassword->password,
                'Mobile Number' => $user->userDetails->mob_no,
                'State' => $user->userDetails->userState->name,
                'District' => $user->userDetails->userDistrict->name,
                'Bank Name' => $user->userDetails->userBank->name,
                'Account Number' => $user->userDetails->account_no,
                'IFSC Code' => $user->userDetails->ifsc_code,
                'Branch Name' => $user->userDetails->branch,
                'Account Type' => $user->userDetails->account_type,
                'Paytm Number' => $user->userDetails->paytm_no,
                'Gpay/Phonepe Number' => $user->userDetails->gpay_no,
                'Bitcoin Address' => $user->userDetails->bitcoin_add,
                'Identity' => $user->identity,
                'Status' => $user->status,
                'DOJ' => $user->created_at->format('d, M Y h:i:s A')
            ];
            $count++;
        }
        return $userData;
    }
}