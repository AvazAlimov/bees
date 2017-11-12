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
        $users = Auth::user()->pandingUsers;

        return view('leader.index')->withUsers($users);
    }
    public function acceptUser(Request $request, $id){
       $user =  $request->user()->users()->findOrFail($id);
        $password = 'password';
        $user->update(['username'=>'U'.sprintf("%07d", $user->id),'password'=>Hash::make($password)]);
        $data = ['username' => $user->username, 'password' => $password, 'name' => $user->fullName, 'url' =>'/login'];

        $user->notify(new UserConfirmationNotification($data));
        /*Mail::send(['html' => 'email.email-confirmation'], ['data' => $data], function ($message) use ($data) {
            $message->to($data['email'], $data['name'])->subject('Email-confirmation');
        });*/
    }
}
