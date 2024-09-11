<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Coin;
use App\Models\User;
use App\Models\GenerationPlan;
use App\Models\Transaction;
use App\Models\IPOConBuy;
use Illuminate\Support\Str;

class IPOController extends Controller
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
    private $lavel_10   = 0;
    private $username    = "";
    private $Transaction = "";

    public function ipocoinbuy($id)
    {
        $data['userinfo']            = User::find(Auth::id());
        $data['coininfo']            = Coin::find($id);
        return view('users.ipo_con_buy', $data);
    }

    public function iconbuystore(Request $request)
    {

        $alldata = $request->all();
        $rules = [
            'quantity'              => 'required',
            'transation_pin'        => 'required',
        ];
        $custommessage = [
            'quantity.required'       => 'Quantity is required!',
            'transation_pin.required' => 'Transaction Pin is required!',
        ];

        $validations = Validator::make($alldata, $rules, $custommessage);
        if($validations->fails()){
            return redirect()->back()->withInput()->withErrors($validations);
        }

        $id                  = $request->id;
        $packageinfo         = Coin::find($id);
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



       
        $transfer_balance    = $userinfo->transfer_balance;
        $coin_rate           = $packageinfo->rate;
        $quantity            = $request->quantity;
        $total_amount        = $coin_rate * $quantity;
      

        if($transfer_balance >= $total_amount){

           $newtransation                   = new Transaction();
            $newtransation->debit_amount    = $total_amount;
            $newtransation->transaction     = Str::uuid();
            $newtransation->user_id         = Auth::id();
            $newtransation->payment_type    = "transfer";
            $newtransation->inoutstatus     = "purchase";
            $newtransation->note            = "IPO Coin Purchase";
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

            $investment                 = new IPOConBuy();
            $investment->user_id        = Auth::id();
            $investment->coin_rate      = $coin_rate;
            $investment->quantity       = $quantity;
            $investment->total_amount   = $total_amount;
            $investment->save();

            $this->amount               = $total_amount;
            $this->username             = $userinfo->email;

            if($userinfo->ref_id){
                $this->lavelone($userinfo->ref_id);
            }

           return redirect('dashboard')->with('success', 'IPO Product Purchasing done!');

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



}
