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
        /*$temp = DB::select(DB::raw('SELECT max(realizations.id) from realizations inner join users on users.id=realizations.user_id group by user_id'));*/
        
        $groupByRegion = DB::select(DB::raw('SELECT region_id, count(*) as total, (SELECT count(*) from users as usr where usr.type=1 AND us.region_id=usr.region_id) as type1_count, (SELECT count(*) from users as usr where usr.type=2 AND us.region_id=usr.region_id) as type2_count, (SELECT count(*) from users as usr where usr.type=3 AND us.region_id=usr.region_id) as type3_count, (SELECT count(*) from users as usr where usr.type=4 AND us.region_id=usr.region_id) as type4_count, (SELECT sum(reserve) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select max(r.id) from realizations as r group by r.user_id having r.user_id=realizations.user_id) AND users.id=us.id group by region_id) as reserves from users as us  group by region_id'));
        dd($groupByRegion);

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
            ->withProductions($productions->get())
            ->withWaiting($waiting_users)->withAccepted($accepted)->withNotAccepted($notAccepted)
            ->withFamilies(Family::all());

    }
}
