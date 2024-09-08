<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Activity;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{

    public function index()
    {
        return view('website.login');
    }

    public function login_check(Request $request)
    {
        if($request->isMethod('post')){
            $alldata = $request->all();
            $rules = [
                'username' => 'required',
                'password' => 'required',
            ];
            $custommessage = [
                'username.required' => 'Username is required!',
                'password.required' => 'Password is required!',
            ];

            $validations = Validator::make($alldata, $rules, $custommessage);
            if($validations->fails()){
                return redirect()->back()->withInput()->withErrors($validations);
            }


            $username   = $request->username;
            $userinfo   = User::where('username',$username)->orWhere('email', $username)
                                ->first();

            if ($userinfo && Hash::check($request->password, $userinfo->password)) {

                if($userinfo->payment_lock == 'Active'){
                    if($userinfo->user_type == 'member'){
                    Auth::login($userinfo);
                    $saveactivity = new Activity();
                    $saveactivity->user_id = Auth::id();
                    $saveactivity->ipaddress = $request->ip();
                    $saveactivity->save();
                     return redirect('dashboard');
                    }else{
                        return redirect()->back()->with('error', 'wrong');
                    }
                }else{
                   return redirect()->back()->with('error', 'wrong');  
                }

                

            }else{
               return redirect()->back()->with('error', 'wrong');
            }
           
         

        }else{
            return back()->withInput();
        }


    }


    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('auth');
    }



}
