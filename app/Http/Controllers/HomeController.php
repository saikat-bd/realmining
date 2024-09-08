<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;

class HomeController extends Controller
{
    public function index()
    {
        $data['packages'] = Package::orderBy('amount', 'ASC')->where('package_status', 'public')->get();
        return view('website.home', $data);
        
    }

    public function about()
    {
        return view('website.about');
    }
    
    public function faq()
    {
        return view('website.faq');
    }
    public function packages()
    {
        $data['packages'] = Package::orderBy('amount', 'ASC')->where('package_status', 'public')->get();
        return view('website.packages', $data);
    }
    
    public function blogs()
    {
        return view('website.blogs');
    }
    
    public function contact()
    {
        return view('website.contact');
    }


}
