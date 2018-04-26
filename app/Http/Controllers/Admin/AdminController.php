<?php

namespace App\Http\Controllers\Admin;

use App\Activity;
use App\Bank;
use App\City;
use App\Delivery;
use App\Equipment;
use App\Family;
use App\Leader;
use App\ProducedEquipment;
use App\Production;
use App\Region;
use App\User;
use App\Realization;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function nomma()
    {
        $sums = Delivery::join('regions', 'regions.id', 'deliveries.region_id')
            ->join('cities', 'cities.id', 'deliveries.city_id')
            ->select(DB::raw('SUM(deliveries.family_count) as sum_bees_count'), DB::raw('SUM(deliveries.labors) as sum_labors'))
            ->first();;

        return view('admin.nomma-nom')->withSums($sums)->withRegions(Region::all())->withCities(City::all());
    }

    public function submitNomma(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'type' => 'required',
            'region' => 'required|numeric',
            'city' => 'required|numeric',
            'activity' => 'required',
            'family_count' => 'required|numeric',
            'inn' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'labors' => 'required|numeric'
        ]);
        $delivery = new Delivery;
        $delivery->subject = $request->subject;
        $delivery->type = $request->type;
        $delivery->region_id = $request->region;
        $delivery->city_id = $request->city;
        $delivery->activity = $request->activity;
        $delivery->family_count = $request->family_count;
        $delivery->inn = $request->inn;
        $delivery->name = $request->name;
        $delivery->phone = $request->phone;
        $delivery->labors = $request->labors;
        $delivery->save();
        return redirect()->back()->with('message', "Jadval muvofaqiyatli ro'yhatdan o'tdi");
    }

    public function deleteNomma($id)
    {
        $delivery = Delivery::findOrFail($id);
        $delivery->delete();
        return redirect()->back()->with('message', "Jadval muvofaqiyatli ro'yhatdan o'chirildi");
    }

    public function updateNomma(Request $request, $id)
    {
        $request->validate([
            'subject' => 'required',
            'type' => 'required',
            'region' => 'required|numeric',
            'city' => 'required|numeric',
            'activity' => 'required',
            'family_count' => 'required|numeric',
            'inn' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'labors' => 'required|numeric'
        ]);
        $delivery = Delivery::findOrFail($id);
        $delivery->subject = $request->subject;
        $delivery->type = $request->type;
        $delivery->region_id = $request->region;
        $delivery->city_id = $request->city;
        $delivery->activity = $request->activity;
        $delivery->family_count = $request->family_count;
        $delivery->inn = $request->inn;
        $delivery->name = $request->name;
        $delivery->phone = $request->phone;
        $delivery->labors = $request->labors;
        $delivery->save();
        return redirect()->back()->with('message', "Jadval muvofaqiyatli o'zgartirildi");

    }


    public function swot()
    {
        $total = DB::select(DB::raw('SELECT count(*) as total, (SELECT count(*) from users where users.type<3) as yuridik, (SELECT count(*) from users where users.type=3) as yakka, (SELECT count(*) from users where users.type=4) as jismoniy, (SELECT sum(reserve) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1)) as reserves, (SELECT sum(annual_prog) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1)) as annual_prog, (SELECT sum(produced_honey) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1)) as produced_honey, (SELECT sum(realized_quantity) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1)) as realized_quantity, (SELECT sum(realized_price) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1)) as realized_price, (SELECT sum(stock_quantity) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1)) as stock_quantity, (SELECT sum(stock_price) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1)) as stock_price from users'));
        $activities = Activity::orderBy('id','desc')->get();
        return view('admin.swot')->withTotal($total)->withActivities($activities);
    }

    public function index()
    {

        $waiting_users = User::where('state', 0)->orderBy('id', 'desc')->paginate(10, ['*'], 'waiting');
        $accepted = User::where('state', 1)->orderBy('id', 'desc')->paginate(10, ['*'], 'accepted');
        $notAccepted = User::where('state', -1)->orderBy('id', 'desc')->paginate(10, ['*'], 'notAccepted');
        /*$temp = DB::select(DB::raw('SELECT max(realizations.id) from realizations inner join users on users.id=realizations.user_id group by user_id'));*/

        $groupByRegion = DB::select(DB::raw('SELECT count(*) as total, (SELECT name from regions where regions.id=us.region_id) as region, (SELECT count(*) from users as usr where usr.type=1 AND us.region_id=usr.region_id) as type1_count, (SELECT count(*) from users as usr where usr.type=2 AND us.region_id=usr.region_id) as type2_count, (SELECT count(*) from users as usr where usr.type=3 AND us.region_id=usr.region_id) as type3_count, (SELECT count(*) from users as usr where usr.type=4 AND us.region_id=usr.region_id) as type4_count, (SELECT sum(reserve) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as reserves, (SELECT sum(annual_prog) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as annual_prog, (SELECT sum(produced_honey) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as produced_honey, (SELECT sum(realized_quantity) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as realized_quantity, (SELECT sum(realized_price) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as realized_price, (SELECT sum(stock_quantity) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as stock_quantity, (SELECT sum(stock_price) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as stock_price from users as us  group by region_id'));

        $groupByCity = City::join('users', 'cities.id', 'users.city_id')
            ->join('regions', 'regions.id', 'cities.region_id')
            ->select('cities.name as city_name', 'regions.name as region_name', DB::raw('SUM(bees_count) as bees_count'), DB::raw('SUM(labors) as labors'))
            ->groupBy('cities.name')
            ->withCount(['user as total', 'user as yuridik' => function ($query) {
                $query->where('users.type', '<', 3);
            }, 'user as yakka' => function ($query) {
                $query->where('users.type', 3);
            }, 'user as jismoniy' => function ($query) {
                $query->where('users.type', 4);
            }])
            ->get();

        return view('admin.index')
            ->withRegions(Region::all())
            ->withLeaders(Leader::all())
            ->withActivities(Activity::all())
            ->withEquipments(Equipment::all())
            ->withWaiting($waiting_users)->withAccepted($accepted)->withNotAccepted($notAccepted)
            ->withFamilies(Family::all())->withTableRows($groupByRegion)->withSection11($groupByCity);

    }

    /*public function index2(){
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
    }*/
    public function ishlab()
    {
    /*      $numbers = DB::select(DB::raw("SELECT * FROM (SELECT * FROM productions as pro
            WHERE year=(SELECT MAX(year) FROM productions as p WHERE p.user_id=pro.user_id)) as Shox
            WHERE month=(SELECT MAX(month) FROM productions as s WHERE s.user_id=Shox.user_id and s.year = Shox.year)"));

            $productions = Production::whereIn('id',collect($numbers)->pluck('id'))->withCount('equipments as cnt')->orderByDesc('year')->orderByDesc('month');*/


        $numbers = DB::select(DB::raw("SELECT * FROM (SELECT * FROM productions as pro 
        WHERE year=(SELECT MAX(year) FROM productions as p WHERE p.user_id=pro.user_id)) as Shox
        WHERE month=(SELECT MAX(month) FROM productions as s WHERE s.user_id=Shox.user_id and s.year = Shox.year)"));

        $productions = Production::whereIn('id', collect($numbers)->pluck('id'))->withCount('equipments as cnt')->orderByDesc('year')->orderByDesc('month');
        $array = $productions->with(['user' => function ($query) {
            $query->with(['region' => function ($quer) {
                $quer->select('id', 'name');
            }])->with(['city' => function ($quer) {
                $quer->select('id', 'name');
            }])->select(['id', 'region_id', 'city_id', 'subject'])->get();
        }])->with(['equipments' => function ($query) {
            $query->select('name', 'volume', 'equipment_id');
        }])->select('id', 'user_id')->get()->toArray();

        foreach ($array as $i=> $item) {
            $arr = collect($item['equipments']);
            $new = $arr->keyBy(function ($item) {
                return $item['equipment_id'];
            });
            $array[$i]['equipments']= $new->toArray();
        }
        foreach ($array as $i=> $item) {
            $equipments = Equipment::orderBy('id','asc')->pluck('id');
            foreach ($equipments as $k => $equipment) {
                if(!array_key_exists($equipment, $item['equipments']))
                    $array[$i]['equipments'][$equipment] = ['name'=>'','volume'=>'','equipment_id'=>$equipment];
                else{
                    $array[$i]['equipments'][$equipment] = $item['equipments'][$equipment];
                }
            }

        }

        $sum = [];
        foreach ( Equipment::orderBy('id', 'asc')->get() as $eqp) {
            $sum[$eqp->id]=0;
            foreach ($array as $i => $item)
                if($item['equipments'][$eqp->id]['volume'] != null || $item['equipments'][$eqp->id]['volume'] != '')
                    $sum[$eqp->id] =$sum[$eqp->id]+($item['equipments'][$eqp->id]['volume']);
            }

        return view('admin.ishlab-chiqarish')->withEquipments( Equipment::orderBy('id', 'asc')->get())->withSum($sum);
    }

    public function deleteIshlabchiqarish($id)
    {
        $equipment = Production::findOrFail($id);
        $equipment->delete();
        return redirect()->back()->with('message', "Jadval muvofaqiyatli ro'yhatdan o'chirildi");
    }

    public function updateIshlabchiqarish(Request $request, $id)
    {

        $validation = Validator::make($request->all(), [
            'equipments.id.*' => 'exists:equipments,id',
            'equipments.volume.*' => 'nullable|numeric'
        ]);
        if ($validation->fails())
            dd($validation->errors());
        $production = Production::findOrFail($id);
        $production->equipments()->detach();
        foreach ($request->equipments as $equipment) {

            if ($equipment['volume'] != null) {
                $prod_eq = Equipment::findOrFail(intval($equipment['id']));
                $production->equipments()->attach($prod_eq, ['volume' => $equipment['volume']]);
            }
        }

        return redirect()->back()->with('message', "Jadval muvofaqiyatli o'zgartirildi");

    }

}
