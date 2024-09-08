<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Transaction;
use App\Models\Withdrawal;
use App\Models\WalletAccount;
use App\Models\TaxTable;
use App\Models\Deposit;
use App\Models\Investment;
use App\Models\Package;
use Illuminate\Support\Str;

class TransferWalletController extends Controller
{

    public function report()
    {
        $data['history'] = Transaction::where('user_id', Auth::id())
                                       ->where('inoutstatus', 'transfer')
                                       ->get();
        return view('users.transfer_report', $data);
    }


    public function deposit_report()
    {
        $data['history'] = Deposit::where('user_id', Auth::id())
                                       ->get();
        return view('users.deposit_report', $data);
    }


    public function index()
    {
        $data['userinfo'] = User::find(Auth::id());

        if($data['userinfo']->status == 'Inactive'){
            return redirect('dashboard');
        }

        return view('users.transfer_to_transfer', $data);
    }

    public function deposit()
    {
        $data['userinfo'] = User::find(Auth::id());
        $data['accounts'] = WalletAccount::all();
        return view('users.deposit', $data);  
    }

    

    public function investment()
    {
        $data['userinfo'] = User::find(Auth::id());
        $data['packages'] = Package::orderBy('amount', 'ASC')->where('package_status', 'public')->get();
        return view('users.investment', $data);
    }

    public function account_status()
    {
        $data['userinfo']   = User::find(Auth::id());
        $data['investment'] = Investment::where('user_id', Auth::id())
                                        ->join('packages', 'packages.id', '=', 'investments.package_id')
                                        ->select('investments.*', 'packages.package_name', 'packages.total_amount')
                                        ->first();
        $data['packages'] = Package::orderBy('amount', 'ASC')->get();
        return view('users.account_status', $data); 
    }


    public function depositstore(Request $request)
    {
        if($request->isMethod('post')){
            $alldata = $request->all();
            $rules = [
                'amount'                => 'required',
                'uploadfile'            => 'required|image',
            ];
            $custommessage = [
                'amount.required'       => 'Amount is required!',
                'uploadfile.required'   => 'Screenshot is required!',
                'uploadfile.image'      => 'Screenshot allow only image!',
            ];

            $validations = Validator::make($alldata, $rules, $custommessage);
            if($validations->fails()){
                return redirect()->back()->withInput()->withErrors($validations);
            }

            $amount         = $request->amount;
            $limit_amount   = 20;
            if($limit_amount > $amount){
                return redirect()->back()->withInput()->withErrors(array('amount' => 'Minimum 20.00 Amount!'));
            }


            $datasave               = new Deposit();
            $datasave->user_id      = Auth::id();
            $datasave->amount       = $request->amount;
            $imageName = time().'.'.$request->uploadfile->extension();
            $request->uploadfile->move(public_path('screenshot'), $imageName);
            $datasave->fileupload       = $imageName;
            $datasave->save();
            return redirect('deposit')->with('success', 'Deposit successful waiting for admin approved'); 
            

        }else{
              return redirect()->back();
        }


    }


    public function transferwalt(Request $request)
    {


        

        if($request->isMethod('post')){
            $alldata = $request->all();
            $rules = [
                'binance_id'     => 'required',
                'amount'         => 'required',
                'transation_pin' => 'required',
            ];
            $custommessage = [
                'binance_id.required'    => 'Email is required!',
                'amount.required'        => 'Amount is required!',
                'transation_pin.required'=> 'Transaction PIN is required!',
            ];

            $validations = Validator::make($alldata, $rules, $custommessage);
            if($validations->fails()){
                return redirect()->back()->withInput()->withErrors($validations);
            }
             $amount              = $request->amount;

             if($amount < 10){
                return redirect()->back()->withInput()->withErrors(array('amount' => 'Minimum transfer amount $10.00 USD'));
             }


            $binance_id          = $request->binance_id;
            $amount              = $request->amount;
            $transation_pin      = $request->transation_pin;
            $userinfo            = User::find(Auth::id());

            $transactionpin     = $userinfo->transactionpin;
            $transfer_balance   = $userinfo->transfer_balance;
            $touser = User::where('email', $binance_id)->where('id', '!=', Auth::id())->first();

            //$twoperchange = $request->amount / 100 * 5;
            $total_cost = $request->amount;

         
            if(!empty($touser)){
                if($transfer_balance >= $total_cost){


                if($transation_pin == $transactionpin){

                    $transerwal                 = new Transaction();
                    $transerwal->user_id        = Auth::id();
                    $transerwal->debit_amount   = $total_cost;
                    $transerwal->transaction    = Str::uuid();
                    $transerwal->note           = "Transfer to ".$touser->email;
                    $transerwal->payment_type   = "transfer";
                    $transerwal->inoutstatus    = "transfer";
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
                    $debittran->user_id        = $touser->id;
                    $debittran->credit_amount   = $request->amount;
                    $debittran->transaction    = Str::uuid();
                    $debittran->note           = "Received from ".$userinfo->email;
                    $debittran->payment_type   = "transfer";
                    $debittran->inoutstatus    = "user";
                    $debittran->tran_date      = date('Y-m-d');
                    $debittran->save();

                    $debitcurrrent   = Transaction::Where('user_id', $touser->id)
                                            ->where('payment_type', 'transfer')
                                            ->selectRaw("SUM(credit_amount) as total_credit")
                                            ->selectRaw("SUM(debit_amount) as total_debit")
                                            ->groupBy('user_id')
                                            ->first();
                    $touser->transfer_balance = $debitcurrrent->total_credit - $debitcurrrent->total_debit;
                    $touser->save();


                    return redirect('transfer-wallet')->with('success', 'Balance transfer successfull!'); 


                }else{

                return redirect('transfer-wallet')->with('error', 'Transaction PIN is wrong!'); 

                }


                }else{
                    return redirect('transfer-wallet')->with('error', 'Balance not available'); 
                }    
            }else{
                 return redirect('transfer-wallet')->with('error', 'Account No is wrong'); 
            }

            




        }else{
              return redirect()->back();
        }


    }

}
