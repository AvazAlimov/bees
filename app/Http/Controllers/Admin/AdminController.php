<?php

namespace App\Http\Controllers\Admin;

use App\Activity;
use App\City;
use App\Equipment;
use App\Family;
use App\Leader;
use App\Production;
use App\Region;
use App\User;
use App\Realization;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){

        $waiting_users = User::where('state',0)->orderBy('id', 'desc')->paginate(10, ['*'], 'waiting');
        $accepted = User::where('state',1)->orderBy('id', 'desc')->paginate(10, ['*'], 'accepted');
        $notAccepted = User::where('state',-1)->orderBy('id', 'desc')->paginate(10, ['*'], 'notAccepted');
        

        return view('admin.index')
            ->withRegions(Region::all())
            ->withLeaders(Leader::all())
            ->withActivities(Activity::all())
            ->withEquipments(Equipment::all())
            ->withWaiting($waiting_users)->withAccepted($accepted)->withNotAccepted($notAccepted)
            ->withFamilies(Family::all())->withRealizations(Realization::all());

    }
    public function index2(){
        $waiting_users = User::where('state',0)->orderBy('id', 'desc')->paginate(10, ['*'], 'waiting');
        $accepted = User::where('state',1);
        $notAccepted = User::where('state',-1)->orderBy('id', 'desc')->paginate(10, ['*'], 'notAccepted');

        $numbers = DB::select(DB::raw("SELECT * FROM (SELECT * FROM productions as pro 
        WHERE year=(SELECT MAX(year) FROM productions as p WHERE p.user_id=pro.user_id)) as Shox
        WHERE month=(SELECT MAX(month) FROM productions as s WHERE s.user_id=Shox.user_id and s.year = Shox.year)"));

        $productions = Production::whereIn('id',collect($numbers)->pluck('id'))->withCount('equipments as cnt')->orderByDesc('year')->orderByDesc('month');

        $accepted= $accepted->orderBy('id', 'desc')->paginate(10, ['*'], 'accepted');
        return view('admin.index2')
            ->withRegions(Region::all())
            ->withLeaders(Leader::all())
            ->withActivities(Activity::all())
            ->withEquipments(Equipment::all())
            ->withMaxNumber(collect($productions->pluck('cnt'))->max())
            ->withProductions($productions->get('month','year'))
            ->withWaiting($waiting_users)->withAccepted($accepted)->withNotAccepted($notAccepted)
            ->withFamilies(Family::all());
    }
    public function ishlab(){
        $numbers = DB::select(DB::raw("SELECT * FROM (SELECT * FROM productions as pro 
        WHERE year=(SELECT MAX(year) FROM productions as p WHERE p.user_id=pro.user_id)) as Shox
        WHERE month=(SELECT MAX(month) FROM productions as s WHERE s.user_id=Shox.user_id and s.year = Shox.year)"));

        $productions = Production::whereIn('id',collect($numbers)->pluck('id'))->withCount('equipments as cnt')->orderByDesc('year')->orderByDesc('month');
        $maxNumber = collect($productions->pluck('cnt'))->max();
        return view('admin.ishlab-chiqarish')->withMaxNumber($maxNumber);
    }
    public function ishlabchiqarish(){
        $numbers = DB::select(DB::raw("SELECT * FROM (SELECT * FROM productions as pro 
        WHERE year=(SELECT MAX(year) FROM productions as p WHERE p.user_id=pro.user_id)) as Shox
        WHERE month=(SELECT MAX(month) FROM productions as s WHERE s.user_id=Shox.user_id and s.year = Shox.year)"));

        $productions = Production::whereIn('id',collect($numbers)->pluck('id'))->withCount('equipments as cnt')->orderByDesc('year')->orderByDesc('month');
        $maxNumber = collect($productions->pluck('cnt'))->max();
        $array = $productions->with(['user'=>function($query){
            $query->with(['region' => function($quer){
                $quer->select('id','name');
            }])->with(['city' => function($quer){
                $quer->select('id','name');
            }])->select(['id','region_id','city_id','subject'])->get();
        }])->with(['equipments' => function($query){
            $query->select('name', 'volume');
        }])->select('id','user_id')->get()->toArray();
        foreach ($array as $key=>$item)
            if(count($item['equipments']) < $maxNumber)
                for($i = count($item['equipments']); $i<$maxNumber; $i++){
                    $array[$key]['equipments'][$i]['name']= "";
                    $array[$key]['equipments'][$i]['volume']= "";
                }
        return DataTables::of($array)
            ->make(true);
    }
    public function ishlabchiqarishExport(){
        $numbers = DB::select(DB::raw("SELECT * FROM (SELECT * FROM productions as pro 
        WHERE year=(SELECT MAX(year) FROM productions as p WHERE p.user_id=pro.user_id)) as Shox
        WHERE month=(SELECT MAX(month) FROM productions as s WHERE s.user_id=Shox.user_id and s.year = Shox.year)"));

        $productions = Production::whereIn('id',collect($numbers)->pluck('id'))->withCount('equipments as cnt')->orderByDesc('year')->orderByDesc('month');
        $maxNumber = collect($productions->pluck('cnt'))->max();
        $array = $productions->with(['user'=>function($query){
            $query->with(['region' => function($quer){
                $quer->select('id','name');
            }])->with(['city' => function($quer){
                $quer->select('id','name');
            }])->select(['id','region_id','city_id','subject'])->get();
        }])->with(['equipments' => function($query){
            $query->select('name', 'volume');
        }])->select('id','user_id')->get()->toArray();
        foreach ($array as $key=>$item)
            if(count($item['equipments']) < $maxNumber)
                for($i = count($item['equipments']); $i<$maxNumber; $i++){
                    $array[$key]['equipments'][$i]['name']= "";
                    $array[$key]['equipments'][$i]['volume']= "";
                }


        foreach ($array as $key=>$item){
                $new[$key] = array();
            array_push($new[$key], $item['user']['id']);
            array_push($new[$key], $item['user']['subject']);
            array_push($new[$key], $item['user']['city']['name']);
            array_push($new[$key], $item['user']['region']['name']);
            foreach ($item['equipments'] as $equipment)
            {
                array_push($new[$key], $equipment['name']);
                array_push($new[$key], $equipment['volume']);
            }
        }
        $column1 = ['#',"Ишлаб чиқарувчи номи","Ҳудуд номи","Вилоят номи"];
        for ($i= 0; $i<$maxNumber; $i++){
            array_push($column1, "Ишлаб чиқариладиган жиҳоз");
        }
        $column2 = ['','','',''];
        for ($i= 0; $i<$maxNumber; $i++){
            array_push($column2, "Тури");
            array_push($column2, "Хажми");
        }

        Excel::create('Ishlab Chiqarish', function ($excel) use ($new, $column1, $column2) {
            $excel->sheet('Лист 1', function ($sheet) use ($new,$column1, $column2) {
                $sheet->mergeCells('A2:A3')->mergeCells('B2:B3')->mergeCells('C2:C3')->fromArray($new)
                ->appendRow(2, $column1)->appendRow(3, $column2);
            });
        })->download('xls');
    }
}
