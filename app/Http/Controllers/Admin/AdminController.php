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
    public function swot(){
        return view('admin.swot');
    }
    public function getSwot($id = null){
        if($id == null){
            $groupByCity = City::join('users', 'cities.id', 'users.city_id')
                ->join('regions', 'regions.id', 'cities.region_id')
                ->select('cities.name as city_name', 'regions.name as region_name', DB::raw('SUM(bees_count) as bees_count'), DB::raw('SUM(labors) as labors'))
                ->groupBy('cities.name')
                ->withCount(['user as total', 'user as yuridik' => function ($query) {$query->where('users.type', '<', 3);}, 'user as yakka' => function ($query) {$query->where('users.type', 3);}, 'user as jismoniy' => function ($query) {$query->where('users.type', 4);}])
                ->get();
        }else{
            $groupByCity = City::join('users', 'cities.id', 'users.city_id')
                ->join('regions', 'regions.id', 'cities.region_id')
                ->where('regions.id',$id)
                ->select('cities.id as id','cities.name as city_name', 'regions.name as region_name', DB::raw('SUM(bees_count) as bees_count'), DB::raw('SUM(labors) as labors'))
                ->groupBy('cities.name')
                ->withCount(['user as total', 'user as yuridik' => function ($query) {$query->where('users.type', '<', 3);}, 'user as yakka' => function ($query) {$query->where('users.type', 3);}, 'user as jismoniy' => function ($query) {$query->where('users.type', 4);}])
                ->get();

        }
        return DataTables::of($groupByCity)
            ->make(true);
    }
    public function getRegion(){
        $groupByRegion = DB::select(DB::raw('SELECT count(*) as total,(SELECT id from regions where regions.id=us.region_id) as id, (SELECT name from regions where regions.id=us.region_id) as region, (SELECT count(*) from users as usr where usr.type=1 AND us.region_id=usr.region_id) as type1_count, (SELECT count(*) from users as usr where usr.type=2 AND us.region_id=usr.region_id) as type2_count, (SELECT count(*) from users as usr where usr.type=3 AND us.region_id=usr.region_id) as type3_count, (SELECT count(*) from users as usr where usr.type=4 AND us.region_id=usr.region_id) as type4_count, (SELECT sum(reserve) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as reserves, (SELECT sum(annual_prog) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as annual_prog, (SELECT sum(produced_honey) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as produced_honey, (SELECT sum(realized_quantity) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as realized_quantity, (SELECT sum(realized_price) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as realized_price, (SELECT sum(stock_quantity) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as stock_quantity, (SELECT sum(stock_price) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as stock_price from users as us  group by region_id'));
        return DataTables::of($groupByRegion)
            ->make(true);
    }
    public function index(){

        $waiting_users = User::where('state',0)->orderBy('id', 'desc')->paginate(10, ['*'], 'waiting');
        $accepted = User::where('state',1)->orderBy('id', 'desc')->paginate(10, ['*'], 'accepted');
        $notAccepted = User::where('state',-1)->orderBy('id', 'desc')->paginate(10, ['*'], 'notAccepted');
        /*$temp = DB::select(DB::raw('SELECT max(realizations.id) from realizations inner join users on users.id=realizations.user_id group by user_id'));*/
        
        $groupByRegion = DB::select(DB::raw('SELECT count(*) as total, (SELECT name from regions where regions.id=us.region_id) as region, (SELECT count(*) from users as usr where usr.type=1 AND us.region_id=usr.region_id) as type1_count, (SELECT count(*) from users as usr where usr.type=2 AND us.region_id=usr.region_id) as type2_count, (SELECT count(*) from users as usr where usr.type=3 AND us.region_id=usr.region_id) as type3_count, (SELECT count(*) from users as usr where usr.type=4 AND us.region_id=usr.region_id) as type4_count, (SELECT sum(reserve) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as reserves, (SELECT sum(annual_prog) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as annual_prog, (SELECT sum(produced_honey) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as produced_honey, (SELECT sum(realized_quantity) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as realized_quantity, (SELECT sum(realized_price) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as realized_price, (SELECT sum(stock_quantity) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as stock_quantity, (SELECT sum(stock_price) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as stock_price from users as us  group by region_id'));

        $groupByCity = City::join('users', 'cities.id', 'users.city_id')
                            ->join('regions', 'regions.id', 'cities.region_id')
                            ->select('cities.name as city_name', 'regions.name as region_name', DB::raw('SUM(bees_count) as bees_count'), DB::raw('SUM(labors) as labors'))
                            ->groupBy('cities.name')
                            ->withCount(['user as total', 'user as yuridik' => function ($query) {$query->where('users.type', '<', 3);}, 'user as yakka' => function ($query) {$query->where('users.type', 3);}, 'user as jismoniy' => function ($query) {$query->where('users.type', 4);}])
                            ->get();
                             
        return view('admin.index')
            ->withRegions(Region::all())
            ->withLeaders(Leader::all())
            ->withActivities(Activity::all())
            ->withEquipments(Equipment::all())
            ->withWaiting($waiting_users)->withAccepted($accepted)->withNotAccepted($notAccepted)
            ->withFamilies(Family::all())->withTableRows($groupByRegion)->withSection11($groupByCity);

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

    public function index3(){
        $groupByCity = User::groupBy('city_id')->withCount('id');
        dd($groupByCity); 
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
