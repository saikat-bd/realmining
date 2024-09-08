<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Country;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use App\Models\Transaction;
use App\Models\Package;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function index()
    {
        $data['userinfo'] = User::find(Auth::id());
        return view('users.change_password', $data);
    }

    public function password_update(Request $request)
    {
        $profileedit = User::find(Auth::id());
        if($request->isMethod('post')){
            $alldata = $request->all();
            $rules = [
                'current_password'          => 'required',
                'new_password'              => 'required|min:6',
            ];
            $custommessage = [
                'current_password.required'    => 'Current password is required!',
                'new_password.required'        => 'New password is required!',
                'new_password.min'             => 'must be at least 6 characters in length!',
            ];

            $validations = Validator::make($alldata, $rules, $custommessage);
            if($validations->fails()){
                return redirect()->back()->withInput()->withErrors($validations);
            }

            if(Hash::check($request->current_password, $profileedit->password)){
                $profileedit->password = Hash::make($request->new_password);
                $profileedit->save();
                return redirect('change-password')->with('success', 'Password has been changed success!');
            }else{
               return redirect('change-password')->with('error', 'Current password is wrong!'); 
            }


            


        }else{
              return redirect()->back();
        }
    }

    public function trsaction_pin(Request $request)
    {
        $profileedit = User::find(Auth::id());
        if($request->isMethod('post')){
            $alldata = $request->all();
            $rules = [
                'new_pin'          => 'required|min:6',
                'confirm_pin'      => 'required|same:new_pin',
            ];
            $custommessage = [
                'new_pin.required'              => 'Transaction PIN is required!',
                'confirm_pin.required'         => 'Confirm PIN is required!',
                'new_pin.min'                  => 'must be at least 6 characters in length!',
            ];

            $validations = Validator::make($alldata, $rules, $custommessage);
            if($validations->fails()){
                return redirect()->back()->withInput()->withErrors($validations);
            }

     
            $profileedit->transactionpin = $request->confirm_pin;
            $profileedit->save();
            return redirect('change-password')->with('success', 'Transaction PIN has been created success!');
        

        }else{
              return redirect()->back();
        }
    }


    public function trsaction_pin_update(Request $request)
    {
        $profileedit = User::find(Auth::id());
        if($request->isMethod('post')){
            $alldata = $request->all();
            $rules = [
                'current_pin'          => 'required',
                'newpin'               => 'required',
            ];
            $custommessage = [
                'current_pin.required'    => 'Current PIN is required!',
                'newpin.required'         => 'New PIN is required!',
            ];

            $validations = Validator::make($alldata, $rules, $custommessage);
            if($validations->fails()){
                return redirect()->back()->withInput()->withErrors($validations);
            }
            if($profileedit->transactionpin == $request->current_pin){
                $profileedit->transactionpin = $request->newpin;
                $profileedit->save();
                return redirect('change-password')->with('success', 'Transaction PIN has been changed success!');
            }else{
                return redirect('change-password')->with('error', 'Current Transaction PIN is wrong!'); 
            }
     
            
        

        }else{
              return redirect()->back();
        }
    }


}
