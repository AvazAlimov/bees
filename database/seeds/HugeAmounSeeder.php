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

        Production::truncate();
        foreach (range(1, 4060) as $item)
        {
            Production::create([
                'user_id' => $item,
                'month'=>$faker->month,
                'year'=>$faker->year
            ]);
        }
        foreach (range(1, 4060) as $item)
        {
            Production::create([
                'user_id' => $item,
                'month'=>$faker->month,
                'year'=>$faker->year
            ]);
        }

    }
}
