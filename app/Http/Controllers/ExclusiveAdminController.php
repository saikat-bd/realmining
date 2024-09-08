<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ExclusivePlan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\ExclusivePlanBuy;
class ExclusiveAdminController extends Controller
{
    public function index()
    {
        $data['exlusives'] = ExclusivePlan::orderBy('plan_amount', 'ASC')->get();
        return view('admin.exlusiveplan.index', $data);
    }


    public function exclusive_report()
    {
        $data['exlusives'] = ExclusivePlanBuy::join('users', 'users.id', '=', 'exclusive_plan_buys.user_id')->select('users.name', 'users.username', 'exclusive_plan_buys.*')->get();
        return view('admin.exlusiveplan.exlsuviereport', $data);
    }



    public function form()
    {
        return view('admin.exlusiveplan.form');
    }

     public function edit($id)
    {
        $data['datainfo']   = ExclusivePlan::find($id);
        return view('admin.exlusiveplan.edit', $data);
    }
    

    public function store(Request $request)
    {
        $alldata = $request->all();
            $rules = [
                'plan_name'   => 'required',
                'plan_amount' => 'required',
            ];
            $custommessage = [
                'plan_name.required'   => 'Plan name is required!',
                'plan_amount.required' => 'Plan Price is required!',
            ];

            $validations = Validator::make($alldata, $rules, $custommessage);
            if($validations->fails()){
                return redirect()->back()->withInput()->withErrors($validations);
            }


            $newsave                = new ExclusivePlan();
            $newsave->plan_name     = trim($request->plan_name);
            $newsave->plan_amount   = $request->plan_amount;
            $newsave->description   = $request->description;
            $newsave->save();
            return redirect('admin/settings/exclusive-manage')->with('success', 'success');
    }


    public function updated(Request $request, $id)
    {
        $alldata = $request->all();
            $rules = [
                'plan_name'   => 'required',
                'plan_amount' => 'required',
            ];
            $custommessage = [
                'plan_name.required'   => 'Plan name is required!',
                'plan_amount.required' => 'Plan Price is required!',
            ];

            $validations = Validator::make($alldata, $rules, $custommessage);
            if($validations->fails()){
                return redirect()->back()->withInput()->withErrors($validations);
            }

            $newsave = ExclusivePlan::find($id);
            $newsave->plan_name     = trim($request->plan_name);
            $newsave->plan_amount   = $request->plan_amount;
            $newsave->description   = $request->description;
            $newsave->save();
            return redirect('admin/settings/exclusive-manage')->with('success', 'success');
    }


}
