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
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class AdminExcelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function exportNomma()
    {
        $collection = Delivery::join('regions', 'regions.id', 'deliveries.region_id')
            ->join('cities', 'cities.id', 'deliveries.city_id')
            ->select('deliveries.id', 'deliveries.subject', 'deliveries.type', 'regions.name as region', 'cities.name as city',
                'deliveries.activity', 'deliveries.family_count', 'deliveries.inn', 'deliveries.name', 'deliveries.phone',
                'deliveries.labors', 'regions.id as region_id', 'cities.id as city_id')
            ->get();
        $total = Delivery::join('regions', 'regions.id', 'deliveries.region_id')
            ->join('cities', 'cities.id', 'deliveries.city_id')
            ->select(DB::raw('SUM(deliveries.family_count) as sum_bees_count'), DB::raw('SUM(deliveries.labors) as sum_labors'))
            ->first();
        Excel::load('swot3.xls', function ($reader) use ($collection, $total) {
//            $sheet = $reader->getExcel()->getActiveSheet();
//            $sheet->appendRow(4, $collection);
            $reader->sheet(0, function ($sheet) use ($collection, $total) {
                foreach ($collection as $key => $item)
                    $sheet->appendRow((4 + $key), [$item->id, $item->subject, $item->type, $item->region, $item->city,
                        $item->activity, $item->family_count != null ? $item->family_count : 0,
                        $item->inn, $item->name, $item->phone, $item->labors]);
                $sheet->appendRow(['', 'Жами', '', '', '', '', $total->sum_bees_count, '', '', '', $total->sum_labors, '']);
                $sheet->setBorder('A4:K'.(count($collection)+4), 'thin');
            });


        })->export('xls');
        return redirect()->back()->withMessage('message', "Жадвал йукланди");
    }

    public function regionExport()
    {
        $groupByRegion = DB::select(DB::raw('SELECT count(*) as total,(SELECT id from regions where regions.id=us.region_id) as id, (SELECT name from regions where regions.id=us.region_id) as region, (SELECT count(*) from users as usr where usr.type<3 AND us.region_id=usr.region_id) as yuridik, (SELECT count(*) from users as usr where usr.type=3 AND us.region_id=usr.region_id) as yakka, (SELECT count(*) from users as usr where usr.type=4 AND us.region_id=usr.region_id) as jismoniy, (SELECT sum(reserve) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as reserves, (SELECT sum(annual_prog) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as annual_prog, (SELECT sum(produced_honey) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as produced_honey, (SELECT sum(honey_quantity) from users as usr where us.region_id=usr.region_id) as honey_quantity, (SELECT sum(realized_quantity) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as realized_quantity, (SELECT sum(realized_price) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as realized_price, (SELECT sum(stock_quantity) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as stock_quantity, (SELECT sum(stock_price) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1) AND us.region_id=users.region_id) as stock_price from users as us  group by region_id'));
        /*Excel::create('Етиштирилган ҳамда реализация қилинган асал миқдори тўғрисидаги ҳисобот.', function ($excel) use ($groupByRegion) {
            Excel::selectSheetsByIndex(0)->load('swot.xlsx');
        })->download('xls');*/
        $total = DB::select(DB::raw('SELECT count(*) as total, (SELECT count(*) from users where users.type<3) as yuridik, (SELECT count(*) from users where users.type=3) as yakka, (SELECT count(*) from users where users.type=4) as jismoniy, (SELECT sum(reserve) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1)) as reserves, (SELECT sum(annual_prog) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1)) as annual_prog, (SELECT sum(produced_honey) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1)) as produced_honey, (SELECT sum(honey_quantity) from users) as honey_quantity, (SELECT sum(realized_quantity) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1)) as realized_quantity, (SELECT sum(realized_price) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1)) as realized_price, (SELECT sum(stock_quantity) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1)) as stock_quantity, (SELECT sum(stock_price) from realizations inner join users on users.id=realizations.user_id where realizations.id =(select id from realizations as r WHERE r.user_id=realizations.user_id ORDER BY id DESC LIMIT 1)) as stock_price from users'));

//        $collection = json_decode( json_encode($groupByRegion), true);
        $collection = $groupByRegion;
        Excel::load('swot.xls', function ($reader) use ($collection, $total) {
//            $sheet = $reader->getExcel()->getActiveSheet();
//            $sheet->appendRow(4, $collection);
            $reader->sheet(0, function ($sheet) use ($collection, $total) {
                foreach ($collection as $key => $item)
                    $sheet->appendRow((5 + $key), [$item->region, $item->total, $item->yuridik, $item->yakka, $item->jismoniy,
                        $item->reserves != null ? $item->reserves : 0, $item->annual_prog != null ? $item->annual_prog : 0,
                        $item->produced_honey != null ? $item->produced_honey : 0, $item->honey_quantity != null ? $item->honey_quantity : 0, $item->realized_quantity != null ? $item->realized_quantity : 0,
                        $item->realized_price != null ? $item->realized_price : 0,
                        $item->stock_quantity != null ? $item->stock_quantity : 0, $item->stock_price != null ? $item->stock_price : 0]);
                $sheet->appendRow(['Жами',
                    $total[0]->total != null ? $total[0]->total : 0, $total[0]->yuridik != null ? $total[0]->yuridik : 0,
                    $total[0]->yakka != null ? $total[0]->yakka : 0, $total[0]->jismoniy != null ? $total[0]->jismoniy : 0,
                    $total[0]->reserves != null ? $total[0]->reserves : 0, $total[0]->annual_prog != null ? $total[0]->annual_prog : 0,
                    $total[0]->produced_honey != null ? $total[0]->produced_honey : 0, $item->honey_quantity != null ? $item->honey_quantity : 0, $total[0]->realized_quantity != null ? $total[0]->realized_quantity : 0,
                    $total[0]->realized_price != null ? $total[0]->realized_price : 0, $total[0]->stock_quantity != null ? $total[0]->stock_quantity : 0,
                    $total[0]->stock_price != null ? $total[0]->stock_price : 0]);

                $sheet->setBorder('A5:L'.(count($collection)+5), 'thin');
            });


        })->export('xls');
        return redirect()->back()->withMessage('message', "Жадвал йукланди");
    }

    public function swotExport($id = null)
    {
        $activities = Activity::orderBy('id', 'asc')->get();

        if ($id == null) {
            $groupByCity = City::join('users', 'cities.id', 'users.city_id')
                ->join('regions', 'regions.id', 'cities.region_id')
                ->leftJoin('works', 'works.user_id', 'users.id')->leftJoin('activities', 'activities.id', 'works.activity_id')
                ->select('regions.name as region_name', 'cities.name as city_name', 'works.activity_id as activity_id')
                ->withCount(['user as total', 'user as yuridik' => function ($query) {
                    $query->where('users.type', '<', 3);
                }, 'user as yakka' => function ($query) {
                    $query->where('users.type', 3);
                }, 'user as jismoniy' => function ($query) {
                    $query->where('users.type', 4);
                }])
                ->addSelect(DB::raw('SUM(honey_quantity) as honey_quantity'), DB::raw('SUM(bees_count) as bees_count'), DB::raw('SUM(labors) as labors'));

        } else {
            $groupByCity = City::join('users', 'cities.id', 'users.city_id')
                ->join('regions', 'regions.id', 'cities.region_id')
                ->where('regions.id', $id)
                ->leftJoin('works', 'works.user_id', 'users.id')->leftJoin('activities', 'activities.id', 'works.activity_id')
                ->select('regions.name as region_name', 'cities.name as city_name', 'works.activity_id as activity_id')
                ->withCount(['user as total', 'user as yuridik' => function ($query) {
                    $query->where('users.type', '<', 3);
                }, 'user as yakka' => function ($query) {
                    $query->where('users.type', 3);
                }, 'user as jismoniy' => function ($query) {
                    $query->where('users.type', 4);
                }])
                ->addSelect(DB::raw('SUM(honey_quantity) as honey_quantity'), DB::raw('SUM(bees_count) as bees_count'), DB::raw('SUM(labors) as labors'));


        }
        foreach ($activities as $activity) {
            $groupByCity->addSelect(DB::raw('COUNT(CASE WHEN activity_id = ' . $activity->id . ' then activity_id end) as activity' . $activity->id));
        }


        $collection = $groupByCity->groupBy('cities.id')->get();;

        $column2 = $this->createLetterRange($activities->count() + 8);
        foreach (range(0, 7) as $i)
            unset($column2[$i]);

        $column = ['Ҳудуд','Туман номи','Уюшмага аъзо субъектлар сони','Субъектлар','','','Етиштирилган асал миқдори (кг)','Боқилаётган асалари оилалари сони','Ишчилар сони','Фаолият тури'];
        $column1= ['','','','Юридик шахслар (МЧЖ, ХК, ҚК, ДХ)','ЯТТ ва юридик шахс мақомимига эга бўлмаган Деҳконхўжаликлари','Шахсий ёрдамчи хўжаликлари (жисмоний шахслар)','',''];
        foreach ($activities as $activity) {
            array_push($column1, $activity->name);
        }
        Excel::load('swot2.xls', function ($reader) use ($collection, $activities, $column2,$column, $column1) {
//            $sheet = $reader->getExcel()->getActiveSheet();
//            $sheet->appendRow(4, $collection);
            $reader->sheet(0, function ($sheet) use ($collection, $activities, $column2, $column, $column1) {

                $sheet->mergeCells(reset($column2) . '3:' . end($column2) . '3')
                    ->appendRow(3, $column)
                    ->appendRow(4, $column1);
                foreach ($collection as $key => $item) {
                    $array = [$item->region_name, $item->city_name, $item->total != null ? $item->total : 0,
                        $item->yuridik, $item->yakka, $item->jismoniy, $item->honey_quantity!=null ? $item->honey_quantity:0, $item->bees_count != null ? $item->bees_count : 0,
                        $item->labors != null ? $item->labors : 0];
                    foreach ($activities as $activity)
                        array_push($array, $item['activity' . $activity->id]);

                    $sheet->appendRow((5 + $key), $array);
                }
                $sheet->setBorder('A3:' . end($column2) . ($collection->count() + 4), 'thin');
                $sheet->setAutoSize(true);
            });


        })->export('xls');
        return redirect()->back()->withMessage('message', "Жадвал йукланди");
    }

    public function ishlabchiqarishExport()
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
        $sum = [];
        foreach (Equipment::orderBy('id', 'asc')->get() as $eqp) {
            $sum[$eqp->id] = 0;
            foreach ($array as $i => $item)
                if ($item['equipments'][$eqp->id]['volume'] != null || $item['equipments'][$eqp->id]['volume'] != '')
                    $sum[$eqp->id] = $sum[$eqp->id] + ($item['equipments'][$eqp->id]['volume']);
        }

        array_unshift($sum, '', 'Жами', '', '');

        $column1 = ['№', "Ишлаб чиқарувчи номи", "Ҳудуд номи", "Вилоят номи", "Ишлаб чиқариладиган жиҳоз"];
        $col_eq = ['', '', '', ''];
        $equipments = Equipment::orderBy('id', 'asc')->get();
        foreach ($equipments as $equipment) {
            array_push($col_eq, $equipment->name);
        }
        $column2 = $this->createLetterRange($equipments->count() + 4);
        unset($column2[0]);
        unset($column2[1]);
        unset($column2[2]);
        unset($column2[3]);


        Excel::create('Ishlab Chiqarish', function ($excel) use ($array, $column1, $column2, $col_eq, $sum) {
            $excel->sheet(0, function ($sheet) use ($array, $column1, $column2, $col_eq, $sum) {
                $sheet->mergeCells('A2:A3')->mergeCells('B2:B3')->mergeCells('C2:C3')->mergeCells('D2:D3')
                    ->mergeCells(reset($column2) . '2:' . end($column2) . '2');
                $sheet->appendRow(2, $column1)->appendRow(3, $col_eq);

                foreach ($array as $iter => $item) {
                    $new_array[0] = $item['id'];
                    $new_array[1] = $item['user']['subject'];
                    $new_array[2] = $item['user']['region']['name'];
                    $new_array[3] = $item['user']['city']['name'];
                    foreach ($item['equipments'] as $key => $equipment)
                        $new_array[4 + $key] = $equipment['volume'];

                    $sheet->appendRow(4 + $iter, $new_array);
                }
                $sheet->appendRow($sum);
                $sheet->setAutoSize(true);
                $sheet->setBorder('A2:' . end($column2) . (count($array) + 4), 'thin');
            });
        })->download('xls');

        return redirect()->back()->withMessage('message', "Жадвал йукланди");
    }
    public function usersExport($id = null){
        if ($id == null) {
            $users = User::join('regions', 'regions.id', 'users.region_id')->join('cities', 'cities.id', 'users.city_id')->orderByDesc('id');
            $users= $users->select('users.*','regions.name as region_name', 'cities.name as city_name' )->addSelect(DB::raw('(CASE WHEN type<3 then \'Юридик корхоналар (МЧЖ, ХК, ҚК)\' WHEN type=3 then \'ЯТТ ва юридик шахс мақомимига эга бўлмаган Деҳконхўжаликлари\' WHEN type=4 then \'Шаҳсий ёрдамчи хўжалик (Жисмоний Шаҳслар)\' end) as user_type'));

        } else {
            $users = User::join('regions', 'regions.id', 'users.region_id')->join('cities', 'cities.id', 'users.city_id')->orderByDesc('id')->where('city_id', $id);
            $users= $users->select('users.*','regions.name as region_name', 'cities.name as city_name')->addSelect(DB::raw('(CASE WHEN type<3 then \'Юридик корхоналар (МЧЖ, ХК, ҚК)\' WHEN type=3 then \'ЯТТ ва юридик шахс мақомимига эга бўлмаган Деҳконхўжаликлари\' WHEN type=4 then \'Шаҳсий ёрдамчи хўжалик (Жисмоний Шаҳслар)\' end) as user_type'));
        }
        $array = $users->get();

        $column1 = ['Т/Р', "Субъект номи", "Вилоят номи", "Туман/шаҳар номи", "Маҳалла (МФЙ) номи",
            "Корхона давлат рўйҳатидан ўтган сана","СТИР (ИНН)","Банк МФО","Хизмат кўрсатиладиган банк номи","Манзил",
            "Телефон рақами","Электрон почта","Хўжалик раҳбари исми шарифи","Етиштирилган асал миқдори (кг)","Ишчилар сони","Боқлаётган асалари оилалари сони"];


        Excel::create('Аъзолар', function ($excel) use ($array, $column1) {

            $excel->sheet(0, function ($sheet) use ($array, $column1) {
                $sheet->mergeCells('A1:O1')->appendRow(1,['Асаларичи субъектларининг сони']);
                $sheet->cells('A1:O1', function($cells) {
                    $cells->setFontWeight('bold');
                });
                $sheet->cells('A3:O3', function($cells) {
                    $cells->setFontWeight('bold');
                });
                $sheet->appendRow(3, $column1);
                foreach ($array as $i => $item) {
                    $sheet->appendRow(4 + $i, [
                        $item->id, ($item->subject != null || $item->subject != '' ) ? $item->subject : $item->fullName, $item->region_name, $item->city_name, $item->neighborhood,
                        $item->reg_date, $item->inn, $item->mfo, $item->bank_name, $item->address, '+'.$item->phone.'', $item->email,
                        $item->fullName, $item->honey_quantity!=null ? $item->honey_quantity:0, $item->labors, $item->bees_count]);
                }
                $sheet->setBorder('A3:O'.($array->count()+3), 'thin');
            });
        })->download('xls');

    }

    function createLetterRange($length)
    {
        $range = array();
        $letters = range('A', 'Z');
        for ($i = 0; $i < $length; $i++) {
            $position = $i * 26;
            foreach ($letters as $ii => $letter) {
                $position++;
                if ($position <= $length)
                    $range[] = ($position > 26 ? $range[$i - 1] : '') . $letter;
            }
        }
        return $range;
    }
}
