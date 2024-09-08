<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\WalletAccount;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class WalletAccountController extends Controller
{
    public function index()
    {
        $data['packagte'] = WalletAccount::paginate(20);
        return view('admin.wallet_account.index', $data);
    }

    public function form()
    {
        return view('admin.wallet_account.form');     
    }

    public function edit($id)
    {
        $data['datainfo']   = WalletAccount::find($id);
        return view('admin.wallet_account.edit', $data);
    }

    public function store(Request $request)
    {
        $alldata = $request->all();
            $rules = [
                'accoount_name'   => 'required',
                'account_link'    => 'required',
            ];
            $custommessage = [
                'accoount_name.required'   => 'Account name is required!',
                'account_link.required'    => 'Wallet address is required!',
            ];

            $validations = Validator::make($alldata, $rules, $custommessage);
            if($validations->fails()){
                return redirect()->back()->withInput()->withErrors($validations);
            }

            $datasave = new WalletAccount();
            $datasave->accoount_name = $request->accoount_name;
            $datasave->account_link = $request->account_link;
            $datasave->save();

            return redirect('admin/settings/wallet-accounts')->with('success', 'success');
    }
     public function updated(Request $request, $id)
    {
         $alldata = $request->all();
             $rules = [
                'accoount_name'   => 'required',
                'account_link'    => 'required',
            ];
            $custommessage = [
                'accoount_name.required'   => 'Account name is required!',
                'account_link.required'    => 'Wallet address is required!',
            ];

            $validations = Validator::make($alldata, $rules, $custommessage);
            if($validations->fails()){
                return redirect()->back()->withInput()->withErrors($validations);
            }

            $datasave = WalletAccount::find($id);
            $datasave->accoount_name = $request->accoount_name;
            $datasave->account_link = $request->account_link;
            $datasave->save();
            return redirect('admin/settings/wallet-accounts')->with('success', 'success');
    }
}
