<?php

namespace App\Http\Controllers\Leader;

use App\Notifications\UserConfirmationNotification;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LeaderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:leader');
    }
    public function requestList(){
        $users = Auth::user()->pandingUsers()->orderBy('id','desc')->paginate(10);

        return view('leader.index')->withUsers($users);
    }
    public function acceptUser(Request $request, $id){
       $user =  $request->user()->users()->findOrFail($id);
        $password = 'password';
        $user->update(['username'=>'U'.sprintf("%07d", $user->id),'password'=>bcrypt($password),'state'=>1]);
        $data = ['username' => $user->username, 'password' => $password, 'name' => $user->fullName, 'url' =>'/login'];

        $user->notify(new UserConfirmationNotification($data));
        return redirect()->back()->with('message','Accepted successfully');
        /*Mail::send(['html' => 'email.email-confirmation'], ['data' => $data], function ($message) use ($data) {
            $message->to($data['email'], $data['name'])->subject('Email-confirmation');
        });*/
    }
    public function refuseUser(Request $request, $id){
        $user =  $request->user()->users()->findOrFail($id);

        $user->update(['state'=>2]);
        return redirect()->back()->with('message','Refused successfully');
    }
    public function destroyUser(Request $request, $id){
        $user =  $request->user()->users()->findOrFail($id);

        $user->delete();
        return redirect()->back()->with('message','Deleted successfully');
    }
}
