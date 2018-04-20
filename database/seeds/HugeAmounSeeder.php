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

        for($i = 2; $i<=85; $i+=7) {
            User::create([
                'username' => 'S' . sprintf("%07d", $i),
                'email' => $faker->email,
                'password' => bcrypt('19961128'),
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
