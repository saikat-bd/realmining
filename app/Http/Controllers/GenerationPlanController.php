<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\GenerationPlan;

class GenerationPlanController extends Controller
{
    public function index()
    {
        $data['generation'] = GenerationPlan::all();
        return view('admin.generation.index', $data);
    }

    public function show($id)
    {
         $data['generation'] = GenerationPlan::find($id);
        return view('admin.generation.edit', $data);
    }

    public function updated(Request $request, $id)
    {
        $generation = GenerationPlan::find($id);
        $generation->lavel_1 = $request->lavel_1;
        $generation->lavel_2 = $request->lavel_2;
        $generation->lavel_3 = $request->lavel_3;
        $generation->lavel_4 = $request->lavel_4;
        $generation->lavel_5 = $request->lavel_5;
        $generation->lavel_6 = $request->lavel_6;
        $generation->lavel_7 = $request->lavel_7;
        $generation->lavel_8 = $request->lavel_8;
        $generation->lavel_9 = $request->lavel_9;
        $generation->lavel_10 = $request->lavel_10;
        $generation->save();
        return redirect('admin/settings/generation')->with('success', 'success');

    }


}
