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
    	$realization = Auth::user()->realizations()->orderByDesc('year')->orderByDesc('month');
    	$realization = $realization->leftJoin('family_realization', 'realization_id', 'realizations.id')->leftJoin('families', 'families.id', 'family_id')->addSelect('realizations.*', 'families.name as family_type')->get();
    	return DataTables::of($realization)->make(true);
    }

    public function getExport(){
    	$export = Auth::user()->exports()->orderByDesc('month')->orderByDesc('year')->get();
    	return DataTables::of($export)->make(true);
    }
}
