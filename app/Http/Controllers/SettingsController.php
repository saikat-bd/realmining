<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ComanyInfo;


class SettingsController extends Controller
{
    public function setting()
    {
        $data['setting']    = ComanyInfo::first();
        return view('admin.settings.setting', $data);
    }

    public function logo()
    {
         $data['setting']    = ComanyInfo::first();
        return view('admin.settings.logo', $data);
    }


    public function metasetting()
    {
         $data['setting']    = ComanyInfo::first();
        return view('admin.settings.metasetting', $data);
    }
    public function homecontent()
    {
         $data['setting']    = ComanyInfo::first();
        return view('admin.settings.homecontent', $data);
    } 
    
    public function about_us()
    {
         $data['setting']    = ComanyInfo::first();
        return view('admin.settings.about_us', $data);
    }


    public function terms()
    {
        $data['setting']    = ComanyInfo::first();
        return view('admin.settings.terms', $data);
    }


    public function setting_update(Request $request)
    {
        $company = ComanyInfo::first();
        $company->company_name = $request->company_name;
        $company->phone_number = $request->phone_number;
        $company->email = $request->email;
        $company->website = $request->website;
        $company->address = $request->address;
        $company->save();
       return redirect('admin/settings/setting')->with('success', 'success');
    }

    public function metasetting_update(Request $request)
    {
        $company = ComanyInfo::first();
        $company->meta_title = $request->meta_title;
        $company->meta_descrption = $request->meta_descrption;
        $company->save();
       return redirect('admin/settings/metasetting')->with('success', 'success');
    }
    
    public function about_us_update(Request $request)
    {
        $company = ComanyInfo::first();
        $company->about_us = $request->about_us;
        $company->about_title = $request->about_title;
        $company->save();
       return redirect('admin/settings/about-us')->with('success', 'success');
    }
    
    public function terms_update(Request $request)
    {
        $company = ComanyInfo::first();
        $company->terms_title = $request->terms_title;
        $company->terms_descrption = $request->terms_descrption;
        $company->save();
       return redirect('admin/settings/termsofservice')->with('success', 'success');
    }

    public function homecontent_update(Request $request)
    {
        $company = ComanyInfo::first();
        $company->home_content = $request->home_content;

        if($request->hasFile('home_image')){
            $favicon_name = time().'.'.$request->home_image->getClientOriginalExtension();
            $request->home_image->move(public_path('images'), $favicon_name);
            $company->home_image = $favicon_name;
         }

        $company->save();
       return redirect('admin/settings/homecontent')->with('success', 'success');
    }

    

    public function logo_update(Request $request)
    {
         $company = ComanyInfo::first();

         if($request->hasFile('logo')){
            $logo_name = time().'.'.$request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('logo'), $logo_name);
            $company->logo = $logo_name;
         }

         if($request->hasFile('favicon')){
            $favicon_name = time().'.'.$request->favicon->getClientOriginalExtension();
            $request->favicon->move(public_path('logo'), $favicon_name);
            $company->favicon = $favicon_name;
         }
         $company->save();
        return redirect('admin/settings/logo')->with('success', 'success');

    }



}
