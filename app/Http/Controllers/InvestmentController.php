<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Investment;
use App\Models\Package;
use App\Models\User;
use App\Models\Transaction;
use App\Models\GenerationPlan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\ExclusivePlan;
use App\Models\ExclusivePlanBuy;
use App\Models\Team;
use App\Models\UserRank;

class InvestmentController extends Controller
{

    private $amount   = 0;
    private $lavel_1  = 0;
    private $lavel_2  = 0;
    private $lavel_3  = 0;
    private $lavel_4  = 0;
    private $lavel_5  = 0;
    private $lavel_6  = 0;
    private $lavel_7  = 0;
    private $lavel_8  = 0;
    private $lavel_9  = 0;
    private $lavel_10 = 0;
    private $username = "";



    public function investment_report()
    {
        $data['history'] = Investment::where('user_id', Auth::id())
                                      ->join('packages', 'packages.id', '=', 'investments.package_id')
                                      ->select('investments.*', 'packages.package_name')
                                      ->get();
        return view('users.investment-report', $data);
    }


    public function exclusive_plan()
    {
        $data['exlusiveplan'] = ExclusivePlan::all();
        return view('users.exlusive_plan', $data);
    }

    public function buyexclusiveplan($id)
    {
        $exclosiveplan = ExclusivePlan::find($id);
        $userinfo      = User::find(Auth::id());

        $plan_amount = $exclosiveplan->plan_amount;
        $mybalance   = $userinfo->transfer_balance;

        $generation          = GenerationPlan::first();

        $this->lavel_1       = $generation->lavel_1;
        $this->lavel_2       = $generation->lavel_2;
        $this->lavel_3       = $generation->lavel_3;
        $this->lavel_4       = $generation->lavel_4;
        $this->lavel_5       = $generation->lavel_5;
        $this->lavel_6       = $generation->lavel_6;
        $this->lavel_7       = $generation->lavel_7;
        $this->lavel_8       = $generation->lavel_8;
        $this->lavel_9       = $generation->lavel_9;
        $this->lavel_10      = $generation->lavel_10;
        $this->amount        = $plan_amount;


        if($mybalance >= $plan_amount){

            $newtransation                  = new Transaction();
            $newtransation->debit_amount    = $plan_amount;
            $newtransation->transaction     = Str::uuid();
            $newtransation->user_id         = Auth::id();
            $newtransation->payment_type    = "transfer";
            $newtransation->inoutstatus     = "exclusive";
            $newtransation->note            = "Exclusive plan purchasing";
            $newtransation->tran_date       = date('Y-m-d');
            $newtransation->save();
            $currrent = Transaction::Where('user_id', Auth::id())
                                        ->where('payment_type', 'transfer')
                                        ->selectRaw("SUM(credit_amount) as total_credit")
                                        ->selectRaw("SUM(debit_amount) as total_debit")
                                        ->groupBy('user_id')
                                        ->first();
            $userinfo->transfer_balance = $currrent->total_credit - $currrent->total_debit;
            $userinfo->save();

            $buyplan                = new ExclusivePlanBuy();
            $buyplan->user_id       = Auth::id();
            $buyplan->exclusive_id  = $id;
            $buyplan->buy_amount    = $plan_amount;
            $buyplan->save();

            if($userinfo->ref_id){
                $this->lavelone($userinfo->ref_id);
            }

            return redirect('dashboard')->with('success', 'Exclusive plan purchasing done!');




        }else{
            return redirect('dashboard')->with('error', 'Your balance not available');
        }

    }


    public function investment($id)
    {

      
        $packageinfo         = Package::find($id);
        $userinfo            = User::find(Auth::id());
        $generation          = GenerationPlan::first();
        $this->lavel_1       = $generation->lavel_1;
        $this->lavel_2       = $generation->lavel_2;
        $this->lavel_3       = $generation->lavel_3;
        $this->lavel_4       = $generation->lavel_4;
        $this->lavel_5       = $generation->lavel_5;
        $this->lavel_6       = $generation->lavel_6;
        $this->lavel_7       = $generation->lavel_7;
        $this->lavel_8       = $generation->lavel_8;
        $this->lavel_9       = $generation->lavel_9;
        $this->lavel_10      = $generation->lavel_10;

     
        $totalinvestcount = Investment::where('user_id', Auth::id())->where('package_id', $id)->count();
        if($totalinvestcount > 0){
                return redirect('dashboard')->with('error', 'Plan limit maximum 1 time investment');
        }
        


        $root_id             = $userinfo->root_id;
        $transfer_balance    = $userinfo->transfer_balance;
        $amount              = $packageinfo->amount;
        $rabit               = $packageinfo->rabit;
        $duraction           = $packageinfo->duraction;
        $dailyincome         = $packageinfo->rabit;

        if($transfer_balance >= $amount){

           $newtransation                   = new Transaction();
            $newtransation->debit_amount    = $amount;
            $newtransation->transaction     = Str::uuid();
            $newtransation->user_id         = Auth::id();
            $newtransation->payment_type    = "transfer";
            $newtransation->inoutstatus     = "purchase";
            $newtransation->note            = "Investment purchasing";
            $newtransation->tran_date       = date('Y-m-d');
            $newtransation->save();

            $currrent = Transaction::Where('user_id', Auth::id())
                                        ->where('payment_type', 'transfer')
                                        ->selectRaw("SUM(credit_amount) as total_credit")
                                        ->selectRaw("SUM(debit_amount) as total_debit")
                                        ->groupBy('user_id')
                                        ->first();
            $userinfo->transfer_balance = $currrent->total_credit - $currrent->total_debit;
            $userinfo->status           = "Active";
            $userinfo->save();

            $investment                 = new Investment();
            $investment->user_id        = Auth::id();
            $investment->package_id     = $id;
            $investment->invest_amount  = $amount;
            $investment->daily_rabit    = $dailyincome;
            $investment->days           = $duraction;
            $investment->invest_time    = date('H:i');
            $investment->updated_at     = date('Y-m-d H:i', strtotime('-1 day'));

            $investment->save();
            $this->amount               = $amount;
            $this->username             = $userinfo->email;

            if($userinfo->ref_id){
                $this->lavelone($userinfo->ref_id);
            }

            $this->rankusercheck();    
          //  $this->first_rank(Auth::id());
            

           return redirect('dashboard')->with('success', 'Investment plan purchasing done!');

        }else{
            return redirect('dashboard')->with('error', 'Your balance not available');
        }

    

    }

    private function lavelone($user_id)
    {
        $income                         = $this->amount / 100 * $this->lavel_1;

        $newtransation                  = new Transaction();
        $newtransation->credit_amount   = $income;
        $newtransation->transaction     = Str::uuid();
        $newtransation->user_id         = $user_id;
        $newtransation->payment_type    = "transfer";
        $newtransation->inoutstatus     = "Generation";
        $newtransation->note            = "1st Generation : ".$this->username;
        $newtransation->tran_date       = date('Y-m-d');
        $newtransation->save();

        $currrent = Transaction::Where('user_id', $user_id)
                                        ->where('payment_type', 'transfer')
                                        ->selectRaw("SUM(credit_amount) as total_credit")
                                        ->selectRaw("SUM(debit_amount) as total_debit")
                                        ->groupBy('user_id')
                                        ->first();
        $userinfo = User::find($user_id);
        $userinfo->transfer_balance = $currrent->total_credit - $currrent->total_debit;
        $userinfo->save();
        if($userinfo->ref_id){
            $this->lavelsend($userinfo->ref_id);
        }
        

    }

    private function lavelsend($user_id)
    {
        $income                         = $this->amount / 100 * $this->lavel_2;
        $newtransation                  = new Transaction();
        $newtransation->credit_amount   = $income;
        $newtransation->transaction     = Str::uuid();
        $newtransation->user_id         = $user_id;
        $newtransation->payment_type    = "transfer";
        $newtransation->inoutstatus     = "Generation";
        $newtransation->note            = "2nd Generation : ".$this->username;
        $newtransation->tran_date       = date('Y-m-d');
        $newtransation->save();

        $currrent = Transaction::Where('user_id', $user_id)
                                        ->where('payment_type', 'transfer')
                                        ->selectRaw("SUM(credit_amount) as total_credit")
                                        ->selectRaw("SUM(debit_amount) as total_debit")
                                        ->groupBy('user_id')
                                        ->first();
        $userinfo = User::find($user_id);
        $userinfo->transfer_balance = $currrent->total_credit - $currrent->total_debit;
        $userinfo->save();

        if($userinfo->ref_id){
            if($this->lavel_3 > 0){
                $this->lavelthird($userinfo->ref_id);
            }
            
        }

    }

    private function lavelthird($user_id)
    {
        $income                         = $this->amount / 100 * $this->lavel_3;
        $newtransation                  = new Transaction();
        $newtransation->credit_amount   = $income;
        $newtransation->transaction     = Str::uuid();
        $newtransation->user_id         = $user_id;
        $newtransation->payment_type    = "transfer";
        $newtransation->inoutstatus     = "Generation";
        $newtransation->note            = "3rd Generation : ".$this->username;
        $newtransation->tran_date       = date('Y-m-d');
        $newtransation->save();

        $currrent = Transaction::Where('user_id', $user_id)
                                        ->where('payment_type', 'transfer')
                                        ->selectRaw("SUM(credit_amount) as total_credit")
                                        ->selectRaw("SUM(debit_amount) as total_debit")
                                        ->groupBy('user_id')
                                        ->first();
        $userinfo = User::find($user_id);
        $userinfo->transfer_balance = $currrent->total_credit - $currrent->total_debit;
        $userinfo->save();

        if($userinfo->ref_id){
            if($this->lavel_4 > 0){
                $this->lavelfour($userinfo->ref_id);
            }
            
        }

    }

    private function lavelfour($user_id)
    {
        $income                         = $this->amount / 100 * $this->lavel_4;
        $newtransation                  = new Transaction();
        $newtransation->credit_amount   = $income;
        $newtransation->transaction     = Str::uuid();
        $newtransation->user_id         = $user_id;
        $newtransation->payment_type    = "transfer";
        $newtransation->inoutstatus     = "Generation";
        $newtransation->note            = "4th Generation : ".$this->username;
        $newtransation->tran_date       = date('Y-m-d');
        $newtransation->save();

        $currrent = Transaction::Where('user_id', $user_id)
                                        ->where('payment_type', 'transfer')
                                        ->selectRaw("SUM(credit_amount) as total_credit")
                                        ->selectRaw("SUM(debit_amount) as total_debit")
                                        ->groupBy('user_id')
                                        ->first();
        $userinfo = User::find($user_id);
        $userinfo->transfer_balance = $currrent->total_credit - $currrent->total_debit;
        $userinfo->save();

        if($userinfo->ref_id){
            if($this->lavel_5 > 0){
                $this->lavelfive($userinfo->ref_id);
            }
            
        }

    }

    private function lavelfive($user_id)
    {
        $income                         = $this->amount / 100 * $this->lavel_5;
        $newtransation                  = new Transaction();
        $newtransation->credit_amount   = $income;
        $newtransation->transaction     = Str::uuid();
        $newtransation->user_id         = $user_id;
        $newtransation->payment_type    = "transfer";
        $newtransation->inoutstatus     = "Generation";
        $newtransation->note            = "5th Generation : ".$this->username;
        $newtransation->tran_date       = date('Y-m-d');
        $newtransation->save();

        $currrent = Transaction::Where('user_id', $user_id)
                                        ->where('payment_type', 'transfer')
                                        ->selectRaw("SUM(credit_amount) as total_credit")
                                        ->selectRaw("SUM(debit_amount) as total_debit")
                                        ->groupBy('user_id')
                                        ->first();
        $userinfo = User::find($user_id);
        $userinfo->transfer_balance = $currrent->total_credit - $currrent->total_debit;
        $userinfo->save();

        if($userinfo->ref_id){
            if($this->lavel_6 > 0){
                 $this->lavelsix($userinfo->ref_id);
            }
           
        }

    }

     private function lavelsix($user_id)
    {
        $income                         = $this->amount / 100 * $this->lavel_6;
        $newtransation                  = new Transaction();
        $newtransation->credit_amount   = $income;
        $newtransation->transaction     = Str::uuid();
        $newtransation->user_id         = $user_id;
        $newtransation->payment_type    = "transfer";
        $newtransation->inoutstatus     = "Generation";
        $newtransation->note            = "6th Generation : ".$this->username;
        $newtransation->tran_date       = date('Y-m-d');
        $newtransation->save();

        $currrent = Transaction::Where('user_id', $user_id)
                                        ->where('payment_type', 'transfer')
                                        ->selectRaw("SUM(credit_amount) as total_credit")
                                        ->selectRaw("SUM(debit_amount) as total_debit")
                                        ->groupBy('user_id')
                                        ->first();
        $userinfo = User::find($user_id);
        $userinfo->transfer_balance = $currrent->total_credit - $currrent->total_debit;
        $userinfo->save();

        if($userinfo->ref_id){
            if($this->lavel_7 > 0){
                $this->lavelseven($userinfo->ref_id);
            }
            
        }

    }

     private function lavelseven($user_id)
    {
        $income                         = $this->amount / 100 * $this->lavel_7;
        $newtransation                  = new Transaction();
        $newtransation->credit_amount   = $income;
        $newtransation->transaction     = Str::uuid();
        $newtransation->user_id         = $user_id;
        $newtransation->payment_type    = "transfer";
        $newtransation->inoutstatus     = "Generation";
        $newtransation->note            = "7th Generation : ".$this->username;
        $newtransation->tran_date       = date('Y-m-d');
        $newtransation->save();

        $currrent = Transaction::Where('user_id', $user_id)
                                        ->where('payment_type', 'transfer')
                                        ->selectRaw("SUM(credit_amount) as total_credit")
                                        ->selectRaw("SUM(debit_amount) as total_debit")
                                        ->groupBy('user_id')
                                        ->first();
        $userinfo = User::find($user_id);
        $userinfo->transfer_balance = $currrent->total_credit - $currrent->total_debit;
        $userinfo->save();

        if($userinfo->ref_id){
            if($this->lavel_8 > 0){
                $this->laveleight($userinfo->ref_id);
            }
            
        }

    }

    private function laveleight($user_id)
    {
        $income                         = $this->amount / 100 * $this->lavel_8;
        $newtransation                  = new Transaction();
        $newtransation->credit_amount   = $income;
        $newtransation->transaction     = Str::uuid();
        $newtransation->user_id         = $user_id;
        $newtransation->payment_type    = "transfer";
        $newtransation->inoutstatus     = "Generation";
        $newtransation->note            = "8th Generation : ".$this->username;
        $newtransation->tran_date       = date('Y-m-d');
        $newtransation->save();

        $currrent = Transaction::Where('user_id', $user_id)
                                        ->where('payment_type', 'transfer')
                                        ->selectRaw("SUM(credit_amount) as total_credit")
                                        ->selectRaw("SUM(debit_amount) as total_debit")
                                        ->groupBy('user_id')
                                        ->first();
        $userinfo = User::find($user_id);
        $userinfo->transfer_balance = $currrent->total_credit - $currrent->total_debit;
        $userinfo->save();

        if($userinfo->ref_id){
            if($this->lavel_9 > 0){
                $this->lavelnine($userinfo->ref_id);
            }
            
        }

    }

    private function lavelnine($user_id)
    {
        $income                         = $this->amount / 100 * $this->lavel_9;
        $newtransation                  = new Transaction();
        $newtransation->credit_amount   = $income;
        $newtransation->transaction     = Str::uuid();
        $newtransation->user_id         = $user_id;
        $newtransation->payment_type    = "transfer";
        $newtransation->inoutstatus     = "Generation";
        $newtransation->note            = "9th Generation : ".$this->username;
        $newtransation->tran_date       = date('Y-m-d');
        $newtransation->save();

        $currrent = Transaction::Where('user_id', $user_id)
                                        ->where('payment_type', 'transfer')
                                        ->selectRaw("SUM(credit_amount) as total_credit")
                                        ->selectRaw("SUM(debit_amount) as total_debit")
                                        ->groupBy('user_id')
                                        ->first();
        $userinfo = User::find($user_id);
        $userinfo->transfer_balance = $currrent->total_credit - $currrent->total_debit;
        $userinfo->save();

        if($userinfo->ref_id){
            if($this->lavel_10 > 0){
                $this->lavelten($userinfo->ref_id);
            }
            
        }

    }

     private function lavelten($user_id)
    {
        $income                         = $this->amount / 100 * $this->lavel_10;
        $newtransation                  = new Transaction();
        $newtransation->credit_amount   = $income;
        $newtransation->transaction     = Str::uuid();
        $newtransation->user_id         = $user_id;
        $newtransation->payment_type    = "transfer";
        $newtransation->inoutstatus     = "Generation";
        $newtransation->note            = "10th Generation : ".$this->username;
        $newtransation->tran_date       = date('Y-m-d');
        $newtransation->save();

        $currrent = Transaction::Where('user_id', $user_id)
                                        ->where('payment_type', 'transfer')
                                        ->selectRaw("SUM(credit_amount) as total_credit")
                                        ->selectRaw("SUM(debit_amount) as total_debit")
                                        ->groupBy('user_id')
                                        ->first();
        $userinfo = User::find($user_id);
        $userinfo->transfer_balance = $currrent->total_credit - $currrent->total_debit;
        $userinfo->save();

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
        $firstlavelids = Team::where('team_id', $user_id)->where('position', 2)->pluck('user_id');
        $total_amount = Transaction::whereIn('user_id', $firstlavelids)->where('inoutstatus', 'purchase')->sum('debit_amount');
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
        $total_amount = Transaction::whereIn('user_id', $firstlavelids)->where('inoutstatus', 'purchase')->sum('debit_amount');
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
