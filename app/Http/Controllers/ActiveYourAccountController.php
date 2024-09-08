<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ActiveYourAccountController extends Controller
{

    private $amount   = 15;
    private $lavel_1  = 8;
    private $lavel_2  = 4;
    private $lavel_3  = 2;
    private $lavel_4  = 1;
    private $lavel_5  = 0.50;
    private $lavel_6  = 0.25;
    private $lavel_7  = 0.20;
    private $lavel_8  = 0.15;
    private $lavel_9  = 0.10;
    private $lavel_10 = 0.10;
    private $username = "";

    public function activeaccount()
    {
        $userinfo = User::find(Auth::id());
        if($userinfo->transfer_balance >= 10){

            $this->transaction($userinfo);

            $currrent = Transaction::Where('user_id', Auth::id())
                                        ->where('payment_type', 'transfer')
                                        ->selectRaw("SUM(credit_amount) as total_credit")
                                        ->selectRaw("SUM(debit_amount) as total_debit")
                                        ->groupBy('user_id')
                                        ->first();
            $userinfo->transfer_balance = $currrent->total_credit - $currrent->total_debit;
            $userinfo->status           = "Active";
            $userinfo->save();
            $this->username = $userinfo->email;
            if($userinfo->ref_id){
                $this->lavelone($userinfo->ref_id);
            }
            

            return redirect('dashboard')->with('success', 'Your account has been actived success!');

        }else{
            return redirect('dashboard')->with('error', 'Your balance not available!');
        }

    }


    private function transaction($user)
    {
        $newtransaction                = new Transaction();
        $newtransaction->user_id       = $user->id;
        $newtransaction->debit_amount  = 15;
        $newtransaction->transaction   = Str::uuid();
        $newtransaction->note          = "Account actived";
        $newtransaction->payment_type  = "transfer";
        $newtransaction->inoutstatus   = "actived";
        $newtransaction->amount_status = "paid";
        $newtransaction->withdraw_status = "Success";
        $newtransaction->tran_date       = date('Y-m-d');
        $newtransaction->save();
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



}
