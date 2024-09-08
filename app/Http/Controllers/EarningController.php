<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Withdrawal;

class EarningController extends Controller
{
    public function index()
    {
        $data['totalincome'] = Transaction::Where('user_id', Auth::id())
                                        ->whereIn('payment_type', ['royalty','credit'])
                                        ->whereIn('inoutstatus', ['generation', 'daily'])
                                        ->get();
        return view('users.earning_history', $data);
    }

    public function investment_history()
    {
        $query = Transaction::Where('user_id', Auth::id());
        $query->where('inoutstatus', 'purchase');
        $data['history'] = $query->paginate(20);
        $data['subtitle'] = "Investment";
        return view('users.invest_history', $data);
    }


    public function total_earning()
    {
        $query = Transaction::Where('user_id', Auth::id());
        $query->whereIn('inoutstatus', ['daily', 'Generation', 'rank', 'salary']);
        $data['history'] = $query->paginate(20);
        $data['subtitle'] = "Total Earning";
        return view('users.invest_history', $data); 
    }

     public function withdrawl()
    {
        $query = Withdrawal::Where('user_id', Auth::id());
        $data['history'] = $query->paginate(20);
        $data['subtitle'] = "Withdrawal Report";
        return view('users.withdrawal_report', $data); 
    }




    public function daily_history()
    {
          $query = Transaction::Where('user_id', Auth::id());
        $query->where('inoutstatus', 'daily');
        $data['history'] = $query->paginate(20);
        $data['subtitle'] = "Daily Income";
        return view('users.invest_history', $data);  
    }
    
    public function generation_history()
    {
          $query = Transaction::Where('user_id', Auth::id());
        $query->where('inoutstatus', 'Generation');
        $data['history'] = $query->paginate(20);
        $data['subtitle'] = "Generation Income";
        return view('users.invest_history', $data);  
    } 
    
    public function incentive_history()
    {
          $query = Transaction::Where('user_id', Auth::id());
        $query->where('inoutstatus', 'rank');
        $data['history'] = $query->paginate(20);
        $data['subtitle'] = "Incentive Income";
        return view('users.invest_history', $data);  
    }

    public function salary_history()
    {
          $query = Transaction::Where('user_id', Auth::id());
        $query->where('inoutstatus', 'salary');
        $data['history'] = $query->paginate(20);
        $data['subtitle'] = "Total Salary";
        return view('users.invest_history', $data);  
    }



    public function history(Request $request)
    {
        $query = Transaction::Where('user_id', Auth::id());
                        if($request->tran_type){
                            $query->where('inoutstatus', $request->tran_type);
                        }
                        if($request->search)
                        {
                            $query->where('note', 'LIKE', "%{$request->search}%");
                        }
                        $query->orderBy('id', 'DESC');
        $data['history'] = $query->paginate(50);

        $title = "History";
    
        $data['subtitle'] = $title;
        return view('users.history', $data);
    }

}
