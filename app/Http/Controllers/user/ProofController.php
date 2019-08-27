<?php

namespace App\Http\Controllers\User;

use App\User;
use App\UserDetail;
use App\GiveHelp;
use App\GetHelp;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;


class ProofController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function uploadProof(Request $request)
    {
         $this->validate($request, [
                  'proof_file_name'=>'mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);
            $requestData = $request->all();
            $user_id = $requestData['user_id'];
            $getHelpID = $requestData['get_help_id'];
            $giveHelp = GiveHelp::with(['getHelps' => function($query) use($getHelpID)
                                      {
                                          $query->where('give_get_helps.get_help_id', '=', $getHelpID)                                                      ->where('give_get_helps.status', '=', 'pending');
                                      }
                                  ])
                                ->findOrFail($requestData['give_help_id']);
         if($request->hasFile('proof_file_name'))
         {

            $uploadFile = time().'_'.$request->file('proof_file_name')->getClientOriginalName();
            $request->file('proof_file_name')->move("uploads/proof-files/",$uploadFile);
            $requestData['proof_file_name'] = $uploadFile;
            $giveHelp->getHelps()->updateExistingPivot($getHelpID, ['proof_file_name' => $uploadFile]);
            $senderId = $giveHelp->user_id;
            $receiverId = $user_id;
            $senderDetail = User::where('id',$senderId)->first();
            $receiverDetails = User::with('userDetails')->where('id',$receiverId)->first();
            $message = 'DEAR MODINAAMA ID- '.$receiverDetails->user_name.' YOUR HELP AMT- '.$requestData['help_amount'].' HAS BEEN DONE BY USER ID- '.$senderDetail->user_name.' PLEASE CHECK YOUR ACCOUNT AND CONFIRM HELP WWW.MODINAAMA.IN THANK YOU.';
            $number = $receiverDetails->userDetails->mob_no;
            sendMessage($number,$message);
          }
         alert()->success('Proof Uploaded', 'Success')->persistent("Close");
         return redirect()->back();
        
    }

}