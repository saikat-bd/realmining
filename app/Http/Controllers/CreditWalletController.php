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
use Illuminate\Support\Str;

class CreditWalletController extends Controller
{
    public function index()
    {
        $data['userinfo'] = User::find(Auth::id());
        return view('users.credit_wallet', $data);
    }
    
    public function credit_transfer()
    {
        $data['userinfo'] = User::find(Auth::id());
        return view('users.credit_transfer', $data);
    }
    
    public function credit_debit()
    {
        $data['userinfo'] = User::find(Auth::id());
        return view('users.credit_debit', $data);
    }  


    public function transferstore(Request $request)
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
            $credit_balance  = $userinfo->credit_balance;
            if($credit_balance >= $amount){

            $tax_amount       = $amount / 100 * 5;

            if($transation_pin == $transactionpin){

                $transerwal                 = new Transaction();
                $transerwal->user_id        = Auth::id();
                $transerwal->credit_amount  = $amount - $tax_amount;
                $transerwal->transaction    = Str::uuid();
                $transerwal->note           = "Transfer from Credit Wallet";
                $transerwal->payment_type   = "transfer";
                $transerwal->inoutstatus    = "credit";
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
                $debittran->note           = "Credit Wallet to investment";
                $debittran->payment_type   = "credit";
                $debittran->inoutstatus    = "transfer";
                $debittran->tran_date      = date('Y-m-d');
                $debittran->save();

                $debitcurrrent   = Transaction::Where('user_id', Auth::id())
                                        ->where('payment_type', 'credit')
                                        ->selectRaw("SUM(credit_amount) as total_credit")
                                        ->selectRaw("SUM(debit_amount) as total_debit")
                                        ->groupBy('user_id')
                                        ->first();
                $userinfo->credit_balance = $debitcurrrent->total_credit - $debitcurrrent->total_debit;
                $userinfo->save();



                $taxtable = new TaxTable();
                $taxtable->user_id = Auth::id();
                $taxtable->tax_amount = $tax_amount;
                $taxtable->note = "Credit to investment";
                $taxtable->save();



                return redirect('credit-to-transfer')->with('success', 'Credit wallet transfer success!'); 


            }else{

            return redirect('credit-to-transfer')->with('error', 'Transaction PIN is wrong!'); 

            }


            }else{
                return redirect('credit-to-transfer')->with('error', 'Credit balance not available'); 
            }




        }else{
              return redirect()->back();
        }


    }


    public function debit_store(Request $request)
    {
        if($request->isMethod('post')){
            $alldata = $request->all();
            $rules = [
                'amount'         => 'required',
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

            if($amount < 20){
                return redirect()->back()->withInput()->withErrors(array('amount' => 'Minimum 20.00 Amount!'));
            }


            $transation_pin = $request->transation_pin;
            $userinfo      = User::find(Auth::id());

            $transactionpin = $userinfo->transactionpin;
            $credit_balance  = $userinfo->credit_balance;

            if($credit_balance >= $amount){

            $tax_amount       = $amount / 100 * 5; 

            if($transation_pin == $transactionpin){

                $transerwal                 = new Transaction();
                $transerwal->user_id        = Auth::id();
                $transerwal->credit_amount  = $amount - $tax_amount;
                $transerwal->transaction    = Str::uuid();
                $transerwal->note           = "Transfer from Credit Wallet";
                $transerwal->payment_type   = "debit";
                $transerwal->inoutstatus    = "credit";
                $transerwal->amount_status  = "Pending";
                $transerwal->tran_date      = date('Y-m-d');
                $transerwal->save();


                $debittran                 = new Transaction();
                $debittran->user_id        = Auth::id();
                $debittran->debit_amount   = $amount;
                $debittran->transaction    = Str::uuid();
                $debittran->note           = "Credit Wallet to debit";
                $debittran->payment_type   = "credit";
                $debittran->inoutstatus    = "debit";
                $debittran->tran_date      = date('Y-m-d');
                $debittran->save();

                $debitcurrrent   = Transaction::Where('user_id', Auth::id())
                                        ->where('payment_type', 'credit')
                                        ->selectRaw("SUM(credit_amount) as total_credit")
                                        ->selectRaw("SUM(debit_amount) as total_debit")
                                        ->groupBy('user_id')
                                        ->first();
                $userinfo->credit_balance = $debitcurrrent->total_credit - $debitcurrrent->total_debit;
                $userinfo->save();

                $taxtable = new TaxTable();
                $taxtable->user_id = Auth::id();
                $taxtable->tax_amount = $tax_amount;
                $taxtable->note = "Credit to debit";
                $taxtable->save();


                return redirect('credit-to-debit')->with('success', 'Credit wallet to debit success!'); 


            }else{

            return redirect('credit-to-debit')->with('error', 'Transaction PIN is wrong!'); 

            }


            }else{
                return redirect('credit-to-debit')->with('error', 'Credit balance not available'); 
            }




        }else{
              return redirect()->back();
        }

    }


}
