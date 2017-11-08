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


    }
}
