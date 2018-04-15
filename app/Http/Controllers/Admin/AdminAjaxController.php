<?php

namespace App\Http\Controllers\Admin;

use App\Activity;
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

class AdminAjaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function ishlabchiqarish()
    {
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

    public function getNomma()
    {
        $deliveries = Delivery::join('regions', 'regions.id', 'deliveries.region_id')
            ->join('cities', 'cities.id', 'deliveries.city_id')
            ->select('deliveries.id', 'deliveries.subject', 'deliveries.type', 'regions.name as region', 'cities.name as city', 'deliveries.activity', 'deliveries.family_count', 'deliveries.inn', 'deliveries.name', 'deliveries.phone', 'deliveries.labors', 'regions.id as region_id', 'cities.id as city_id')
            ->get();

        return DataTables::of($deliveries)->make(true);

    }

    public function getRegion()
    {
        $groupByRegion = DB::select(DB::raw('SELECT count(*) as total,(SELECT id from regions where regions.id=us.region_id) as id, (SELECT name from regions where regions.id=us.region_id) as region, (SELECT count(*) from users as usr where usr.type<3 AND us.region_id=usr.region_id) as yuridik, (SELECT count(*) from users as usr where usr.type=3 AND us.region_id=usr.region_id) as yakka, (SELECT count(*) from users as usr where usr.type=4 AND us.region_id=usr.region_id) as jismoniy, (SELECT sum(reserve) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as reserves, (SELECT sum(annual_prog) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as annual_prog, (SELECT sum(produced_honey) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as produced_honey, (SELECT sum(realized_quantity) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as realized_quantity, (SELECT sum(realized_price) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as realized_price, (SELECT sum(stock_quantity) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as stock_quantity, (SELECT sum(stock_price) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as stock_price from users as us  group by region_id'));
        return DataTables::of($groupByRegion)
            ->make(true);
    }

    public function getSwot($id = null)
    {
        $activities = Activity::orderBy('id','asc')->get();

        if ($id == null) {
            $groupByCity = City::join('users', 'cities.id', 'users.city_id')
                ->join('regions', 'regions.id', 'cities.region_id')
                ->leftJoin('works','works.user_id','users.id')->leftJoin('activities','activities.id','works.activity_id')
                ->select('regions.name as region_name', 'cities.name as city_name','works.activity_id as activity_id')
                ->withCount(['user as total', 'user as yuridik' => function ($query) {
                    $query->where('users.type', '<', 3);
                }, 'user as yakka' => function ($query) {
                    $query->where('users.type', 3);
                }, 'user as jismoniy' => function ($query) {
                    $query->where('users.type', 4);
                }])
                ->addSelect(DB::raw('SUM(bees_count) as bees_count'), DB::raw('SUM(labors) as labors'));

        } else {
            $groupByCity = City::join('users', 'cities.id', 'users.city_id')
                ->join('regions', 'regions.id', 'cities.region_id')
                ->where('regions.id', $id)
                ->leftJoin('works','works.user_id','users.id')->leftJoin('activities','activities.id','works.activity_id')
                ->select('regions.name as region_name', 'cities.name as city_name','works.activity_id as activity_id')
                ->withCount(['user as total', 'user as yuridik' => function ($query) {
                    $query->where('users.type', '<', 3);
                }, 'user as yakka' => function ($query) {
                    $query->where('users.type', 3);
                }, 'user as jismoniy' => function ($query) {
                    $query->where('users.type', 4);
                }])
                ->addSelect(DB::raw('SUM(bees_count) as bees_count'), DB::raw('SUM(labors) as labors'));


        }
        foreach ($activities as $activity){
            $groupByCity->addSelect(DB::raw('COUNT(CASE WHEN activity_id = '.$activity->id.' then activity_id end) as activity'.$activity->id));
        }

        $groupByCity->groupBy('cities.id');


//        DB::raw('COUNT(CASE WHEN activity_id = 1 then activity_id end) as activity1')
       /* $groupByCity->addSelect(DB::raw('COUNT(activity_id) as activity1'))->whereRaw('activity_id = '.(1));
        ;*/
        return DataTables::of($groupByCity)
            ->make(true);
    }

}
