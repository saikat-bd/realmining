<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\TransactionPin;
use App\Mail\VerifyAccount;

class ForgotTransactionPinController extends Controller
{
    
    public function sendmail()
    {

          

          $userinfo = User::find(Auth::id());
          $pincode  = Str::random(6);
          $userinfo->transactionpin = $pincode;
          $userinfo->save();
          Mail::to($userinfo->email)->send(new TransactionPin($userinfo));
          return redirect('dashboard')->with('success', 'Please check your email, we are send new translation pin!');

    }


    public function verifysendmail()
    {
         $userinfo = User::find(Auth::id());
        Mail::to($userinfo->email)->send(new VerifyAccount($userinfo));
         return redirect('dashboard')->with('success', 'Please check your email, we are send verification link!');
    }

    public function verfiyaccountsubmit(Request $request)
    {
        $userinfo = User::where('wallet_address', $request->token)->first();
        $userinfo->email_verify = 1;
        $userinfo->save();
         return redirect('dashboard')->with('success', 'Your account has been verified successfully');
    }


}
