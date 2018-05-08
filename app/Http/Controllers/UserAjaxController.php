<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\realization;
use Auth;
use Yajra\DataTables\DataTables;

class UserAjaxController extends Controller
{
    public function getRealization(){
    	$realization = Auth::user()->realizations()->orderByDesc('year')->orderByDesc('month')->with(['families'=> function($query){
    	    $query->select('id','name');
        }])->get();
    	$array= $realization;

        foreach ($realization as $key=>$item)
        {
            foreach ($item->families as $i=>$family)
            {
                if ($i < 1){
                    $array[$key]['family_type']= $family->name;
                    continue;
                }
                $array[$key]['family_type'] = $array[$key]['family_type'].', '.$family->name;
            }
        }
        return DataTables::of($array)->make(true);
    }

    public function getExport(){
    	$export = Auth::user()->exports()->orderByDesc('month')->orderByDesc('year')->get();
    	return DataTables::of($export)->make(true);
    }
}
