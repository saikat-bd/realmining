<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        $data['messages'] = Message::where('user_id', Auth::id())->orderBy('id', 'ASC')->get();
        return view('users.message_center', $data);
    }

    public function admin_index()
    {
        $data['messages'] = Message::orderBy('id', 'DESC')
                                    ->join('users', 'users.id', '=', 'messages.user_id')
                                    ->select('messages.*','users.name')
                                    ->paginate(20);
        return view('admin.message.inbox', $data);
    }

    public function admin_show($id)
    {   
         $data['messages'] = Message::where('messages.id', $id)
                                    ->join('users', 'users.id', '=', 'messages.user_id')
                                    ->select('messages.*','users.name')
                                    ->first();
        return view('admin.message.show', $data);
    }



    public function reply(Request $request)
    {
            
            $alldata = $request->all();
            $rules = [
                
                'uploadfile'            => 'image',
            ];
            $custommessage = [
                'uploadfile.image'              => 'Attachment allow only image!',
            ];

            $validations = Validator::make($alldata, $rules, $custommessage);
            if($validations->fails()){
                return redirect()->back()->withInput()->withErrors($validations);
            }

            $sendmessge = Message::find($request->id);
            $newofject = new Message();

            $newofject->user_id = $sendmessge->user_id;
            $newofject->messages = $request->messages;
            $newofject->parent_id = $request->id;
            $newofject->status = 1;

            if($request->uploadfile){
                $imageName = time().'.'.$request->uploadfile->extension();
                $request->uploadfile->move(public_path('messages'), $imageName);
                $newofject->attachment       = $imageName;
            }
            $newofject->save();
            $sendmessge->status = 1;
            $sendmessge->save();
            return redirect('admin/message/inbox')->with('success', 'Message has been send success!'); 

    }
    public function sendmesage(Request $request)
    {
            
            $alldata = $request->all();
            $rules = [
                
                'uploadfile'            => 'image',
            ];
            $custommessage = [
                'uploadfile.image'              => 'Attachment allow only image!',
            ];

            $validations = Validator::make($alldata, $rules, $custommessage);
            if($validations->fails()){
                return redirect()->back()->withInput()->withErrors($validations);
            }

            $sendmessge = new Message();

            $sendmessge->user_id = Auth::id();
            $sendmessge->messages = $request->message;

            if($request->uploadfile){
                $imageName = time().'.'.$request->uploadfile->extension();
                $request->uploadfile->move(public_path('messages'), $imageName);
                $sendmessge->attachment       = $imageName;
            }
            

            $sendmessge->save();
            return redirect('message-center')->with('success', 'Message has been send success!'); 

    }


}
