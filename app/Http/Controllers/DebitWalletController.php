<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Transaction;
use App\Models\Withdrawal;
use App\Models\TaxTable;
use App\Models\OTP;
use Illuminate\Support\Str;

class DebitWalletController extends Controller
{
    public function index()
    {
        $data['widthrawal'] = Withdrawal::where('user_id', Auth::id())->get();
        return view('users.withdrawal_report', $data);
    }
    
    public function debit_transfer()
    {
        $data['userinfo'] = User::find(Auth::id());
        return view('users.debit_transfer', $data);
    }
    
    public function withdrawal()
    {
        $data['userinfo'] = User::find(Auth::id());
        if($data['userinfo']->status == 'Inactive'){
            return redirect('dashboard');
        }
        return view('users.debit_withdrawal', $data);
    }



    public function debit_transferstore(Request $request)
    {
        if($request->isMethod('post')){
            $alldata = $request->all();
            $rules = [
                'amount'        => 'required',
                'transation_pin' => 'required',
            ];
            $custommessage = [
                'amount.required'       => 'Amount is required!',
                'transation_pin.required'=> 'Transaction PIN is required!',
            ];

            $validations = Validator::make($alldata, $rules, $custommessage);
            if($validations->fails()){
                return redirect()->back()->withInput()->withErrors($validations);
            }

            $amount         = $request->amount;
            $transation_pin = $request->transation_pin;
            $userinfo      = User::find(Auth::id());
            $transactionpin = $userinfo->transactionpin;
            $debit_balance  = $userinfo->debit_balance;
            if($debit_balance >= $amount){

            if($transation_pin == $transactionpin){

                $transerwal                 = new Transaction();
                $transerwal->user_id        = Auth::id();
                $transerwal->credit_amount  = $amount;
                $transerwal->transaction    = Str::uuid();
                $transerwal->note           = "Transfer from Debit Wallet";
                $transerwal->payment_type   = "transfer";
                $transerwal->inoutstatus    = "debit";
                $transerwal->tran_date      = date('Y-m-d');
                $transerwal->save();

                $currrent   = Transaction::Where('user_id', Auth::id())
                                        ->where('payment_type', 'transfer')
                                        ->selectRaw("SUM(credit_amount) as total_credit")
                                        ->selectRaw("SUM(debit_amount) as total_debit")
                                        ->groupBy('user_id')
                                        ->first();
                $userinfo->transfer_balance = $currrent->total_credit - $currrent->total_debit;
                $userinfo->save();


                $debittran                 = new Transaction();
                $debittran->user_id        = Auth::id();
                $debittran->debit_amount   = $amount;
                $debittran->transaction    = Str::uuid();
                $debittran->note           = "Debit Wallet to investment";
                $debittran->payment_type   = "debit";
                $debittran->inoutstatus    = "transfer";
                $debittran->tran_date      = date('Y-m-d');
                $debittran->save();

                $debitcurrrent   = Transaction::Where('user_id', Auth::id())
                                        ->where('payment_type', 'debit')
                                        ->where('amount_status', 'Paid')
                                        ->selectRaw("SUM(credit_amount) as total_credit")
                                        ->selectRaw("SUM(debit_amount) as total_debit")
                                        ->groupBy('user_id')
                                        ->first();
                $userinfo->debit_balance = $debitcurrrent->total_credit - $debitcurrrent->total_debit;
                $userinfo->save();
                return redirect('debit-to-transfer')->with('success', 'Debit wallet transfer success!'); 


            }else{

            return redirect('debit-to-transfer')->with('error', 'Transaction PIN is wrong!'); 

            }


            }else{
                return redirect('debit-to-transfer')->with('error', 'Debit balance not available'); 
            }




        }else{
              return redirect()->back();
        }



    }


    public function withdrawal_store(Request $request)
    {
        if($request->isMethod('post')){
            $alldata = $request->all();
            $rules = [
                'account_name'   => 'required',
                'binance_id'     => 'required',
                'amount'         => 'required',
                'transation_pin' => 'required',
            ];
            $custommessage = [
                'account_name.required'      => 'Account Name is required!',
                'binance_id.required'        => 'Wallet Address is required!',
                'amount.required'            => 'Amount is required!',
                'transation_pin.required'    => 'Transaction PIN is required!',
            ];

            $validations = Validator::make($alldata, $rules, $custommessage);
            if($validations->fails()){
                return redirect()->back()->withInput()->withErrors($validations);
            }

           

            $amount             = $request->amount;

            if($amount < 10){
               return redirect()->back()->withInput()->withErrors(array('amount' => 'Minimum $10.00 Amount!'));     
            }
           

            $transation_pin     = $request->transation_pin;
            $binance_id         = $request->binance_id;
            
            $userinfo           = User::find(Auth::id());
            $transactionpin     = $userinfo->transactionpin;
            $transfer_balance   = $userinfo->transfer_balance;

            $perchatnage        = $amount / 100 * 10;
            $total_cost         = $amount + $perchatnage;

            if($transfer_balance >= $total_cost){

            if($transation_pin == $transactionpin){


                $debittran                 = new Transaction();
                $debittran->user_id        = Auth::id();
                $debittran->debit_amount   = $total_cost;
                $debittran->transaction    = Str::uuid();
                $debittran->note           = "withdrawal service charge $". number_format($perchatnage, 2);
                $debittran->payment_type   = "transfer";
                $debittran->inoutstatus    = "withdrawal";
                $debittran->tran_date      = date('Y-m-d');
                $debittran->save();

                $debitcurrrent          = Transaction::Where('user_id', Auth::id())
                                        ->where('payment_type', 'transfer')
                                        ->selectRaw("SUM(credit_amount) as total_credit")
                                        ->selectRaw("SUM(debit_amount) as total_debit")
                                        ->groupBy('user_id')
                                        ->first();
                $userinfo->transfer_balance = $debitcurrrent->total_credit - $debitcurrrent->total_debit;
                $userinfo->save();
                //$tax_amount                = $amount / 100 * 5; 

                $withnew                    = new Withdrawal();
                $withnew->user_id           = Auth::id();
                $withnew->transaction_id    = $debittran->id;
                $withnew->account_name      = $request->account_name;
                $withnew->amount            = $amount;
                $withnew->binance_id        = $binance_id;
                $withnew->withdawal_date    = date('Y-m-d');
                $withnew->save();

                return redirect('debit-to-withdrawal')->with('success', 'Balance withdrawal successful waiting for admin approved!'); 


            }else{

            return redirect('debit-to-withdrawal')->with('error', 'Transaction PIN is wrong!'); 

            }


            }else{
                return redirect('debit-to-withdrawal')->with('error', 'Balance not available'); 
            }

        }else{
              return redirect()->back();
        }

    }


}
