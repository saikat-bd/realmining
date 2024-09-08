<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ComanyInfo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\CommissionFund;

class CompanyCommissionContrller extends Controller
{
    public function index()
    {
        $data['statment']   = CommissionFund::join('users', 'users.id', '=', 'commission_funds.user_id')
                                            ->select('commission_funds.*', 'users.name')
                                            ->paginate(20);
        return view('admin.commission_fund.index', $data);
    }


    public function form()
    {
         return view('admin.commission_fund.form');
    }

     public function store(Request $request)
    {
        $alldata = $request->all();
            $rules = [
                'amount'   => 'required',
            ];
            $custommessage = [
                
                'amount.required'           => 'Amount is required!',
            ];

            $validations = Validator::make($alldata, $rules, $custommessage);
            if($validations->fails()){
                return redirect()->back()->withInput()->withErrors($validations);
            }

            if($request->amount > 0){
                $newsave          = new CommissionFund();
                $newsave->user_id = Auth::id();
                $newsave->amount  = $request->amount;
                $newsave->note    = $request->note;
                $newsave->save();

                $comapnyinfo             = ComanyInfo::first();
                $comapnyinfo->out_invest = $comapnyinfo->out_invest + $request->amount;
                $comapnyinfo->save();

            }   
            
            return redirect('admin/companycommission/form')->with('success', 'success');
    }


}
