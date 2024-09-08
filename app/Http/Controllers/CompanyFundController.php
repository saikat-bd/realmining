<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanFund;
use App\Models\ComanyInfo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CompanyFundController extends Controller
{
    public function index()
    {
        return view('admin.company_funds.form');
    }


    public function statement()
    {
        $data['statment']   = CompanFund::join('users', 'users.id', '=', 'compan_funds.user_id')
                                        ->select('compan_funds.*', 'users.name')
                                        ->paginate(20);
        return view('admin.company_funds.index', $data);
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
                $newsave = new CompanFund();
                $newsave->user_id = Auth::id();
                $newsave->amount = $request->amount;
                $newsave->note   = $request->note;
                $newsave->save();

                $comapnyinfo = ComanyInfo::first();
                $comapnyinfo->com_invest = $comapnyinfo->com_invest + $request->amount;
                $comapnyinfo->save();

            }   
            
            return redirect('admin/companyfund/index')->with('success', 'success');
    }


}
