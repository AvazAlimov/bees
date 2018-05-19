<?php

namespace App\Http\Controllers\Admin;

use App\Equipment;
use App\Production;
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
        $productions = Production::where('state','!=',1)
            ->withCount('equipments as cnt')->orderByDesc('year')->orderByDesc('month');
        $array = $productions->with(['user' => function ($query) {
            $query->with(['region' => function ($quer) {
                $quer->select('id', 'name');
            }])->with(['city' => function ($quer) {
                $quer->select('id', 'name');
            }])->select(['id', 'region_id', 'city_id', 'subject'])->get();
        }])->with(['equipments' => function ($query) {
            $query->select('name', 'volume', 'equipment_id');
        }])->select('id', 'user_id')->get()->toArray();

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
}
