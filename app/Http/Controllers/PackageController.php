<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Package;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class PackageController extends Controller
{
    public function index()
    {
        $data['packagte'] = Package::paginate(20);
        return view('admin.package.index', $data);
    }

    public function form()
    {
        return view('admin.package.form');     
    }


    public function edit($id)
    {
        $data['datainfo']   = Package::find($id);
        return view('admin.package.edit', $data);
    }


    public function store(Request $request)
    {
        $alldata = $request->all();
            $rules = [
                'package_name'   => 'required',
                'amount'        => 'required',
                'rabit'         => 'required',
                //'thumbnail'         => 'required',
                'total_amount'  => 'required',
                'duraction'         => 'required',
            ];
            $custommessage = [
                'package_name.required'   => 'Package name is required!',
                'amount.required'           => 'Price is required!',
                'rabit.required'         => 'Daily income is required!',
                'total_amount.required'  => 'Total amount is required!',
                'duraction.required'         => 'Duration is required!',
            ];

            $validations = Validator::make($alldata, $rules, $custommessage);
            if($validations->fails()){
                return redirect()->back()->withInput()->withErrors($validations);
            }


            $newsave = new Package();
            $newsave->package_name = $request->package_name;
            $newsave->amount = $request->amount;
            $newsave->rabit = $request->rabit;
            $newsave->total_amount = $request->total_amount;
            $newsave->duraction = $request->duraction;
          
            $newsave->save();
            return redirect('admin/settings/packagemanage')->with('success', 'success');
    }


    public function updated(Request $request, $id)
    {
        $alldata = $request->all();
            $rules = [
                'package_name'   => 'required',
                'amount'        => 'required',
                'rabit'         => 'required',
                //'thumbnail'         => 'required',
                'total_amount'  => 'required',
                'duraction'         => 'required',
            ];
            $custommessage = [
                'package_name.required'   => 'Package name is required!',
                'amount.required'           => 'Price is required!',
                'rabit.required'         => 'Daily income is required!',
                'total_amount.required'  => 'Total amount is required!',
                'duraction.required'         => 'Duration is required!',
            ];

            $validations = Validator::make($alldata, $rules, $custommessage);
            if($validations->fails()){
                return redirect()->back()->withInput()->withErrors($validations);
            }

            $newsave = Package::find($id);
            $newsave->package_name = $request->package_name;
            $newsave->amount = $request->amount;
            $newsave->rabit = $request->rabit;
            $newsave->total_amount = $request->total_amount;
            $newsave->duraction = $request->duraction;
          
            $newsave->save();
            return redirect('admin/settings/packagemanage')->with('success', 'success');
    }



}
