<?php

namespace App\Http\Controllers\Admin;

use App\Leader;
use App\Notifications\LeaderConfirmationNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminLeaderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('leader.leader-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username'=>'required|unique:leaders|min:6',
            'password'=>'required|min:6|confirmed',
            'lastName'=>'required',
            'firstName'=>'required',
            'email' =>'required|email',
            'phone'=>'required|max:13|min:12',
        ]);
        $leader = new Leader($request->all());
        $leader->password = bcrypt($request->password);
        $leader->save();

//        $data = ['username' => $request->username, 'password' => $request->password, 'name' => $request->firstName.' '.$request->lastName, 'url' =>'/leader/login'];
//        $leader->notify(new LeaderConfirmationNotification($data));

        return redirect()->route('admin.index')->with('message','Leader created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('leader.leader-update')->withLeader(Leader::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'username'=>'required|min:6|unique:leaders,username,'.$id,
            'password'=>$request->password != null ? 'required|min:6': '',
            'lastName'=>'required',
            'firstName'=>'required',
            'email' =>'required|email',
            'phone'=>'required|max:13|min:12',
        ]);
        $leader = Leader::findOrFail($id);
        $leader->update($request->except(['password']));
        if($request->password != null)
            $leader->password=bcrypt($request->password);

        $leader->save();
        return redirect()->route('admin.index')->with('message','leader updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $leader = Leader::findOrFail($id);
        $leader->delete();
        return redirect()->back()->with('message','Leader deleted successfully');
    }
}
