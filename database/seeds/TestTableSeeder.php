<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\User;
use App\Leader;
use App\Region;
use App\City;
use App\Activity;
use App\Admin;
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

        $regions = array();
        array_push($regions,'Tashkent City', 'Tashkent','Andijan','Fergana','Namangan','Jizzakh','Samarkand','Kashkadarya','Bukhara','Nukus','Khorezm','Termiz','Karakalpak');
        foreach (range(1,13) as $i){
            Region::create([
                'name' => $regions[$i-1],
                'leader_id'=>$i,
            ]);
        }

        foreach (range(1,13) as $i) {
            foreach (range(1, 3) as $j){
                City::create([
                   'name'=>$faker->city,
                    'region_id'=>$i
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
