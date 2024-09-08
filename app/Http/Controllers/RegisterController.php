<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Country;
use App\Models\User;
use App\Models\Activity;
use App\Models\Team;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerifay;
use App\Models\Transaction;
use App\Models\UserRank;
use App\Mail\WebMail;


class RegisterController extends Controller
{
    private $new_id = 0;
    private $linkstatus = "";

    public function index(Request $request)
    {
        $data['userinfo'] = User::where('wallet_address', $request->username)->first();
        $data['countrys'] = Country::orderBy('country_name', 'ASC')->get();
        return view('website.register', $data);
    }

    public function created_new_account()
    {
        $data['countrys'] = Country::orderBy('country_name', 'ASC')->get();
        return view('website.create_new_account', $data);
    }


    public function createaccountstore(Request $request)
    {
        if($request->isMethod('post')){
            $alldata = $request->all();
            $rules = [
                'email'             => 'required|email|unique:users',
                'first_name'        => 'required',
                'last_name'         => 'required',
                'phone_number'      => 'required',
                'country_id'        => 'required',
                'reference'          => 'required',
                'password'          => 'required|min:6',
                'confirm_password'  => 'required|same:password',
            ];
            $custommessage = [
                'first_name.required'       => 'First Name is required!',
                'last_name.required'        => 'Last Name is required!',
                'phone_number.required'     => 'Phone Number is required!',
                'country_id.required'       => 'Country is required!',
                'reference.required'        => 'Reference is required!',
                'password.required'         => 'Password is required!',
                'password.min'              => 'must be at least 6 characters in length!',
                'confirm_password.required' => 'Confirm password is required!',
                'confirm_password.same'     => 'password confirmation does not match!',
                'email.required'            => 'Email is required!',
                'email.unique'              => 'Email already in use!',
                'email.email'              => 'Email is invalid!',
            ];

            $validations = Validator::make($alldata, $rules, $custommessage);
            if($validations->fails()){
                return redirect()->back()->withInput()->withErrors($validations);
            }

            $referenceinfo = User::where('email', $request->reference)->where('user_type', 'member')->first();
            if(empty($referenceinfo)){
                return redirect()->back()->withInput()->withErrors(array('reference' => 'Refrence Email ID is wrong!'));
            }

          
    
            $newuser                          = new User();
            $newuser->ref_id                  = $referenceinfo->id;
            $newuser->first_name              = $request->first_name;
            $newuser->last_name               = $request->last_name;
            $newuser->name                    = $newuser->first_name.' '.$newuser->last_name;
            $newuser->phone_number            = $request->phone_number;
            $newuser->email                   = $request->email;
            $newuser->country_id              = $request->country_id;
            $newuser->username                = null;
            $newuser->status                  = "Inactive";
            $newuser->user_type               = "member";
            $newuser->password                = Hash::make($request->password);
            $newuser->wallet_address          = Str::random(40);
            $newuser->transfer_balance        = 5;
            $newuser->save();

            $this->teamadd($newuser->ref_id, $newuser->id);
            $this->rankusercheck();
            $newuser->password = $request->password;
           // Mail::to($newuser->email)->send(new WebMail($newuser));
            Auth::login($newuser);
            $this->transaction($newuser);   
            $saveactivity            = new Activity();
            $saveactivity->user_id   = $newuser->id;
            $saveactivity->ipaddress = $request->ip();
            $saveactivity->save();

           return redirect('dashboard');
        }

    }


    public function store(Request $request)
    {
        if($request->isMethod('post')){
            $alldata = $request->all();
            $rules = [
                'email'             => 'required|email|unique:users',
                'first_name'        => 'required',
                'last_name'         => 'required',
                'phone_number'      => 'required',
                'country_id'        => 'required',
                'reference'         => 'required',
                'password'          => 'required|min:6',
                'confirm_password'  => 'required|same:password',
            ];
            $custommessage = [
               
                'first_name.required'       => 'First Name is required!',
                'last_name.required'        => 'Last Name is required!',
                'phone_number.required'     => 'Phone Number is required!',
                'country_id.required'       => 'Country is required!',
                'reference.required'       => 'Reference is required!',
                'password.required'         => 'Password is required!',
                'password.min'              => 'must be at least 6 characters in length!',
                'confirm_password.required' => 'Confirm password is required!',
                'confirm_password.same'     => 'password confirmation does not match!',
                'email.required'            => 'Email is required!',
                'email.unique'              => 'Email already in use!',
                'email.email'              => 'Email is invalid!',
            ];

            $validations = Validator::make($alldata, $rules, $custommessage);
            if($validations->fails()){
                return redirect()->back()->withInput()->withErrors($validations);
            }

            $referenceinfo = User::where('email', $request->reference)->where('user_type', 'member')->first();
            if(empty($referenceinfo)){
                return redirect()->back()->withInput()->withErrors(array('reference' => 'Refrence Email ID is wrong!'));
            }

           // $this->linkstatus       = $position;
          
            $newuser                = new User();
            $newuser->ref_id        = $referenceinfo->id;
            $newuser->first_name    = $request->first_name;
            $newuser->last_name     = $request->last_name;
            $newuser->name          = $newuser->first_name.' '.$newuser->last_name;
            $newuser->phone_number  = $request->phone_number;
            $newuser->email         = $request->email;
            $newuser->country_id    = $request->country_id;
            $newuser->username      = null;
            $newuser->status        = "Inactive";
            $newuser->user_type     = "member";
            //$newuser->username      = $request->username;
            $newuser->password       = Hash::make($request->password);
            $newuser->wallet_address = Str::random(40);
            $newuser->transfer_balance= 5;
            $newuser->save();
            $this->teamadd($newuser->ref_id, $newuser->id);
           // $this->first_rank($newuser->ref_id);
            $this->rankusercheck();

            $newuser->password = $request->password;
           // Mail::to($newuser->email)->send(new WebMail($newuser));
            Auth::login($newuser);
            $this->transaction($newuser);
            $saveactivity            = new Activity();
            $saveactivity->user_id   = $newuser->id;
            $saveactivity->ipaddress = $request->ip();
            $saveactivity->save();

           return redirect('dashboard');
        }

    }


    private function transaction($user)
    {
        $newtransaction                = new Transaction();
        $newtransaction->user_id       = $user->id;
        $newtransaction->credit_amount = 5;
        $newtransaction->transaction   = Str::uuid();
        $newtransaction->note          = "Registration bonus";
        $newtransaction->payment_type  = "transfer";
        $newtransaction->inoutstatus   = "join";
        $newtransaction->amount_status = "paid";
        $newtransaction->withdraw_status = "Success";
        $newtransaction->tran_date       = date('Y-m-d');
        $newtransaction->save();
    }


    private function teamadd($team_id, $new_id)
    {
        $teamadd            = new Team();
        $teamadd->team_id   = $team_id;
        $teamadd->user_id   = $new_id;
        $teamadd->position  = 1;
        $teamadd->save();
        $userinfo = User::find($team_id);
        if($userinfo->ref_id){
            $this->sendteam($userinfo->ref_id, $new_id);
        }
    }
    
    private function sendteam($team_id, $new_id)
    {
        $teamadd            = new Team();
        $teamadd->team_id   = $team_id;
        $teamadd->user_id   = $new_id;
        $teamadd->position  = 2;
        $teamadd->save();

        $userinfo = User::find($team_id);
        if($userinfo->ref_id){
            $this->thirdteam($userinfo->ref_id, $new_id);
        }
     
    }

    private function thirdteam($team_id, $new_id)
    {
        $teamadd            = new Team();
        $teamadd->team_id   = $team_id;
        $teamadd->user_id   = $new_id;
        $teamadd->position  = 3;
        $teamadd->save();
        $userinfo = User::find($team_id);
        if($userinfo->ref_id){
            $this->fourteam($userinfo->ref_id, $new_id);
        }
     
    }
    
    private function fourteam($team_id, $new_id)
    {
        $teamadd            = new Team();
        $teamadd->team_id   = $team_id;
        $teamadd->user_id   = $new_id;
        $teamadd->position  = 4;
        $teamadd->save();

        $userinfo = User::find($team_id);
        if($userinfo->ref_id){
            $this->fiveteam($userinfo->ref_id, $new_id);
        }
     
    }


    private function fiveteam($team_id, $new_id)
    {
        $teamadd            = new Team();
        $teamadd->team_id   = $team_id;
        $teamadd->user_id   = $new_id;
        $teamadd->position  = 5;
        $teamadd->save();
       $userinfo = User::find($team_id);
        if($userinfo->ref_id){
            $this->sixteam($userinfo->ref_id, $new_id);
        }    
    }

    private function sixteam($team_id, $new_id)
    {
        $teamadd            = new Team();
        $teamadd->team_id   = $team_id;
        $teamadd->user_id   = $new_id;
        $teamadd->position  = 6;
        $teamadd->save();
        $userinfo = User::find($team_id);
        if($userinfo->ref_id){
            $this->seventeam($userinfo->ref_id, $new_id);
        }    
    }

    private function seventeam($team_id, $new_id)
    {
        $teamadd            = new Team();
        $teamadd->team_id   = $team_id;
        $teamadd->user_id   = $new_id;
        $teamadd->position  = 7;
        $teamadd->save();
        $userinfo = User::find($team_id);
        if($userinfo->ref_id){
            $this->eightteam($userinfo->ref_id, $new_id);
        }  
    }

    private function eightteam($team_id, $new_id)
    {
        $teamadd            = new Team();
        $teamadd->team_id   = $team_id;
        $teamadd->user_id   = $new_id;
        $teamadd->position  = 8;
        $teamadd->save();
        $userinfo = User::find($team_id);
        if($userinfo->ref_id){
            $this->nineteam($userinfo->ref_id, $new_id);
        }  
    }

    private function nineteam($team_id, $new_id)
    {
        $teamadd            = new Team();
        $teamadd->team_id   = $team_id;
        $teamadd->user_id   = $new_id;
        $teamadd->position  = 9;
        $teamadd->save();
        $userinfo = User::find($team_id);
        if($userinfo->ref_id){
            $this->tenteam($userinfo->ref_id, $new_id);
        }  
    }

    private function tenteam($team_id, $new_id)
    {
        $teamadd            = new Team();
        $teamadd->team_id   = $team_id;
        $teamadd->user_id   = $new_id;
        $teamadd->position  = 10;
        $teamadd->save();
    }



    public function sendemailcode(Request $request)
    {

        $alldata = $request->all();
            $rules = [
                'email'             => 'required|email',
            ];
            $custommessage = [
                
                'email.required'   => 'Email is required!',
                'email.email'      => 'Email is invalid!',
                
            ];

            $validations = Validator::make($alldata, $rules, $custommessage);
            if($validations->fails()){
               return json_encode('<strong style="color:red;">Email is invalid</strong>');
            }

        $code = Str::random(6);
        Mail::to($request->email)->send(new EmailVerifay($code));

        if( count(Mail::failures()) > 0 ) {

            return json_encode('<strong style="color:red;">Email is invalid</strong>');

        } else {

            return json_encode('<strong style="color:green;">Mail send success</strong>');
        }

       
    }


    private function rankusercheck()
    {
        $userlist = User::where('status', 'Active')->where('user_type', 'member')->orderBy('id', 'ASC')->get();
        foreach($userlist as $v)
        {
            $this->first_rank($v->id);
        }
    }


    private function first_rank($user_id)
    {

        $firstlavelids = Team::where('team_id', $user_id)->where('position', 1)->pluck('user_id');

        $rankinfo       = UserRank::where('user_id', $user_id)->first();
        


        if(count($firstlavelids) >= 20){

            if(empty($rankinfo)){
                $total_amount    = Transaction::whereIn('user_id', $firstlavelids)->where('inoutstatus', 'purchase')->sum('debit_amount');
                $downline_amount = Transaction::whereNotIn('user_id', $firstlavelids)->where('inoutstatus', 'purchase')->where('user_id', '>', $user_id)->sum('debit_amount');
                    if($total_amount >= 1000 && $downline_amount >= 2000){
                        $ranknew                    = new UserRank();
                        $ranknew->user_id           = $user_id;
                        $ranknew->rank_serial       = 1;
                        $ranknew->insentive_amount  = 100;
                        $ranknew->monthly_amount    = 0;
                        $ranknew->rank_name         = "Sales Executive";
                        $ranknew->save();

                        $trasaction                 = new Transaction();
                        $trasaction->user_id        = $user_id;
                        $trasaction->credit_amount  = 100;
                        $trasaction->transaction    = Str::uuid();
                        $trasaction->note           = "Sales executive Incentive";
                        $trasaction->payment_type   = "transfer";
                        $trasaction->inoutstatus    = "rank";
                        $trasaction->tran_date      = date('Y-m-d');
                        $trasaction->save();
                        $userinfo                   = User::find($user_id);
                        $debitcurrrent          = Transaction::Where('user_id', $user_id)
                                                ->where('payment_type', 'transfer')
                                                ->selectRaw("SUM(credit_amount) as total_credit")
                                                ->selectRaw("SUM(debit_amount) as total_debit")
                                                ->groupBy('user_id')
                                                ->first();
                        $userinfo->transfer_balance = $debitcurrrent->total_credit - $debitcurrrent->total_debit;
                        $userinfo->save();
                    }
            }else if($rankinfo->rank_serial == 1){
                $this->secendlavel($user_id);
            }else if($rankinfo->rank_serial == 2){
                $this->thirdlavel($user_id);
            }else if($rankinfo->rank_serial == 3){
                $this->fourlavel($user_id);
            }else if($rankinfo->rank_serial == 4){
                $this->fivelavel($user_id);
            }else if($rankinfo->rank_serial == 5){
                $this->sixellavel($user_id);
            }

        }
    }


    private function secendlavel($user_id)
    {
        $firstlavelids  = Team::where('team_id', $user_id)->where('position', 2)->pluck('user_id');
        $total_amount   = Transaction::whereIn('user_id', $firstlavelids)->where('inoutstatus', 'purchase')->sum('debit_amount');
        $trading_amount = Transaction::where('user_id', $user_id)->where('inoutstatus', 'purchase')->sum('debit_amount');
        
        if(count($firstlavelids) >= 50){
            if($total_amount >= 7000 && $trading_amount >= 200){
                $rankinfo                    = UserRank::where('user_id', $user_id)->first();
                $rankinfo->rank_serial       = 2;
                $rankinfo->insentive_amount  = 200;
                $rankinfo->monthly_amount    = 0;
                $rankinfo->rank_name         = "Silver Executive";
                $rankinfo->save();

                $trasaction                 = new Transaction();
                $trasaction->user_id        = $user_id;
                $trasaction->credit_amount  = 200;
                $trasaction->transaction    = Str::uuid();
                $trasaction->note           = "Silver Executive Incentive";
                $trasaction->payment_type   = "transfer";
                $trasaction->inoutstatus    = "rank";
                $trasaction->tran_date      = date('Y-m-d');
                $trasaction->save();
                $userinfo               = User::find($user_id);
                $debitcurrrent          = Transaction::Where('user_id', $user_id)
                                        ->where('payment_type', 'transfer')
                                        ->selectRaw("SUM(credit_amount) as total_credit")
                                        ->selectRaw("SUM(debit_amount) as total_debit")
                                        ->groupBy('user_id')
                                        ->first();
                $userinfo->transfer_balance = $debitcurrrent->total_credit - $debitcurrrent->total_debit;
                $userinfo->save();

            }
        }
    }


    private function thirdlavel($user_id)
    {
        $firstlavelids = Team::where('team_id', $user_id)->where('position', 3)->pluck('user_id');
        $total_amount = Transaction::whereIn('user_id', $firstlavelids)->where('inoutstatus', 'admin')->sum('debit_amount');
        $trading_amount = Transaction::where('user_id', $user_id)->where('inoutstatus', 'purchase')->sum('debit_amount');
        
        if(count($firstlavelids) >= 100){
            if($total_amount >= 17000 && $trading_amount >= 500){
                $rankinfo                    = UserRank::where('user_id', $user_id)->first();
                $rankinfo->rank_serial       = 3;
                $rankinfo->insentive_amount  = 500;
                $rankinfo->monthly_amount    = 0;
                $rankinfo->rank_name         = "Gold Executive";
                $rankinfo->save();

                $trasaction                 = new Transaction();
                $trasaction->user_id        = $user_id;
                $trasaction->credit_amount  = 500;
                $trasaction->transaction    = Str::uuid();
                $trasaction->note           = "Gold Executive Incentive";
                $trasaction->payment_type   = "transfer";
                $trasaction->inoutstatus    = "rank";
                $trasaction->tran_date      = date('Y-m-d');
                $trasaction->save();
                $userinfo               = User::find($user_id);
                $debitcurrrent          = Transaction::Where('user_id', $user_id)
                                        ->where('payment_type', 'transfer')
                                        ->selectRaw("SUM(credit_amount) as total_credit")
                                        ->selectRaw("SUM(debit_amount) as total_debit")
                                        ->groupBy('user_id')
                                        ->first();
                $userinfo->transfer_balance = $debitcurrrent->total_credit - $debitcurrrent->total_debit;
                $userinfo->save();

            }
        }
    }

    private function fourlavel($user_id)
    {
        //$firstlavelids = Team::where('team_id', $user_id)->where('position', 1)->pluck('user_id');

        $mintwogoldexitive = UserRank::where('user_id', '>', $user_id)->where('rank_serial', 3)->count();


        //$total_amount = Transaction::where('user_id', '>', $user_id)->where('inoutstatus', 'admin')->sum('credit_amount');
        $downlinetrading_amount = Transaction::where('user_id', '>', $user_id)->where('inoutstatus', 'purchase')->sum('debit_amount');
        $trading_amount = Transaction::where('user_id', $user_id)->where('inoutstatus', 'purchase')->sum('debit_amount');
        
        if($mintwogoldexitive >= 2){
            if($downlinetrading_amount >= 37000 && $trading_amount >= 2700){
                $rankinfo                    = UserRank::where('user_id', $user_id)->first();
                $rankinfo->rank_serial       = 4;
                $rankinfo->insentive_amount  = 1500;
                $rankinfo->monthly_amount    = 200;
                $rankinfo->rank_name         = "Diamond Executive";
                $rankinfo->save();

                $trasaction                 = new Transaction();
                $trasaction->user_id        = $user_id;
                $trasaction->credit_amount  = 1500;
                $trasaction->transaction    = Str::uuid();
                $trasaction->note           = "Diamond Executive Incentive";
                $trasaction->payment_type   = "transfer";
                $trasaction->inoutstatus    = "rank";
                $trasaction->tran_date      = date('Y-m-d');
                $trasaction->save();
                $userinfo               = User::find($user_id);
                $debitcurrrent          = Transaction::Where('user_id', $user_id)
                                        ->where('payment_type', 'transfer')
                                        ->selectRaw("SUM(credit_amount) as total_credit")
                                        ->selectRaw("SUM(debit_amount) as total_debit")
                                        ->groupBy('user_id')
                                        ->first();
                $userinfo->transfer_balance = $debitcurrrent->total_credit - $debitcurrrent->total_debit;
                $userinfo->save();

            }
        }
    }


    private function fivelavel($user_id)
    {
        //$firstlavelids = Team::where('team_id', $user_id)->where('position', 1)->pluck('user_id');

        $mintwogoldexitive = UserRank::where('user_id', '>', $user_id)->where('rank_serial', 4)->count();

        //$total_amount = Transaction::where('user_id', '>', $user_id)->where('inoutstatus', 'admin')->sum('credit_amount');
        $downlinetrading_amount = Transaction::where('user_id', '>', $user_id)->where('inoutstatus', 'purchase')->sum('debit_amount');
        $trading_amount = Transaction::where('user_id', $user_id)->where('inoutstatus', 'purchase')->sum('debit_amount');
        
        if($mintwogoldexitive >= 4){
            if($downlinetrading_amount >= 77000 && $trading_amount >= 7700){
                $rankinfo                    = UserRank::where('user_id', $user_id)->first();
                $rankinfo->rank_serial       = 5;
                $rankinfo->insentive_amount  = 4000;
                $rankinfo->monthly_amount    = 700;
                $rankinfo->rank_name         = "Marketing Director";
                $rankinfo->save();

                $trasaction                 = new Transaction();
                $trasaction->user_id        = $user_id;
                $trasaction->credit_amount  = 4000;
                $trasaction->transaction    = Str::uuid();
                $trasaction->note           = "Marketing Director Incentive";
                $trasaction->payment_type   = "transfer";
                $trasaction->inoutstatus    = "rank";
                $trasaction->tran_date      = date('Y-m-d');
                $trasaction->save();
                $userinfo               = User::find($user_id);
                $debitcurrrent          = Transaction::Where('user_id', $user_id)
                                        ->where('payment_type', 'transfer')
                                        ->selectRaw("SUM(credit_amount) as total_credit")
                                        ->selectRaw("SUM(debit_amount) as total_debit")
                                        ->groupBy('user_id')
                                        ->first();
                $userinfo->transfer_balance = $debitcurrrent->total_credit - $debitcurrrent->total_debit;
                $userinfo->save();

            }
        }
    }


    private function sixellavel($user_id)
    {
        $mintwogoldexitive = UserRank::where('user_id', '>', $user_id)->where('rank_serial', 5)->count();
        $firstlavelids = Team::where('team_id', $user_id)->where('position', 1)->count();
        //$total_amount = Transaction::where('user_id', '>', $user_id)->where('inoutstatus', 'admin')->sum('credit_amount');
       // $downlinetrading_amount = Transaction::where('user_id', '>', $user_id)->where('inoutstatus', 'purchase')->sum('debit_amount');
        $trading_amount = Transaction::where('user_id', $user_id)->where('inoutstatus', 'purchase')->sum('debit_amount');
        
        if($mintwogoldexitive >= 8){
            if($firstlavelids >= 50000 && $trading_amount >= 17700){
                $rankinfo                    = UserRank::where('user_id', $user_id)->first();
                $rankinfo->rank_serial       = 6;
                $rankinfo->insentive_amount  = 20000;
                $rankinfo->monthly_amount    = 2000;
                $rankinfo->rank_name         = "Global Director";
                $rankinfo->save();

                $trasaction                 = new Transaction();
                $trasaction->user_id        = $user_id;
                $trasaction->credit_amount  = 20000;
                $trasaction->transaction    = Str::uuid();
                $trasaction->note           = "Global Director Incentive";
                $trasaction->payment_type   = "transfer";
                $trasaction->inoutstatus    = "rank";
                $trasaction->tran_date      = date('Y-m-d');
                $trasaction->save();
                $userinfo               = User::find($user_id);
                $debitcurrrent          = Transaction::Where('user_id', $user_id)
                                        ->where('payment_type', 'transfer')
                                        ->selectRaw("SUM(credit_amount) as total_credit")
                                        ->selectRaw("SUM(debit_amount) as total_debit")
                                        ->groupBy('user_id')
                                        ->first();
                $userinfo->transfer_balance = $debitcurrrent->total_credit - $debitcurrrent->total_debit;
                $userinfo->save();

            }
        }
    }




}
