<?php

namespace App\Http\Controllers;

use App\Equipment;
use Illuminate\Http\Request;
use App\User;
use App\realization;
use Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class UserAjaxController extends Controller
{
    public function getRealization(){
    	$realization = Auth::user()->realizations()->orderByDesc('year')->orderByDesc('month')->orderByDesc('id')->with(['families'=> function($query){
    	    $query->select('id','name');
        }])->get();
    	$array= $realization;

        foreach ($realization as $key=>$item)
        {
            $array[$key]['family_type']='';
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
    	$export = Auth::user()->exports()->orderByDesc('year')->orderByDesc('month')->orderByDesc('id')->get();
    	return DataTables::of($export)->make(true);
    }
    public function getProduction(){
        $productions = Auth::user()->productions()->with(['equipments' => function ($query) {
            $query->select('name', 'volume', 'equipment_id');
        }])->orderByDesc('year')->orderByDesc('month')->orderByDesc('id')->get()->toArray();
        $array = $productions;
        foreach ($array as $i => $item) {
            $arr = collect($item['equipments']);
            $new = $arr->keyBy(function ($item) {
                return $item['equipment_id'];
            });
            $array[$i]['equipments'] = $new->toArray();
        }
        foreach ($array as $i => $item) {
            $equipments = Equipment::orderBy('id', 'asc')->pluck('id');
            foreach ($equipments as $k => $equipment) {
                if (!array_key_exists($equipment, $item['equipments']))
                    $array[$i]['equipments'][$equipment] = ['name' => '', 'volume' => '', 'equipment_id' => $equipment];
                else {
                    $array[$i]['equipments'][$equipment] = $item['equipments'][$equipment];
                }
            }

        }
        return DataTables::of($array)->make(true);
    }
}
