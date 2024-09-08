<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Withdrawal;
use App\Models\Investment;
use App\Models\TaxTable;
use App\Models\Transaction;

class AdminDashbaordController extends Controller
{
    public function index()
    {
        $data['totalusers']         = User::where('user_type', 'member')->count();
        $data['acctiveusers']       = User::where('status', 'Active')->where('user_type', 'member')->count();
        $data['currentblance']      = User::sum('transfer_balance');
      
        $data['geneationsum'] = Transaction::where('inoutstatus', 'Generation')
                                        ->sum('credit_amount');

         $data['rabitincome'] = Transaction::where('inoutstatus', 'daily')
                                        ->sum('credit_amount');
        $data['investment'] = Transaction::where('inoutstatus', 'purchase')
                                        ->sum('debit_amount');    
        $data['withdrawal'] = Transaction::where('inoutstatus', 'withdrawal')
                                        ->sum('debit_amount');                         
        $data['rankinsentamont'] = Transaction::where('inoutstatus', 'rank')
                                        ->sum('credit_amount');
        $data['salarymonth'] = Transaction::where('inoutstatus', 'salary')
                                        ->sum('credit_amount');

        $data['totaldeposit'] = Transaction::where('inoutstatus', 'admin')
                                        ->sum('credit_amount');

        return view('admin.dashbaord', $data);
    }
}
