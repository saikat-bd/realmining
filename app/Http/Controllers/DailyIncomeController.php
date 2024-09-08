<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Investment;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\GenerationPlan;




class DailyIncomeController extends Controller
{
    

     private $amount  =0;
    private $lavel_1  = 0;
    private $lavel_2 = 0;
    private $lavel_3 = 0;
    private $lavel_4 = 0;
    private $lavel_5 = 0;
    private $lavel_6 = 0;
    private $lavel_7 = 0;
    private $lavel_8 = 0;
    private $lavel_9 = 0;
    private $lavel_10 = 0;
    private $username = "";


   


    public function dailyincome()
    {

            exit();
            
            $dayname             =  date("D");
            $generation          = GenerationPlan::first();
            $this->lavel_1       = $generation->lavel_1;
            $this->lavel_2       = $generation->lavel_2;
            $this->lavel_3       = $generation->lavel_3;
            $this->lavel_4       = $generation->lavel_4;
            $this->lavel_5       = $generation->lavel_5;
            $this->lavel_6       = $generation->lavel_6;
            $this->lavel_7       = $generation->lavel_7;
            $this->lavel_8       = $generation->lavel_8;
            $this->lavel_9       = $generation->lavel_9;
            $this->lavel_10      = $generation->lavel_10;
       
            $today      = date('Y-m-d', strtotime('-1 day'));
           
             $ivestids = Transaction::where('inoutstatus', 'daily')->where('tran_date', date('Y-m-d'))->pluck('invenst_id')->toArray();

             $investment = Investment::whereDate('updated_at', '<', $today)
                                    ->whereTime('invest_time', '<=', date('H:i'))
                                    ->where('days', '>', 0)
                                    ->whereNotIn('id', $ivestids)
                                    ->get();
            foreach($investment as $invst){
                $invest_id           = $invst->id;
                $user_id             = $invst->user_id;
                $daily_rabit         = $invst->daily_rabit;
                $this->amount        = $daily_rabit;
                $checktran = Transaction::where('user_id', $user_id)->where('tran_date', date('Y-m-d'))
                ->where('inoutstatus', 'daily')->where('invenst_id', $invest_id)->first();
                if(empty($checktran)){
                   $this->creditincome($user_id, $daily_rabit, $invest_id);
                   Investment::where('id',$invst->id)->update(['updated_at' => date('Y-m-d H:i', strtotime('-1 day')), 'days'=> $invst->days - 1, 'complate_days' => $invst->complate_days+1]);
                }
               

            }
        
        exit();
        
    }


    private function creditincome($user_id, $daily_rabit, $invest_id)
    {
       
        $trasaction                 = new Transaction();
        $trasaction->user_id        = $user_id;
        $trasaction->invenst_id     = $invest_id;
        $trasaction->credit_amount  = $daily_rabit;
        $trasaction->transaction    = Str::uuid();
        $trasaction->note           = "Daily Income";
        $trasaction->payment_type   = "transfer";
        $trasaction->inoutstatus    = "daily";
        $trasaction->tran_date      = date('Y-m-d');
        $trasaction->save();

        $userinfo                   = User::find($user_id);

        $debitcurrrent              = Transaction::Where('user_id', $user_id)
                                        ->where('payment_type', 'transfer')
                                        ->selectRaw("ifnull(SUM(credit_amount),0) as total_credit")
                                        ->selectRaw("ifnull(SUM(debit_amount),0) as total_debit")
                                        ->groupBy('user_id')
                                        ->first();
        $userinfo->transfer_balance = $debitcurrrent->total_credit - $debitcurrrent->total_debit;
        $userinfo->save();
        $this->username = $userinfo->username;
        if(!empty($userinfo->ref_id)){
            $this->lavelone($userinfo->ref_id);
        }
        

    }

    private function lavelone($user_id)
    {

        $userinfo                       = User::find($user_id);

        if($userinfo->status == 'Active'){

            $income                         = $this->amount / 100 * $this->lavel_1;
            $newtransation                  = new Transaction();
            $newtransation->credit_amount   = $income;
            $newtransation->transaction     = Str::uuid();
            $newtransation->user_id         = $user_id;
            $newtransation->payment_type    = "transfer";
            $newtransation->inoutstatus     = "Generation";
            $newtransation->note            = "1st Generation (ROI): ".$this->username;
            $newtransation->tran_date       = date('Y-m-d');
            $newtransation->save();
            $currrent = Transaction::Where('user_id', $user_id)
                                            ->where('payment_type', 'transfer')
                                            ->selectRaw("SUM(credit_amount) as total_credit")
                                            ->selectRaw("SUM(debit_amount) as total_debit")
                                            ->groupBy('user_id')
                                            ->first();
            $userinfo->transfer_balance = $currrent->total_credit - $currrent->total_debit;
            $userinfo->save();
        }

        if($userinfo->ref_id){
            $this->lavelsend($userinfo->ref_id);
        }
        

    }

    private function lavelsend($user_id)
    {

        $userinfo                       = User::find($user_id);

        if($userinfo->status == 'Active'){

            $total_ref                      = User::where('ref_id', $user_id)->count();
            if($total_ref >= 2){

                $income                         = $this->amount / 100 * $this->lavel_2;
                $newtransation                  = new Transaction();
                $newtransation->credit_amount   = $income;
                $newtransation->transaction     = Str::uuid();
                $newtransation->user_id         = $user_id;
                $newtransation->payment_type    = "transfer";
                $newtransation->inoutstatus     = "Generation";
                $newtransation->note            = "2nd Generation (ROI): ".$this->username;
                $newtransation->tran_date       = date('Y-m-d');
                $newtransation->save();
                $currrent                       = Transaction::Where('user_id', $user_id)
                                                ->where('payment_type', 'transfer')
                                                ->selectRaw("SUM(credit_amount) as total_credit")
                                                ->selectRaw("SUM(debit_amount) as total_debit")
                                                ->groupBy('user_id')
                                                ->first();
                $userinfo->transfer_balance = $currrent->total_credit - $currrent->total_debit;
                $userinfo->save();

            }
            

        }

       

        if($userinfo->ref_id){
            if($this->lavel_3 > 0){
                $this->lavelthird($userinfo->ref_id);
            }
            
        }

    }

    private function lavelthird($user_id)
    {
        $userinfo                       = User::find($user_id);
        if($userinfo->status == 'Active'){

            $total_ref                      = User::where('ref_id', $user_id)->count();
            if($total_ref >= 4){
                $income                         = $this->amount / 100 * $this->lavel_3;
                $newtransation                  = new Transaction();
                $newtransation->credit_amount   = $income;
                $newtransation->transaction     = Str::uuid();
                $newtransation->user_id         = $user_id;
                $newtransation->payment_type    = "transfer";
                $newtransation->inoutstatus     = "Generation";
                $newtransation->note            = "3rd Generation (ROI): ".$this->username;
                $newtransation->tran_date       = date('Y-m-d');
                $newtransation->save();

                $currrent = Transaction::Where('user_id', $user_id)
                                                ->where('payment_type', 'transfer')
                                                ->selectRaw("SUM(credit_amount) as total_credit")
                                                ->selectRaw("SUM(debit_amount) as total_debit")
                                                ->groupBy('user_id')
                                                ->first();
                $userinfo->transfer_balance = $currrent->total_credit - $currrent->total_debit;
                $userinfo->save();
            }
            

        }
        
        if($userinfo->ref_id){
            if($this->lavel_4 > 0){
                $this->lavelfour($userinfo->ref_id);
            }
            
        }

    }

    private function lavelfour($user_id)
    {
        $userinfo                       = User::find($user_id);
        if($userinfo->status == 'Active'){

            $total_ref                      = User::where('ref_id', $user_id)->count();
            if($total_ref >= 8){
                $income                         = $this->amount / 100 * $this->lavel_4;
                $newtransation                  = new Transaction();
                $newtransation->credit_amount   = $income;
                $newtransation->transaction     = Str::uuid();
                $newtransation->user_id         = $user_id;
                $newtransation->payment_type    = "transfer";
                $newtransation->inoutstatus     = "Generation";
                $newtransation->note            = "4th Generation (ROI): ".$this->username;
                $newtransation->tran_date       = date('Y-m-d');
                $newtransation->save();

                $currrent = Transaction::Where('user_id', $user_id)
                                                ->where('payment_type', 'transfer')
                                                ->selectRaw("SUM(credit_amount) as total_credit")
                                                ->selectRaw("SUM(debit_amount) as total_debit")
                                                ->groupBy('user_id')
                                                ->first();
                $userinfo->transfer_balance = $currrent->total_credit - $currrent->total_debit;
                $userinfo->save();
            }
            
        }
        

        if($userinfo->ref_id){
            if($this->lavel_5 > 0){
                $this->lavelfive($userinfo->ref_id);
            }
            
        }

    }

    private function lavelfive($user_id)

    {
        $userinfo                       = User::find($user_id);
        if($userinfo->status == 'Active'){

            $total_ref                      = User::where('ref_id', $user_id)->count();
            if($total_ref >= 10){
                $income                         = $this->amount / 100 * $this->lavel_5;
                $newtransation                  = new Transaction();
                $newtransation->credit_amount   = $income;
                $newtransation->transaction     = Str::uuid();
                $newtransation->user_id         = $user_id;
                $newtransation->payment_type    = "transfer";
                $newtransation->inoutstatus     = "Generation";
                $newtransation->note            = "5th Generation (ROI): ".$this->username;
                $newtransation->tran_date       = date('Y-m-d');
                $newtransation->save();

                $currrent = Transaction::Where('user_id', $user_id)
                                                ->where('payment_type', 'transfer')
                                                ->selectRaw("SUM(credit_amount) as total_credit")
                                                ->selectRaw("SUM(debit_amount) as total_debit")
                                                ->groupBy('user_id')
                                                ->first();
                $userinfo->transfer_balance = $currrent->total_credit - $currrent->total_debit;
                $userinfo->save();

            }
            

        }
        



        if($userinfo->ref_id){
            if($this->lavel_6 > 0){
                 $this->lavelsix($userinfo->ref_id);
            }
           
        }

    }

     private function lavelsix($user_id)
    {
        $userinfo                       = User::find($user_id);

        if($userinfo->status == 'Active'){

            $total_ref                      = User::where('ref_id', $user_id)->count();
            if($total_ref >= 32){
                $income                         = $this->amount / 100 * $this->lavel_6;
                $newtransation                  = new Transaction();
                $newtransation->credit_amount   = $income;
                $newtransation->transaction     = Str::uuid();
                $newtransation->user_id         = $user_id;
                $newtransation->payment_type    = "transfer";
                $newtransation->inoutstatus     = "Generation";
                $newtransation->note            = "6th Generation (ROI): ".$this->username;
                $newtransation->tran_date       = date('Y-m-d');
                $newtransation->save();

                $currrent = Transaction::Where('user_id', $user_id)
                                                ->where('payment_type', 'transfer')
                                                ->selectRaw("SUM(credit_amount) as total_credit")
                                                ->selectRaw("SUM(debit_amount) as total_debit")
                                                ->groupBy('user_id')
                                                ->first();
                $userinfo->transfer_balance = $currrent->total_credit - $currrent->total_debit;
                $userinfo->save();
            }
            
        }


        if($userinfo->ref_id){
            if($this->lavel_7 > 0){
                $this->lavelseven($userinfo->ref_id);
            }
        }




    }

     private function lavelseven($user_id)
    {
        $userinfo                       = User::find($user_id);

        if($userinfo->status == 'Active'){
            
            $total_ref                      = User::where('ref_id', $user_id)->count();

            if($total_ref >= 64){
                $income                         = $this->amount / 100 * $this->lavel_7;
                $newtransation                  = new Transaction();
                $newtransation->credit_amount   = $income;
                $newtransation->transaction     = Str::uuid();
                $newtransation->user_id         = $user_id;
                $newtransation->payment_type    = "transfer";
                $newtransation->inoutstatus     = "Generation";
                $newtransation->note            = "7th Generation (ROI): ".$this->username;
                $newtransation->tran_date       = date('Y-m-d');
                $newtransation->save();

                $currrent = Transaction::Where('user_id', $user_id)
                                                ->where('payment_type', 'transfer')
                                                ->selectRaw("SUM(credit_amount) as total_credit")
                                                ->selectRaw("SUM(debit_amount) as total_debit")
                                                ->groupBy('user_id')
                                                ->first();
                $userinfo->transfer_balance = $currrent->total_credit - $currrent->total_debit;
                $userinfo->save();
            }
            
            
        }


        if($userinfo->ref_id){
            if($this->lavel_8 > 0){
                $this->laveleight($userinfo->ref_id);
            }
            
        }

    }

    private function laveleight($user_id)
    {
        $userinfo                       = User::find($user_id);
        if($userinfo->status == 'Active'){

            $total_ref                      = User::where('ref_id', $user_id)->count();

            if($total_ref >= 128){
                $income                         = $this->amount / 100 * $this->lavel_8;
                $newtransation                  = new Transaction();
                $newtransation->credit_amount   = $income;
                $newtransation->transaction     = Str::uuid();
                $newtransation->user_id         = $user_id;
                $newtransation->payment_type    = "transfer";
                $newtransation->inoutstatus     = "Generation";
                $newtransation->note            = "8th Generation (ROI): ".$this->username;
                $newtransation->tran_date       = date('Y-m-d');
                $newtransation->save();

                $currrent = Transaction::Where('user_id', $user_id)
                                                ->where('payment_type', 'transfer')
                                                ->selectRaw("SUM(credit_amount) as total_credit")
                                                ->selectRaw("SUM(debit_amount) as total_debit")
                                                ->groupBy('user_id')
                                                ->first();
                
                $userinfo->transfer_balance = $currrent->total_credit - $currrent->total_debit;
                $userinfo->save();
            }

            
        }
        

        if($userinfo->ref_id){
            if($this->lavel_9 > 0){
                $this->lavelnine($userinfo->ref_id);
            }
            
        }

    }

    private function lavelnine($user_id)
    {
        $userinfo                       = User::find($user_id);
        if($userinfo->status == 'Active'){

            $total_ref                      = User::where('ref_id', $user_id)->count();
            if($total_ref >= 256){
                $income                         = $this->amount / 100 * $this->lavel_9;
                $newtransation                  = new Transaction();
                $newtransation->credit_amount   = $income;
                $newtransation->transaction     = Str::uuid();
                $newtransation->user_id         = $user_id;
                $newtransation->payment_type    = "transfer";
                $newtransation->inoutstatus     = "Generation";
                $newtransation->note            = "9th Generation (ROI): ".$this->username;
                $newtransation->tran_date       = date('Y-m-d');
                $newtransation->save();

                $currrent = Transaction::Where('user_id', $user_id)
                                                ->where('payment_type', 'transfer')
                                                ->selectRaw("SUM(credit_amount) as total_credit")
                                                ->selectRaw("SUM(debit_amount) as total_debit")
                                                ->groupBy('user_id')
                                                ->first();
                
                $userinfo->transfer_balance = $currrent->total_credit - $currrent->total_debit;
                $userinfo->save();
            }
            
        }
        


        if($userinfo->ref_id){
            if($this->lavel_10 > 0){
                $this->lavelten($userinfo->ref_id);
            }
            
        }

    }

     private function lavelten($user_id)
    {

        $userinfo                       = User::find($user_id);

        if($userinfo->status == 'Active'){
            $total_ref                      = User::where('ref_id', $user_id)->count();
            if($total_ref >= 500){
                $income                         = $this->amount / 100 * $this->lavel_10;
                $newtransation                  = new Transaction();
                $newtransation->credit_amount   = $income;
                $newtransation->transaction     = Str::uuid();
                $newtransation->user_id         = $user_id;
                $newtransation->payment_type    = "transfer";
                $newtransation->inoutstatus     = "Generation";
                $newtransation->note            = "10th Generation (ROI): ".$this->username;
                $newtransation->tran_date       = date('Y-m-d');
                $newtransation->save();

                $currrent = Transaction::Where('user_id', $user_id)
                                                ->where('payment_type', 'transfer')
                                                ->selectRaw("SUM(credit_amount) as total_credit")
                                                ->selectRaw("SUM(debit_amount) as total_debit")
                                                ->groupBy('user_id')
                                                ->first();
                $userinfo->transfer_balance = $currrent->total_credit - $currrent->total_debit;
                $userinfo->save();

            }
            
        }



    }


    public function checktrasnction()
    {


        $today      = date('Y-m-d', strtotime('-1 day'));

       // return date('H:i');

        return $investment = Investment::whereDate('updated_at', '<=', $today)
                                    ->whereTime('invest_time', '<=', date('H:i'))
                                    ->where('days', '>', 0)
                                    ->get();



          $invstmentuser = Investment::where('days', '>', 0)
                                            ->selectRaw('count(*) as total,user_id,daily_rabit')
                                            ->groupBy('user_id', 'daily_rabit')
                                            ->orderBy('total', 'DESC')
                                            ->havingRaw('total > 1')
                                            ->get();

        return count($invstmentuser);

        $arraylist = array();

        foreach($invstmentuser as $item){
            $total          = $item->total;
            $user_id        = $item->user_id;
            $invest_amount  = $item->daily_rabit;

            $totalcount     =  $this->transaction($total, $user_id, $invest_amount);
           // $array['user_id']    = $user_id;
            //$array['total_tran'] = $totalcount;
           // $array['amount']     = $invest_amount;
          // array_push($arraylist, $array);

        }

        return $arraylist;
    }

        

    private function transaction($total, $user_id, $invest_amount)
    {

        


        $investmentinfo = Investment::where('user_id', $user_id)->where('daily_rabit', $invest_amount)->first();



        //Transaction::where('user_id',$user_id)->where('inoutstatus', 'daily')->where('credit_amount', $invest_amount)->update(['invenst_id'=> $investmentinfo->id]);
        $totalcount = Transaction::where('invenst_id',$investmentinfo->id)->where('inoutstatus', 'daily')->where('user_id', $user_id)->count();

        if($investmentinfo->complate_days != $totalcount){

            $total_days                    = $investmentinfo->days + $investmentinfo->complate_days;

            $investmentinfo->complate_days      = $totalcount;
            $investmentinfo->days               = $total_days - $investmentinfo->complate_days;
            $investmentinfo->updated_at         = date('Y-m-d H:i:s', strtotime($investmentinfo->created_at.'+ '.$totalcount.' days'));
            $investmentinfo->save();
        }
        


    //    return  $trasactionlist = Transaction::where('user_id', $user_id)->where('inoutstatus', 'daily')
    //                                         ->where('credit_amount', $invest_amount)
    //                                         ->count();

        
    }


        



}
