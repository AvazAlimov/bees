<?php

namespace App\Http\Controllers\Admin;

use App\Leader;
use App\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminRegionController extends Controller
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
        return view('region.region-create')->withLeaders(Leader::all());
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
            'name'=>'required|unique:regions',
            'leader_id'=>'exists:leaders,id'
        ]);
        $region = new Region($request->all());
        $region->save();
        return redirect()->route('admin.index')->with('message','Region created successfully');
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
        $region = Region::findOrFail($id);
        $leaders= Leader::all();
        return view('region.region-update')->withLeaders($leaders)->withRegion($region);
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
           'name'=>'unique:regions,name,'.$id
            //'leader_id'=>'exists:leaders,id'
        ]);
        $region = Region::findOrFail($id);
        $region->update($request->all());

        return redirect()->route('admin.index')->with('message','Region updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $region = Region::findOrFail($id);
        $region->delete();
        return redirect()->back()->with('message','Region deleted successfully');
    }
}
