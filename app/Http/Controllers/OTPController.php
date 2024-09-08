<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Jobs\WithdrawalOTPMail;
use Illuminate\Support\Str;
use App\Models\OTP;
use Illuminate\Support\Facades\Mail;
use App\Mail\WithdrawalOTPMailSend;

class OTPController extends Controller
{
    public function withdrawal_otpsend()
    {
        
        $email    = Auth::user()->email;

        $checkotp = OTP::where('email', $email)->whereDate('created_at', '=', date('Y-m-d'))->first();
        if(empty($checkotp)){
            $otp_code = random_int(100000,999999);
            $otp_data           = new OTP();
            $otp_data->email    = Auth::user()->email;
            $otp_data->otpcode  = $otp_code;
            $otp_data->name  = Auth::user()->name;
            $otp_data->save();
            Mail::to($otp_data->email)->send(new WithdrawalOTPMailSend($otp_data));
        }   
        //dispatch(new WithdrawalOTPMail($otp_data))->onQueue('high');
        return redirect()->back()->withInput()->with('success', 'Mail has been send success!');


    }
}
