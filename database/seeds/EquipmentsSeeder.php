<?php
use Illuminate\Database\Seeder;
use Faker\Factory;
use App\User;
use App\Leader;
use App\Region;
use App\City;
use App\Activity;
use App\Admin;
use App\Bank;
use App\Family;
use App\Realization;
use Maatwebsite\Excel\Facades\Excel;
use App\Equipment;
use App\Production;
use App\ProducedEquipments;
use App\Delivery;
class EquipmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Factory::create();
        Leader::truncate();
        Region::truncate();
        City::truncate();
        Activity::truncate();
        User::truncate();
        Admin::truncate();
        Family::truncate();
        Bank::truncate();
        Realization::truncate();
        foreach (range(1, 13) as $i) {
            Leader::create([
                'username' => 'U' . sprintf("%07d", $i),
                'email' => $faker->email,
                'password' => bcrypt('password'),
                'lastName' => $faker->lastName,
                'firstName' => $faker->firstName,
                'phone' => $faker->phoneNumber,
            ]);
        }

        $result = Excel::load(public_path('hudud.xlsx'))->getExcel()->getSheet(0)->toArray();
        $result = collect($result);
        $items = $result->sortBy(function ($item) {
            return $item[3];
        })->except(['0', '1'])->unique('3')->pluck('1', '3');
        foreach ($items as $key => $item) {
            Region::create([
                'id' => $key,
                'name' => substr($item, 0, 190),
            ]);
            $result2 = Excel::load(public_path('hudud.xlsx'))->getExcel()->getSheet(0)->toArray();
            $result2 = collect($result2);
            $items2 = $result2->sortBy(function ($item) {
                return $item[3];
            })->except(['0', '1'])->where('3', sprintf("%02d", $key))->pluck('2', '0');
            foreach ($items2 as $key2 => $item2) {
                City::create([
                    'id' => $key2,
                    'name' => substr($item2, 0, 190),
                    'region_id' => $key
                ]);
            }
        }
        $result3 = Excel::load(public_path('banklar.xlsx'))->getExcel()->getSheet(0)->toArray();
        $result3 = collect($result3);
        $items3 = $result3->except(['0', '1'])->all();
        foreach ($items3 as $key3 => $item3) {
            Bank::create([
                'mfo' => substr($item3[1], 0, 5),
                'name' => substr($item3[8], 0, 191),
            ]);
        }

        foreach (range(1, 6) as $i) {
            Activity::create([
                'name' => $faker->catchPhrase
            ]);
        }
        foreach (range(1, 6) as $i) {
            Family::create([
                'name' => $faker->catchPhrase
            ]);
        }


        for($i = 2; $i<=85; $i+=7) {
            User::create([
                'username' => null,
                'email' => $faker->email,
                'password' => null,
                'region_id' => City::findOrFail($i)->region->id,
                'city_id' => $i,
                'neighborhood' => $faker->streetAddress,
                'subject' => $faker->userAgent,
                'bank_name' => 'Aloqa Bank',
                'reg_date' => $faker->date(),
                'inn' => '123456789',
                'mfo' => '12345',
                'address' => $faker->address,
                'phone' => '998908082443',
                'fullName' => $faker->name,
                'labors' => $faker->numberBetween(1, 200),
                'type' => random_int(1,4)
            ]);
        }

        foreach(range(1, 20) as $i){
            Realization::create([
                'family_count' => $faker->numberBetween(1, 5),
                'annual_prog' => $faker->numberBetween(100,2000),
                'produced_honey' => $faker->numberBetween(100, 2000),
                'reserve' => $faker->numberBetween(500, 4000),
                'realized_quantity' => $faker->numberBetween(100, 2000),
                'realized_price' => $faker->numberBetween(1000, 100000),
                'stock_quantity' =>$faker->numberBetween(100, 2000),
                'stock_price' => $faker->numberBetween(1000, 100000),
                'user_id' => $faker->numberBetween(1, 6),
                'month' => $faker->numberBetween(1, 12),
                'year' => $faker->numberBetween(2017, 2018),
            ]);
        }
        Admin::create([
            'name' => 'Admin aka',
            'username' => 'asalari',
            'password' => Hash::make('password'),
        ]);

        $region = Region::findOrFail(35);
        $region->leader_id = 1;
        $region->save();

        Equipment::truncate();
        foreach(range(1, 20) as $i){
            Equipment::create([
                'name' => $faker->word.$i,
                'volume_name'=>$faker->word
            ]);
        }
        Production::truncate();
        foreach(range(1, 20) as $i){
            Production::create([
                'user_id' => $faker->numberBetween(1,6),
                'month'=>$faker->month,
                'year'=>$faker->year
            ]);
        }
        ProducedEquipments::truncate();
        foreach(range(1, 5) as $k) {
            foreach (range($k, 5) as $i) {
                ProducedEquipments::create([
                    'equipment_id' => $k,
                    'production_id' => $i,
                    'volume' => $faker->randomFloat(1, 0, 100),
                ]);
            }
        }

        Delivery::truncate();
        foreach (range(1, 10) as $key) {
                    Delivery::create([
                        'subject' => $faker->userAgent,
                        'address' => $faker->address,
                        'family_count' => $faker->numberBetween(1, 100),
                        'really_delivered' => $faker->numberBetween(1, 80),
                        'price' => $faker->numberBetween(100000, 900000),
                        'factory_name' => $faker->userAgent,
                        'name' => $faker->name,
                        'phone' => $faker->phoneNumber,
                        'city_id' => $key,
                        'region_id' => City::findOrFail($key)->region->id,
                    ]);
                }        

    }
}
