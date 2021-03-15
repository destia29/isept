<?php

use Illuminate\Database\Seeder;
use App\Model\Eptscore;
use Faker\Factory as Faker;
use Carbon\Carbon;

class EptscoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 1000) as $index) {
	        $data                           = new Eptscore;
	        $data->id_registerept           = $faker->unique()->numberBetween($min = 1, $max = 1000);
	        $data->listening_score          = $faker->numberBetween($min = 0, $max = 50);
	        $data->structure_score          = $faker->numberBetween($min = 0, $max = 50);
	        $data->reading_score            = $faker->numberBetween($min = 0, $max = 50);
	        $data->total_score              = $faker->numberBetween($min = 233, $max = 677);
          $data->created_at = Carbon::now();
          $data->updated_at = Carbon::now();
          $data->save();
        }
    }
}
