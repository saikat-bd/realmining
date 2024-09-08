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

class RoyaltyWalletController extends Controller
{
     public function index()
    {
        $data['userinfo'] = User::find(Auth::id());
        return view('users.royalty_wallet', $data);
    }

    public function royalty_transfer()
    {
        $data['userinfo'] = User::find(Auth::id());
        return view('users.royalty_transfer', $data);
    }
    
    public function royalty_debit()
    {
        $data['userinfo'] = User::find(Auth::id());
        return view('users.royalty_debit', $data);
    }

    public function transfer_store(Request $request)
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
            $earn_balance  = $userinfo->earn_balance;
            if($earn_balance >= $amount){

            $final_amount       = ($amount / 100) * 5; 

            if($transation_pin == $transactionpin){

                $transerwal                 = new Transaction();
                $transerwal->user_id        = Auth::id();
                $transerwal->credit_amount  = $amount - $final_amount;
                $transerwal->transaction    = Str::uuid();
                $transerwal->note           = "Transfer from Royalty Wallet";
                $transerwal->payment_type   = "transfer";
                $transerwal->inoutstatus    = "royalty";
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
                $debittran->note           = "Royalty Wallet to Transfer";
                $debittran->payment_type   = "royalty";
                $debittran->inoutstatus    = "transfer";
                $debittran->tran_date      = date('Y-m-d');
                $debittran->save();

                $debitcurrrent   = Transaction::Where('user_id', Auth::id())
                                        ->where('payment_type', 'royalty')
                                        ->selectRaw("SUM(credit_amount) as total_credit")
                                        ->selectRaw("SUM(debit_amount) as total_debit")
                                        ->groupBy('user_id')
                                        ->first();
                $userinfo->earn_balance = $debitcurrrent->total_credit - $debitcurrrent->total_debit;


                $taxoject = new TaxTable();
                $taxoject->user_id = Auth::id();
                $taxoject->tax_amount = $final_amount;
                $taxoject->note = "Tax collect from royalty";
                $taxoject->save();


                $userinfo->save();
                return redirect('royalty-to-transfer')->with('success', 'Royalty wallet transfer success!'); 


            }else{

            return redirect('royalty-to-transfer')->with('error', 'Transaction PIN is wrong!'); 

            }


            }else{
                return redirect('royalty-to-transfer')->with('error', 'Credit balance not available'); 
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
            if($amount < 20){
              return redirect()->back()->withInput()->withErrors(array('amount' => 'Minimum 20.00 Amount!'));   
            }


            $transation_pin = $request->transation_pin;
            $userinfo      = User::find(Auth::id());

            $transactionpin = $userinfo->transactionpin;
            $earn_balance  = $userinfo->earn_balance;
            if($earn_balance >= $amount){

            $final_amount       = ($amount / 100) * 5; 

            if($transation_pin == $transactionpin){

                $transerwal                 = new Transaction();
                $transerwal->user_id        = Auth::id();
                $transerwal->credit_amount  = $amount - $final_amount;
                $transerwal->transaction    = Str::uuid();
                $transerwal->note           = "Transfer from Royalty Wallet";
                $transerwal->payment_type   = "debit";
                $transerwal->inoutstatus    = "royalty";
                $transerwal->amount_status  = "Pending";
                $transerwal->tran_date      = date('Y-m-d');
                $transerwal->save();

                $debittran                 = new Transaction();
                $debittran->user_id        = Auth::id();
                $debittran->debit_amount   = $amount;
                $debittran->transaction    = Str::uuid();
                $debittran->note           = "Royalty Wallet to debit";
                $debittran->payment_type   = "royalty";
                $debittran->inoutstatus    = "debit";
                $debittran->tran_date      = date('Y-m-d');
                $debittran->save();

                $debitcurrrent   = Transaction::Where('user_id', Auth::id())
                                        ->where('payment_type', 'royalty')
                                        ->selectRaw("SUM(credit_amount) as total_credit")
                                        ->selectRaw("SUM(debit_amount) as total_debit")
                                        ->groupBy('user_id')
                                        ->first();
                $userinfo->earn_balance = $debitcurrrent->total_credit - $debitcurrrent->total_debit;
                $userinfo->save();

                $taxoject = new TaxTable();
                $taxoject->user_id = Auth::id();
                $taxoject->tax_amount = $final_amount;
                $taxoject->note = "Tax collect from royalty";
                $taxoject->save();


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
