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
use App\ProducedEquipment;
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
        Equipment::truncate();
        foreach(range(1, 20) as $i){
            Equipment::create([
                'name' => $faker->word.$i,
                'volume_name'=>$faker->word
            ]);
        }
        Production::truncate();
        foreach (range(1, 50) as $i) {
            $user = User::find($i);
            if ($user != null) {
                Production::create([
                    'user_id' => $i,
                    'month' => $faker->month,
                    'year' => $faker->year
                ]);
            }
        }
        ProducedEquipment::truncate();
        foreach (range(1, 10) as $k) {
            foreach (range(1, 8) as $i)
            {
                ProducedEquipment::create([
                    'equipment_id' => $i,
                    'production_id' => $k,
                    'volume' => $faker->randomFloat(1, 0, 100),
                ]);
            }
            foreach (range(9, 16) as $i)
            {
                ProducedEquipment::create([
                    'equipment_id' => $i,
                    'production_id' => $k,
                    'volume' => $faker->randomFloat(1, 0, 100),
                ]);
            }
        }

    }
}
