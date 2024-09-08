<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\ForgotPassword as Forgotmodelmodel;
use Illuminate\Http\Request;
use App\Mail\ForgotPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function index()
    {
         return view('website.forgot_password');
    }


    public function generated_password(Request $request)
    {
         return view('website.password_generated');
    }


    public function generatedpassword(Request $request)
    {
        if($request->isMethod('post')){
            $alldata = $request->all();
            $rules = [
                'password'          => 'required|min:6',
                'confirm_password'  => 'required|same:password',
            ];
            $custommessage = [
                'password.required'         => 'Password is required!',
                'password.min'              => 'must be at least 6 characters in length!',
                'confirm_password.required' => 'Confirm password is required!',
                'confirm_password.same'     => 'password confirmation does not match!',
            ];

            $validations = Validator::make($alldata, $rules, $custommessage);
            if($validations->fails()){
                return redirect()->back()->withInput()->withErrors($validations);
            }

            $tokengeneated = Forgotmodelmodel::where('token', $request->token)->first();
            if(empty($tokengeneated)){
                return redirect('forgot-password')->with('error', 'Token expired!');
            }
            $userinfo                 = User::find($tokengeneated->user_id);
            $userinfo->password       = Hash::make($request->password);
            $userinfo->save();

            Forgotmodelmodel::where('email', $tokengeneated->email)->delete();


          return redirect('auth')->with('success', 'New password created successfull?');

        }

    }


    public function forgot(Request $request)
    {
        if($request->isMethod('post')){
            $alldata = $request->all();
            $rules = [
                'email'             => 'required',
            ];
            $custommessage = [
                'email.required'            => 'Email or account no is required!',
            ];

            $validations = Validator::make($alldata, $rules, $custommessage);
            if($validations->fails()){
                return redirect()->back()->withInput()->withErrors($validations);
            }

            $userinfo = User::where('email', $request->email)->orWhere('username', $request->email)->first();
            if(empty($userinfo)){
                 return redirect()->back()->withInput()->with('error', 'Email or account no  is wrong!');
            }

            $newobject               =  new Forgotmodelmodel();
            $newobject->user_id      = $userinfo->id;
            $newobject->email        = $request->email;
            $newobject->token        = Str::random(150);
            $newobject->ip_address   = $request->ip();
            $newobject->save();
            $newobject->name         = $userinfo->name;
            Mail::to($request->email)->send(new ForgotPassword($newobject));

            return redirect('forgot-password')->with('success', 'Please check you mail..');

        }
    }



}
