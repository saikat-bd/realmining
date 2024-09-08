<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function admnilogin_check(Request $request)
    {
        if($request->isMethod('post')){
            $alldata = $request->all();
            $rules = [
                'email' => 'required|email',
                'password' => 'required',
            ];
            $custommessage = [
                'email.required'    => 'Email is required!',
                'password.required' => 'Password is required!',
                'email.email'       => 'Please enter you email.',
            ];

            $validations = Validator::make($alldata, $rules, $custommessage);
            if($validations->fails()){
                return redirect()->back()->withInput()->withErrors($validations);
            }


            $email      = $request->email;
            $userinfo   = User::where('email',$email)->where('user_type', 'admin')->first();
            if ($userinfo && Hash::check($request->password, $userinfo->password)) {
               Auth::login($userinfo);
               return redirect('admin/dashboard');

            }else{
               return redirect()->back()->with('error', 'E-mail or password is invalid');
            }
           
         

        }else{
            return back()->withInput();
        }

    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('admin-login');
    }

}
