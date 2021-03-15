<?php

use Illuminate\Database\Seeder;
use App\Model\Availableseat;
use Faker\Factory as Faker;
use Carbon\Carbon;

class AvailableseatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,50) as $index) {
        $data                   = new Availableseat;
        $data->id_eptroom       = $faker->numberBetween($min = 1, $max = 3);
        $data->id_ept           = $faker->unique()->numberBetween($min = 1, $max = 50);
        $data->created_at       = Carbon::now();
        $data->updated_at       = Carbon::now();
        $data->save();
        }
    }
}
