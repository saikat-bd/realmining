<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ComanyInfo;
use App\Models\Transaction;
use App\Models\Withdrawal;
use App\Models\Deposit;
use App\Models\Investment;
use App\Models\Package;
use App\Models\TaxTable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Team;
use App\Models\UserRank;

class CustomerController extends Controller

{
    public function index(Request $request)
    {
                $query      = User::orderBy('id', 'asc')->with('referinfo');
                                $query->where('user_type', 'member');

                                if($request->search){
                                $query->where('users.username','LIKE',"%{$request->search}%");
                                $query->orWhere('users.name','LIKE',"%{$request->search}%");
                                $query->orWhere('users.email','LIKE',"%{$request->search}%");
                                 }
                            if($request->form_date){
                                $query->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->form_date)));
                            }
                             if($request->to_date){
                                $query->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->to_date)));
                            }
                    $data['users'] = $query->paginate(20);
        return view('admin.users.index', $data);
    }

    public function activemember(Request $request)
    {
                $query      = User::orderBy('id', 'asc')->with('referinfo');
                                $query->where('user_type', 'member');
                                $query->where('status', 'Active');

                                if($request->search){
                                $query->where('users.username','LIKE',"%{$request->search}%");
                                $query->orWhere('users.name','LIKE',"%{$request->search}%");
                                $query->orWhere('users.email','LIKE',"%{$request->search}%");
                                 }
                            if($request->form_date){
                                $query->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->form_date)));
                            }
                             if($request->to_date){
                                $query->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->to_date)));
                            }
                    $data['users'] = $query->paginate(20);
        return view('admin.users.acitvemember', $data);
    }

    

    public function custoermlogin($id)
    {
        $userinfo = User::find($id);
        Auth::login($userinfo);
        return redirect('dashboard');
    }


    public function rank(Request $request)
    {
        $data['usernaks'] = UserRank::join('users', 'users.id', '=', 'user_ranks.user_id')
                                ->select('user_ranks.*', 'users.name', 'users.username')
                                ->orderBy('rank_serial', 'ASC')
                                ->get();
        return view('admin.users.ranking', $data);
    }

    public function edit($id)
    {
        $data['datainfo']   = User::find($id);
        return view('admin.users.edit', $data); 
    }


    public function update(Request $request, $id)
    {


        if($request->change_email){
            $userinfo = User::where('email', $request->change_email)->first();
            if($userinfo){
                return redirect('admin/customer/edit')->with('error', 'Email already in use');
            }
        }


        $user = User::find($id);
        $user->payment_lock = $request->payment_lock;
        $user->transactionpin = $request->transactionpin;
        if($request->new_password){
        $user->password       = Hash::make($request->new_password);
        }

        if($request->change_email){
        $user->email = $request->change_email;
        }
        $user->save();

        return redirect('admin/customer/index')->with('success', 'Data has been updated success!');
    }


    public function transfer()
    {
        return view('admin.transfer.form');
    }

    public function royalty_tran()
    {
        return view('admin.transfer.royalty'); 
    }


    public function withdrawal(Request $request)
    {
        $query = Withdrawal::where('withdrawals.status','Pending')
                                        ->join('users', 'users.id', '=', 'withdrawals.user_id')
                                        ->select('users.name', 'users.email', 'users.username', 'withdrawals.*');
                        if($request->search){
                            $query->where('users.username','LIKE',"%{$request->search}%");
                            $query->orWhere('users.name','LIKE',"%{$request->search}%");
                            $query->orWhere('users.email','LIKE',"%{$request->search}%");
                                }
                        if($request->form_date){
                            $query->whereDate('withdrawals.created_at', '>=', date('Y-m-d', strtotime($request->form_date)));
                        }
                            if($request->to_date){
                            $query->whereDate('withdrawals.created_at', '<=', date('Y-m-d', strtotime($request->to_date)));
                        }


        $data['withdrawal']         = $query->get();




        return view('admin.customer.withdrawal', $data);
    }
    public function deposit()
    {
        $data['deposits'] = Deposit::where('deposits.deposit_status','Pending')
                                        ->join('users', 'users.id', '=', 'deposits.user_id')
                                        ->select('users.name', 'users.email', 'users.username', 'users.wallet_address', 'deposits.*')
                                        ->get();
        return view('admin.customer.deposit', $data);  
    }

    public function withdrawal_paid($id)
    {
        $withdawl = Withdrawal::find($id);
        $withdawl->status = "Paid";
        $withdawl->save();

        $transaction = Transaction::find($withdawl->transaction_id);
        $transaction->withdraw_status = "Success";
        $transaction->save();

        return redirect('admin/customer/withdrawal')->with('success', 'Withdrawal paid success');
    }


    public function withdrawal_reject($id)
    {
        $withdawl       = Withdrawal::find($id);

        $user_id        = $withdawl->user_id;
        $transaction_id = $withdawl->transaction_id;
        $transtion      = Transaction::find($transaction_id);
        if($transtion){
            $transtion->delete();
        }

        $credit_amount = Transaction::where('user_id', $user_id)->where('payment_type', 'transfer')->sum('credit_amount');
        $debit_amount  = Transaction::where('user_id', $user_id)->where('payment_type', 'transfer')->sum('debit_amount');
                                        
        $userinfo                   = User::find($user_id);
        $userinfo->transfer_balance = $credit_amount - $debit_amount;
        $userinfo->save();
        $withdawl->delete();
        return redirect('admin/customer/withdrawal')->with('success', 'Withdrawal rejected success');
    }


    public function deposit_paid($id)
    {
        $deposit = Deposit::find($id);
        
        $comapnyinfo     = ComanyInfo::first();
        if($deposit->deposit_status == 'Pending'){

            if($comapnyinfo->com_invest >= $deposit->amount){
                $comapnyinfo->com_invest = $comapnyinfo->com_invest - $deposit->amount;
                $comapnyinfo->save();
                $this->useraddblance($deposit->user_id, $deposit->amount);
                $deposit->deposit_status = "Paid";
                $deposit->save();
                $this->first_rank($deposit->user_id);

            }else{
                return redirect()->back()->withInput()->with('error', 'Balance is not available'); 
            }
            
        }


        return redirect('admin/customer/deposit')->with('success', 'Deposit paid success');
    }

    private function useraddblance($user_id, $amount)
    {
        $newtransation                  = new Transaction();
        $newtransation->credit_amount   = $amount;
        $newtransation->transaction     = Str::uuid();
        $newtransation->user_id         = $user_id;
        $newtransation->payment_type    = "transfer";
        $newtransation->inoutstatus     = "admin";
        $newtransation->note            = "Received from admin";
        $newtransation->tran_date       = date('Y-m-d');
        $newtransation->save();
        $currrent                       = Transaction::Where('user_id', $user_id)
                                        ->where('payment_type', 'transfer')
                                        ->selectRaw("SUM(credit_amount) as total_credit")
                                        ->selectRaw("SUM(debit_amount) as total_debit")
                                        ->groupBy('user_id')
                                        ->first();
        $userinfo                   = User::find($user_id);
        $userinfo->transfer_balance = $currrent->total_credit - $currrent->total_debit;
        $userinfo->save();

    }

    
    public function deposit_rejected($id)
    {
        $deposit = Deposit::find($id);
        $deposit->deposit_status = "Rejected";
        $deposit->save();
        return redirect('admin/customer/deposit')->with('success', 'Deposit Rejected success');
    }


    public function transfer_report(Request $request)
    {
        $query = Transaction::where('inoutstatus', 'admin')
                            ->join('users', 'users.id', '=', 'transactions.user_id')
                            ->select('users.name', 'users.email', 'users.username',  'transactions.*');
                            if($request->search){
                                $query->where('users.name','LIKE',"%{$request->search}%");
                                $query->orWhere('users.email','LIKE',"%{$request->search}%");
                            }
                            if($request->form_date){
                                $query->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->form_date)));
                            }
                             if($request->to_date){
                                $query->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->to_date)));
                            }

        $data['withdrawal'] = $query->paginate(20);
        return view('admin.customer.transfer_report', $data);

    }


    public function troyalty_report(Request $request)
    {
        $query = Transaction::where('inoutstatus', 'salary')
                            ->join('users', 'users.id', '=', 'transactions.user_id')
                            ->select('users.name', 'users.email', 'users.username',  'transactions.*');
                            if($request->search){
                                $query->where('users.name','LIKE',"%{$request->search}%");
                                $query->orWhere('users.email','LIKE',"%{$request->search}%");
                            }
                            if($request->form_date){
                                $query->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->form_date)));
                            }
                             if($request->to_date){
                                $query->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->to_date)));
                            }

        $data['withdrawal'] = $query->paginate(20);
        return view('admin.customer.royality_report', $data);
    }


     public function tax_report(Request $request)
    {
        $query = TaxTable::join('users', 'users.id', '=', 'tax_tables.user_id')
                            ->select('users.name', 'users.email',  'tax_tables.*');
                            if($request->form_date){
                                $query->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->form_date)));
                            }
                             if($request->to_date){
                                $query->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->to_date)));
                            }

        $data['withdrawal'] = $query->paginate(20);
        return view('admin.customer.tax_report', $data);

    }



    public function invstment_report(Request $request)
    {
        $query = Investment::join('users', 'users.id', '=', 'investments.user_id')
                            ->join('packages', 'packages.id', '=', 'investments.package_id')
                            ->orderBy('investments.updated_at', 'DESC')
                            ->where('days', '>', 0)
                            ->select('users.name', 'users.email', 'users.username', 'packages.package_name', 'investments.*');
                            if($request->package_id)
                            {
                                $query->where('investments.package_id', $request->package_id);
                            }
                            if($request->search){
                                $query->where('users.name','LIKE',"%{$request->search}%");
                                $query->orWhere('users.username','LIKE',"%{$request->search}%");
                                $query->orWhere('users.email','LIKE',"%{$request->search}%");
                            }
                            if($request->form_date){
                                $query->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->form_date)));
                            }
                             if($request->to_date){
                                $query->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->to_date)));
                            }

        $data['withdrawal'] = $query->paginate(20);
        $data['packages']   = Package::all();
        return view('admin.customer.investment_report', $data);
    }


    public function income_report(Request $request)
    {
         $query = Transaction::where('inoutstatus', 'daily')
                            ->join('users', 'users.id', '=', 'transactions.user_id')
                            ->select('users.name', 'users.email', 'users.username',  'transactions.*');
                            if($request->search){
                                $query->where('users.username','LIKE',"%{$request->search}%");
                                $query->orWhere('users.name','LIKE',"%{$request->search}%");
                                $query->orWhere('users.email','LIKE',"%{$request->search}%");
                            }
                            if($request->form_date){
                                $query->whereDate('transactions.created_at', '>=', date('Y-m-d', strtotime($request->form_date)));
                            }
                             if($request->to_date){
                                $query->whereDate('transactions.created_at', '<=', date('Y-m-d', strtotime($request->to_date)));
                            }
                            $query->orderBy('transactions.id', 'DESC');

        if($request->form_date){
            $data['transaction'] = $query->paginate(500);
        }else{
            $data['transaction'] = $query->paginate(50);
        }
        

        return view('admin.customer.income_report', $data);
    }



    public function deposit_report(Request $request)
    {
        $query = Deposit::whereIn('deposits.deposit_status', ['Paid', 'Rejected'])
                                        ->join('users', 'users.id', '=', 'deposits.user_id')
                                        ->select('users.name', 'users.username', 'users.email', 'deposits.*');
                            if($request->search){
                                $query->where('users.name','LIKE',"%{$request->search}%");
                                $query->orWhere('users.email','LIKE',"%{$request->search}%");
                            }
                            if($request->form_date){
                                $query->whereDate('created_at', '>=', date('Y-m-d', strtotime($request->form_date)));
                            }
                             if($request->to_date){
                                $query->whereDate('created_at', '<=', date('Y-m-d', strtotime($request->to_date)));
                            }

        $data['withdrawal'] = $query->paginate(20);

        return view('admin.customer.deposit_report', $data);

    }


    public function withdrawal_report(Request $request)
    {
        $query = Withdrawal::where('withdrawals.status','Paid')
                                        ->join('users', 'users.id', '=', 'withdrawals.user_id')
                                        ->select('users.name', 'users.email', 'users.username', 'withdrawals.*');
                            if($request->search){
                                $query->where('users.name','LIKE',"%{$request->search}%");
                                $query->orWhere('users.email','LIKE',"%{$request->search}%");
                            }
                            if($request->form_date){
                                $query->where('withdawal_date', '>=', date('Y-m-d', strtotime($request->form_date)));
                            }
                             if($request->to_date){
                                $query->where('withdawal_date', '<=', date('Y-m-d', strtotime($request->to_date)));
                            }

        $data['withdrawal'] = $query->paginate(20);

        return view('admin.customer.withdrawal_report', $data);
    }


    public function royalitystore(Request $request)
    {
        $alldata = $request->all();
            $rules = [
                'email'   => 'required',
                'amount'  => 'required',
            ];
            $custommessage = [
                
                'email.required'            => 'Account No is required!',
                'amount.required'           => 'Amount is required!',
            ];

            $validations = Validator::make($alldata, $rules, $custommessage);
            if($validations->fails()){
                return redirect()->back()->withInput()->withErrors($validations);
            }


            $userinfo = User::where('username', $request->email)->first();

            if($userinfo){
                if($request->amount > 0){

                    // $comapnyinfo = ComanyInfo::first();


                    $newtransation                  = new Transaction();
                    $newtransation->credit_amount   = $request->amount;
                    $newtransation->transaction     = Str::uuid();
                    $newtransation->user_id         = $userinfo->id;
                    $newtransation->payment_type    = "transfer";
                    $newtransation->inoutstatus     = "salary";
                    $newtransation->note            = $request->note;
                    $newtransation->tran_date       = date('Y-m-d');
                    $newtransation->save();

                    $currrent = Transaction::Where('user_id', $userinfo->id)
                                        ->where('payment_type', 'transfer')
                                        ->selectRaw("SUM(credit_amount) as total_credit")
                                        ->selectRaw("SUM(debit_amount) as total_debit")
                                        ->groupBy('user_id')
                                        ->first();
                    $userinfo->transfer_balance = $currrent->total_credit - $currrent->total_debit;
                    $userinfo->save();

                    return redirect('admin/customer/royalty-transfer')->with('success', 'success');




                }
            }else{
                return redirect()->back()->withInput()->with('error', 'Account no is wrong'); 
            }


    
            return redirect('admin/customer/royalty-transfer')->with('success', 'success');

    }


    public function transferstore(Request $request)
    {

        

            $alldata = $request->all();
            $rules = [
                'email'   => 'required',
                'amount'  => 'required',
            ];
            $custommessage = [
                
                'email.required'            => 'Email ID  is required!',
                'amount.required'           => 'Amount is required!',
            ];

            $validations = Validator::make($alldata, $rules, $custommessage);
            if($validations->fails()){
                return redirect()->back()->withInput()->withErrors($validations);
            }


            $userinfo = User::where('email', $request->email)->first();

            if($userinfo){
                if($request->amount > 0){

                $comapnyinfo = ComanyInfo::first();

                if($comapnyinfo->com_invest >= $request->amount){

                    $comapnyinfo->com_invest = $comapnyinfo->com_invest - $request->amount;
                    $comapnyinfo->save();

                    $newtransation                  = new Transaction();
                    $newtransation->credit_amount   = $request->amount;
                    $newtransation->transaction     = Str::uuid();
                    $newtransation->user_id         = $userinfo->id;
                    $newtransation->payment_type    = "transfer";
                    $newtransation->inoutstatus     = "admin";
                    $newtransation->note            = "Received from admin";
                    $newtransation->tran_date       = date('Y-m-d');
                    $newtransation->save();

                    $currrent = Transaction::Where('user_id', $userinfo->id)
                                        ->where('payment_type', 'transfer')
                                        ->selectRaw("SUM(credit_amount) as total_credit")
                                        ->selectRaw("SUM(debit_amount) as total_debit")
                                        ->groupBy('user_id')
                                        ->first();
                    $userinfo->transfer_balance = $currrent->total_credit - $currrent->total_debit;
                    $userinfo->save();

                    $this->first_rank($userinfo->id);



                    return redirect('admin/customer/transfer')->with('success', 'success');


                }else{
                    return redirect()->back()->withInput()->with('error', 'Balance is not available'); 
                }

                


                }
            }else{
                return redirect()->back()->withInput()->with('error', 'Your email is wrong'); 
            }

            


            
            return redirect('admin/customer/transfer')->with('success', 'success');
    }


    private function first_rank($user_id)
    {

        $firstlavelids = Team::where('team_id', $user_id)->where('position', 1)->pluck('user_id');
        $rankinfo       = UserRank::where('user_id', $user_id)->first();
        
        if(count($firstlavelids) >= 20){

            if(empty($rankinfo)){
                $total_amount = Transaction::whereIn('user_id', $firstlavelids)->where('inoutstatus', 'purchase')->sum('debit_amount');
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
                        $trasaction->note           = "Sales Executive Incentive";
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
        $total_amount = Transaction::whereIn('user_id', $firstlavelids)->where('inoutstatus', 'admin')->sum('credit_amount');
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
        $total_amount = Transaction::whereIn('user_id', $firstlavelids)->where('inoutstatus', 'admin')->sum('credit_amount');
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
