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

class HugeAmounSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

       Delivery::truncate();
        for($key = 2; $key<=85; $key+=7) {
            Delivery::create([
                'subject' => $faker->sentence(4),
                'type' => $faker->sentence(2),
                'city_id' => $key,
                'region_id' => City::findOrFail($key)->region->id,
                'activity' => $faker->sentence(3),
                'family_count' => $faker->numberBetween(1, 100),
                'inn' => '123456789',
                'name'=>$faker->name,
                'phone'=>$faker->phoneNumber,
                'labors'=>$faker->numberBetween(1, 100)
            ]);
        }
    }
}
