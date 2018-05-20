<?php

namespace App\Http\Controllers\Admin;

use App\Equipment;
use App\Export;
use App\Production;
use App\Realization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class AdminRequisitionAjaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function productions(){
        $productions = Production::where('state','!=',1)->where('state','!=',-1)
            ->withCount('equipments as cnt')->orderByDesc('id');
        $array = $productions->with(['user' => function ($query) {
            $query->with(['region' => function ($quer) {
                $quer->select('id', 'name');
            }])->with(['city' => function ($quer) {
                $quer->select('id', 'name');
            }])->select(['id', 'region_id', 'city_id', 'subject'])->get();
        }])->with(['equipments' => function ($query) {
            $query->select('name', 'volume', 'equipment_id');
        }])->select('id', 'user_id','state','year','month')->get()->toArray();

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
        return DataTables::of($array)
            ->make(true);
    }

    public function realizations(){
        $realizations = Realization::where('state','!=',1)->where('state','!=',-1)
            ->with(['user' => function ($query) {
                $query->with(['region' => function ($quer) {
                    $quer->select('id', 'name');
                }])->with(['city' => function ($quer) {
                    $quer->select('id', 'name');
                }])->select(['id', 'region_id', 'city_id', 'subject'])->get();
            }])
            ->orderByDesc('year')->orderByDesc('month')->with(['families'=> function($query){
            $query->select('id','name');
        }])->get();
        $array= $realizations;

        foreach ($realizations as $key=>$item)
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
    public function exports(){
        $exports = Export::where('state','!=',1)->where('state','!=',-1)
            ->with(['user' => function ($query) {
                $query->with(['region' => function ($quer) {
                    $quer->select('id', 'name');
                }])->with(['city' => function ($quer) {
                    $quer->select('id', 'name');
                }])->select(['id', 'region_id', 'city_id', 'subject'])->get();
            }])->get();

        return DataTables::of($exports)->make(true);
    }
}
