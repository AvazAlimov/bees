<?php

namespace App\Http\Controllers\Admin;

use App\Activity;
use App\City;
use App\Delivery;
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
    public function nomma(){
        $sums = Delivery::join('regions','regions.id','deliveries.region_id')
            ->join('cities','cities.id','deliveries.city_id')
            ->select(DB::raw('SUM(deliveries.family_count) as sum_bees_count'), DB::raw('SUM(deliveries.labors) as sum_labors'))
            ->first();;

        return view('admin.nomma-nom')->withSums($sums)->withRegions(Region::all())->withCities(City::all());
    }
    public function submitNomma(Request $request){
        $request->validate([
            'subject'=>'required',
            'type'=>'required',
            'region'=>'required|numeric',
            'city'=>'required|numeric',
            'activity'=>'required',
            'family_count'=>'required|numeric',
            'inn'=>'required',
            'name'=>'required',
            'phone'=>'required',
            'labors'=>'required|numeric'
         ]);
        $delivery = new Delivery;
        $delivery->subject = $request->subject;
        $delivery->type = $request->type;
        $delivery->region_id = $request->region;
        $delivery->city_id = $request->city;
        $delivery->activity = $request->activity;
        $delivery->family_count =$request->family_count;
        $delivery->inn = $request->inn;
        $delivery->name = $request->name;
        $delivery->phone =  $request->phone;
        $delivery->labors = $request->labors;
        $delivery->save();
        return redirect()->back()->with('message',"Jadval muvofaqiyatli ro'yhatdan o'tdi");
    }
    public function deleteNomma($id){
       $delivery = Delivery::findOrFail($id);
       $delivery->delete();
       return redirect()->back()->with('message',"Jadval muvofaqiyatli ro'yhatdan o'chirildi");
    }
    public function updateNomma(Request $request, $id)
    {
        $request->validate([
            'subject'=>'required',
            'type'=>'required',
            'region'=>'required|numeric',
            'city'=>'required|numeric',
            'activity'=>'required',
            'family_count'=>'required|numeric',
            'inn'=>'required',
            'name'=>'required',
            'phone'=>'required',
            'labors'=>'required|numeric'
        ]);
        $delivery = Delivery::findOrFail($id);
        $delivery->subject = $request->subject;
        $delivery->type = $request->type;
        $delivery->region_id = $request->region;
        $delivery->city_id = $request->city;
        $delivery->activity = $request->activity;
        $delivery->family_count =$request->family_count;
        $delivery->inn = $request->inn;
        $delivery->name = $request->name;
        $delivery->phone =  $request->phone;
        $delivery->labors = $request->labors;
        $delivery->save();
    }
    public function getNomma(){
     $deliveries= Delivery::join('regions','regions.id','deliveries.region_id')
          ->join('cities','cities.id','deliveries.city_id')
          ->select('deliveries.id','deliveries.subject','deliveries.type','regions.name as region','cities.name as city','deliveries.activity','deliveries.family_count','deliveries.inn','deliveries.name','deliveries.phone','deliveries.labors','regions.id as region_id', 'cities.id as city_id')
        ->get();

     return DataTables::of($deliveries)->make(true);

    }
    public function exportNomma(){
        $collection= Delivery::join('regions','regions.id','deliveries.region_id')
            ->join('cities','cities.id','deliveries.city_id')
            ->select('deliveries.id','deliveries.subject','deliveries.type','regions.name as region','cities.name as city',
                'deliveries.activity','deliveries.family_count','deliveries.inn','deliveries.name','deliveries.phone',
                'deliveries.labors','regions.id as region_id', 'cities.id as city_id')
            ->get();
        $total = Delivery::join('regions','regions.id','deliveries.region_id')
            ->join('cities','cities.id','deliveries.city_id')
            ->select(DB::raw('SUM(deliveries.family_count) as sum_bees_count'), DB::raw('SUM(deliveries.labors) as sum_labors'))
            ->first();
        Excel::load('swot3.xls', function($reader) use ($collection, $total)
        {
//            $sheet = $reader->getExcel()->getActiveSheet();
//            $sheet->appendRow(4, $collection);
            $reader->sheet(0, function($sheet) use ($collection, $total) {
                foreach ($collection as $key => $item)
                    $sheet->appendRow((4+$key), [$item->id, $item->subject,$item->type,$item->region,$item->city,
                        $item->activity, $item->family_count != null ? $item->family_count : 0,
                        $item->inn, $item->name,$item->phone,$item->labors]);
                $sheet->appendRow(['','Жами','','','','',$total->sum_bees_count,'','','',$total->sum_labors,'']);
            });


        })->export('xlsx');
    }
    public function getRegion(){
        $groupByRegion = DB::select(DB::raw('SELECT count(*) as total,(SELECT id from regions where regions.id=us.region_id) as id, (SELECT name from regions where regions.id=us.region_id) as region, (SELECT count(*) from users as usr where usr.type<3 AND us.region_id=usr.region_id) as yuridik, (SELECT count(*) from users as usr where usr.type=3 AND us.region_id=usr.region_id) as yakka, (SELECT count(*) from users as usr where usr.type=4 AND us.region_id=usr.region_id) as jismoniy, (SELECT sum(reserve) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as reserves, (SELECT sum(annual_prog) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as annual_prog, (SELECT sum(produced_honey) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as produced_honey, (SELECT sum(realized_quantity) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as realized_quantity, (SELECT sum(realized_price) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as realized_price, (SELECT sum(stock_quantity) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as stock_quantity, (SELECT sum(stock_price) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as stock_price from users as us  group by region_id'));
        return DataTables::of($groupByRegion)
            ->make(true);
    }
    public function regionExport(){
        $groupByRegion = DB::select(DB::raw('SELECT count(*) as total,(SELECT id from regions where regions.id=us.region_id) as id, (SELECT name from regions where regions.id=us.region_id) as region, (SELECT count(*) from users as usr where usr.type<3 AND us.region_id=usr.region_id) as yuridik, (SELECT count(*) from users as usr where usr.type=3 AND us.region_id=usr.region_id) as yakka, (SELECT count(*) from users as usr where usr.type=4 AND us.region_id=usr.region_id) as jismoniy, (SELECT sum(reserve) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as reserves, (SELECT sum(annual_prog) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as annual_prog, (SELECT sum(produced_honey) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as produced_honey, (SELECT sum(realized_quantity) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as realized_quantity, (SELECT sum(realized_price) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as realized_price, (SELECT sum(stock_quantity) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as stock_quantity, (SELECT sum(stock_price) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as stock_price from users as us  group by region_id'));
        /*Excel::create('Етиштирилган ҳамда реализация қилинган асал миқдори тўғрисидаги ҳисобот.', function ($excel) use ($groupByRegion) {
            Excel::selectSheetsByIndex(0)->load('swot.xlsx');
        })->download('xls');*/
        $total = DB::select(DB::raw('SELECT count(*) as total, (SELECT count(*) from users where users.type<3) as yuridik, (SELECT count(*) from users where users.type=3) as yakka, (SELECT count(*) from users where users.type=4) as jismoniy, (SELECT sum(reserve) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1)) as reserves, (SELECT sum(annual_prog) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1)) as annual_prog, (SELECT sum(produced_honey) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1)) as produced_honey, (SELECT sum(realized_quantity) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1)) as realized_quantity, (SELECT sum(realized_price) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1)) as realized_price, (SELECT sum(stock_quantity) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1)) as stock_quantity, (SELECT sum(stock_price) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1)) as stock_price from users'));

//        $collection = json_decode( json_encode($groupByRegion), true);
      $collection = $groupByRegion;
        Excel::load('swot.xls', function($reader) use ($collection, $total)
        {
//            $sheet = $reader->getExcel()->getActiveSheet();
//            $sheet->appendRow(4, $collection);
            $reader->sheet(0, function($sheet) use ($collection, $total) {
                foreach ($collection as $key => $item)
                    $sheet->appendRow((5+$key), [$item->region, $item->total,$item->yuridik,$item->yakka,$item->jismoniy,
                        $item->reserves != null ? $item->reserves : 0, $item->annual_prog != null ? $item->annual_prog : 0,
                        $item->produced_honey != null ? $item->produced_honey : 0, $item->realized_quantity != null ? $item->realized_quantity : 0,
                        $item->realized_price != null ? $item->realized_price : 0,
                        $item->stock_quantity != null ? $item->stock_quantity : 0, $item->stock_price != null ? $item->stock_price : 0]);
                    $sheet->appendRow(['Жами',
                        $total[0]->total != null ? $total[0]->total : 0 ,$total[0]->yuridik != null ? $total[0]->yuridik : 0,
                        $total[0]->yakka != null ? $total[0]->yakka : 0, $total[0]->jismoniy != null ? $total[0]->jismoniy: 0,
                        $total[0]->reserves != null ? $total[0]->reserves : 0, $total[0]->annual_prog != null ? $total[0]->annual_prog : 0,
                        $total[0]->produced_honey != null ? $total[0]->produced_honey  : 0, $total[0]->realized_quantity != null ? $total[0]->realized_quantity: 0,
                        $total[0]->realized_price != null ? $total[0]->realized_price : 0,$total[0]->stock_quantity != null ? $total[0]->stock_quantity : 0,
                        $total[0]->stock_price != null ? $total[0]->stock_price: 0]);
            });


        })->export('xlsx');
    }
    public function swot(){
        $total = DB::select(DB::raw('SELECT count(*) as total, (SELECT count(*) from users where users.type<3) as yuridik, (SELECT count(*) from users where users.type=3) as yakka, (SELECT count(*) from users where users.type=4) as jismoniy, (SELECT sum(reserve) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1)) as reserves, (SELECT sum(annual_prog) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1)) as annual_prog, (SELECT sum(produced_honey) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1)) as produced_honey, (SELECT sum(realized_quantity) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1)) as realized_quantity, (SELECT sum(realized_price) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1)) as realized_price, (SELECT sum(stock_quantity) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1)) as stock_quantity, (SELECT sum(stock_price) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1)) as stock_price from users'));
        $activities = Activity::all();
        return view('admin.swot')->withTotal($total)->withActivities($activities);
    }
    public function getSwot($id = null){
        if($id == null){
            $groupByCity = City::join('users', 'cities.id', 'users.city_id')
                ->join('regions', 'regions.id', 'cities.region_id')
                ->join('works', 'works.user_id', 'users.id')
                ->leftJoin('activities','activities.id','=','works.activity_id')
                ->select( 'regions.name as region_name', 'cities.name as city_name')
                ->withCount(['user as total', 'user as yuridik' => function ($query) {$query->where('users.type', '<', 3);}, 'user as yakka' => function ($query) {$query->where('users.type', 3);}, 'user as jismoniy' => function ($query) {$query->where('users.type', 4);}])
                ->addSelect(DB::raw('SUM(bees_count) as bees_count'), DB::raw('SUM(labors) as labors'), DB::raw('count(activities.id) as qwerty'))
                ->groupBy('cities.name')
                ->get();
        }else{
            $groupByCity = City::join('users', 'cities.id', 'users.city_id')
                ->join('regions', 'regions.id', 'cities.region_id')
                ->where('regions.id', $id)
                ->select( 'regions.name as region_name', 'cities.name as city_name')
                ->withCount(['user as total', 'user as yuridik' => function ($query) {$query->where('users.type', '<', 3);}, 'user as yakka' => function ($query) {$query->where('users.type', 3);}, 'user as jismoniy' => function ($query) {$query->where('users.type', 4);}])
                ->addSelect(DB::raw('SUM(bees_count) as bees_count'), DB::raw('SUM(labors) as labors'))
                ->groupBy('cities.name')
                ->get();

        }

        return DataTables::of($groupByCity)
            ->make(true);
    }
    public function swotExport($id = null){
        if($id == null){
            $groupByCity = City::join('users', 'cities.id', 'users.city_id')
                ->join('regions', 'regions.id', 'cities.region_id')
                ->select( 'regions.name as region_name', 'cities.name as city_name')
                ->withCount(['user as total', 'user as yuridik' => function ($query) {$query->where('users.type', '<', 3);}, 'user as yakka' => function ($query) {$query->where('users.type', 3);}, 'user as jismoniy' => function ($query) {$query->where('users.type', 4);}])
                ->addSelect(DB::raw('SUM(bees_count) as bees_count'), DB::raw('SUM(labors) as labors'))
                ->groupBy('cities.name')
                ->get();
        }else{
            $groupByCity = City::join('users', 'cities.id', 'users.city_id')
                ->join('regions', 'regions.id', 'cities.region_id')
                ->where('regions.id', $id)
                ->select( 'regions.name as region_name', 'cities.name as city_name')
                ->withCount(['user as total', 'user as yuridik' => function ($query) {$query->where('users.type', '<', 3);}, 'user as yakka' => function ($query) {$query->where('users.type', 3);}, 'user as jismoniy' => function ($query) {$query->where('users.type', 4);}])
                ->addSelect(DB::raw('SUM(bees_count) as bees_count'), DB::raw('SUM(labors) as labors'))
                ->groupBy('cities.name')
                ->get();

        }
        $collection = $groupByCity;
        Excel::load('swot2.xls', function($reader) use ($collection)
        {
//            $sheet = $reader->getExcel()->getActiveSheet();
//            $sheet->appendRow(4, $collection);
            $reader->sheet(0, function($sheet) use ($collection) {
                foreach ($collection as $key => $item)
                    $sheet->appendRow((5+$key), [$item->region_name, $item->city_name, $item->total != null ? $item->total : 0,
                        $item->yuridik, $item->yakka, $item->jismoniy, $item->bees_count != null ? $item->bees_count : 0,
                        $item->labors != null ? $item->labors : 0]);
            });


        })->export('xlsx');
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
