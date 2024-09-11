<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Country;
use Illuminate\Support\Str;
use App\Models\Team;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use App\Models\Transaction;
use App\Models\Coin;

class DashboardController extends Controller
{
    public function index()
    {
        $data['userinfo']     = User::where('id',Auth::id())->with('exlusive')->with('rank')->first();
       // $data['packages']     = Package::orderBy('amount', 'ASC')->get();

        $data['geneationsum'] = Transaction::Where('user_id', Auth::id())
                                        ->where('inoutstatus', 'Generation')
                                        ->sum('credit_amount');
                                        
        $data['rabitincome'] = Transaction::Where('user_id', Auth::id())
                                        ->where('inoutstatus', 'daily')
                                        ->sum('credit_amount');

        $data['investment'] = Transaction::Where('user_id', Auth::id())
                                        ->where('inoutstatus', 'purchase')
                                        ->sum('debit_amount');

         $data['withdrawal'] = Transaction::Where('user_id', Auth::id())
                                        ->where('inoutstatus', 'withdrawal')
                                        ->sum('debit_amount');

        $data['rankinsentamont'] = Transaction::Where('user_id', Auth::id())
                                        ->where('inoutstatus', 'rank')
                                        ->sum('credit_amount');

        $data['coins']       = Coin::orderBy('id', 'ASC')->get();
        return view('users.dashbaord', $data);
    }


    public function my_team(Request $request)
    {
        $data['userinfo']     = User::find(Auth::id());
        
        $query = Team::where('team_id', Auth::id());
        if($request->position){
            $query->where('position', $request->position);
        }else{
             $query->where('position', 'left');
        }
         $query->join('users', 'users.id', '=', 'teams.user_id');
         $data['userslist'] = $query->select('users.name', 'users.status', 'users.username', 'teams.user_id', 'teams.created_at')->get();
        return view('users.my_team', $data);
    }

    public function team_rank()
    {
        $data['userinfo']     = User::find(Auth::id());
        return view('users.team_rank', $data);  
    }

    public function my_refrences(Request $request)
    {
      
       $query           = Team::join('users', 'users.id', '=', 'teams.user_id');
         if($request->user_id){
            $query->where('team_id', $request->user_id);
            $user_id =  $request->user_id;
         }else{
            $query->where('team_id', Auth::id());
            $user_id =  Auth::id();
         }
         if($request->gen_type){
            $query->where('position', $request->gen_type);
            $genusers = Team::where('team_id', Auth::id())->where('position', $request->gen_type)->pluck('user_id');
         }else{
            $genusers = [];
         }

        $data['secendgen_amount']    = Transaction::whereIn('user_id', $genusers)->where('inoutstatus', 'purchase')->sum('debit_amount');
        $data['userlist'] = $query->select('users.username','teams.*')->get();
       return view('users.referecelist', $data);   
    }

    public function invite_link()
    {
        $data['userinfo']      = User::find(Auth::id());
        $data['reffercount']   = User::where('ref_id', Auth::id())->count();
        $data['totaldownline'] = Team::where('team_id', '=', Auth::id())->count();

        $firstlavelids   = Team::where('team_id', Auth::id())->where('position', 1)->pluck('user_id');
        $secendlavelids  = Team::where('team_id', Auth::id())->where('position', 2)->pluck('user_id');
        $thirdlavelids   = Team::where('team_id', Auth::id())->where('position', 3)->pluck('user_id');
        $fourlavelids    = Team::where('team_id', Auth::id())->where('position', 4)->pluck('user_id');
        $fivelavelids    = Team::where('team_id', Auth::id())->where('position', 5)->pluck('user_id');
        $sixlavelids    = Team::where('team_id', Auth::id())->where('position', 6)->pluck('user_id');
        $sevenlavelids    = Team::where('team_id', Auth::id())->where('position', 7)->pluck('user_id');
        $eightlavelids    = Team::where('team_id', Auth::id())->where('position', 8)->pluck('user_id');
        $ninelavelids    = Team::where('team_id', Auth::id())->where('position', 9)->pluck('user_id');
        $tenlavelids    = Team::where('team_id', Auth::id())->where('position', 10)->pluck('user_id');

        $data['firstgen_amount']    = Transaction::whereIn('user_id', $firstlavelids)->where('inoutstatus', 'purchase')->sum('debit_amount');
        $data['secendgen_amount']    = Transaction::whereIn('user_id', $secendlavelids)->where('inoutstatus', 'purchase')->sum('debit_amount');
        $data['thirdgen_amount']    = Transaction::whereIn('user_id', $thirdlavelids)->where('inoutstatus', 'purchase')->sum('debit_amount');
        $data['fourgen_amount']    = Transaction::whereIn('user_id', $fourlavelids)->where('inoutstatus', 'purchase')->sum('debit_amount');
        $data['fivegen_amount']    = Transaction::whereIn('user_id', $fivelavelids)->where('inoutstatus', 'purchase')->sum('debit_amount');
        $data['sixgen_amount']    = Transaction::whereIn('user_id', $sixlavelids)->where('inoutstatus', 'purchase')->sum('debit_amount');
        $data['sevengen_amount']    = Transaction::whereIn('user_id', $sevenlavelids)->where('inoutstatus', 'purchase')->sum('debit_amount');
        $data['eightgen_amount']    = Transaction::whereIn('user_id', $eightlavelids)->where('inoutstatus', 'purchase')->sum('debit_amount');
        $data['nonegen_amount']    = Transaction::whereIn('user_id', $ninelavelids)->where('inoutstatus', 'purchase')->sum('debit_amount');
        $data['tengen_amount']    = Transaction::whereIn('user_id', $tenlavelids)->where('inoutstatus', 'purchase')->sum('debit_amount');

       

        return view('users.invite_link', $data);
    }

    public function profile()
    {
        $data['countrys'] = Country::orderBy('country_name', 'ASC')->get();
        $data['userinfo'] = User::find(Auth::id());
        return view('users.profile', $data);
    }

    public function profile_edit()
    {
        $data['countrys'] = Country::orderBy('country_name', 'ASC')->get();
        $data['userinfo'] = User::find(Auth::id());
        return view('users.profile_edit', $data);
    }

    

    public function profile_update(Request $request)
    {
        $profileedit = User::find(Auth::id());
        if($request->isMethod('post')){
            $alldata = $request->all();
            $rules = [
                'first_name'              => 'required',
                'last_name'               => 'required',
                'gender'                  => 'required',
                'photo'                   => 'image|max:1024',
            ];
            $custommessage = [
                'first_name.required'       => 'First name is required!',
                'last_name.required'        => 'Last name is required!',
                'gender.required'           => 'Gender is required!',
                'photo.image'               => 'Photo must be extinction  jpg, jpeg and png',
                'photo.max'                 => 'Photo max size 1024 kb!',
                //'photo.mimes'               => 'Photo must be extinction  jpg, jpeg and png!',
            ];

            $validations = Validator::make($alldata, $rules, $custommessage);
            if($validations->fails()){
                return redirect()->back()->withInput()->withErrors($validations);
            }
            if($request->photo){
            $filename               =  time().'.'.$request->photo->getClientOriginalExtension();
                $request->photo->move(public_path('photo'), $filename);
                $profileedit->photo     = $filename;
            }
            

            $profileedit->first_name = $request->first_name;
            $profileedit->last_name = $request->last_name;
            $profileedit->gender = $request->gender;
            $profileedit->name = $request->first_name.' '.$request->last_name;
            $profileedit->save();

            return redirect('profile-edit')->with('success', 'Profile updated success!');


        }else{
              return redirect()->back();
        }
    }


}
