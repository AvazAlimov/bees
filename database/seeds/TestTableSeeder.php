<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\User;
use App\Leader;
use App\Region;
use App\City;
use App\Activity;
use App\Admin;
use Maatwebsite\Excel\Facades\Excel;

class TestTableSeeder extends Seeder
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
        foreach (range(1,13) as $i)
        {
            Leader::create([
                'username' => 'U'.sprintf("%07d", $i),
                'email'=>$faker->email,
                'password'=>bcrypt('password'),
                'lastName'=>$faker->lastName,
                'firstName' => $faker->firstName,
                'phone' => $faker->phoneNumber,
            ]);
        }

        $result = Excel::load(public_path('hudud.xlsx'))->getExcel()->getSheet(0)->toArray();
        $result = collect($result);
        $items = $result->sortBy(function ($item){
            return $item[3];
        })->except(['0','1'])->unique('3')->pluck('1','3');
        foreach ($items as $key => $item){
            Region::create([
                'id'=>$key,
                'name' => substr($item,0,190),
            ]);
            $result2 = Excel::load(public_path('hudud.xlsx'))->getExcel()->getSheet(0)->toArray();
            $result2 = collect($result2);
            $items2 = $result2->sortBy(function ($item){
                return $item[3];
            })->except(['0','1'])->where('3', sprintf("%02d", $key))->pluck('2','0');
            foreach ($items2 as $key2 => $item2){
                City::create([
                    'id'=>$key2,
                    'name'=>substr($item2,0,190),
                    'region_id'=>$key
                ]);
            }
        }

        foreach (range(1,6) as $i){
            Activity::create([
               'name'=> $faker->catchPhrase
            ]);
        }
        foreach (range(1,3) as $i){
            foreach (range(1, 3) as $j){
                User::create([
                    'username'=> null,
                    'email'=>$faker->email,
                    'password'=>null,
                    'region_id' => $i,
                    'city_id' =>$i,
                    'neighborhood' => $faker->streetAddress,
                    'subject' => $faker->userAgent,
                    'bank_name'=>'Aloqa Bank',
                    'reg_date'=>$faker->date(),
                    'inn'=>'123456789',
                    'mfo'=>'12345',
                    'address' =>$faker->address,
                    'phone'=>'+998908082443',
                    'fullName'=>$faker->name,
                    'labors'=>$faker->numberBetween(1,200),
                    'type'=>$j
                ]);
            }
        }

        Admin::create([
            'name'=>'Admin aka',
            'username'=>'asalari',
            'password'=>Hash::make('password'),
        ]);

    }
}
