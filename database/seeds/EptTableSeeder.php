<?php

use Illuminate\Database\Seeder;
use App\Model\Ept;
use Faker\Factory as Faker;
use Carbon\Carbon;

class EptTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {
	        $data                    = new Ept;
          $data->id_epttype        = $faker->numberBetween($min = 1, $max = 2);
          $data->id_eptcode        = 1;
	        $data->ept_date          = $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null);
	        $data->ept_time          = $faker->randomElement($array = array ('10:00','13:00','15:00'));
	        // $data->ept_room          = $faker->randomElement($array = array ('UPT Bahasa Lt.2 R.1','UPT Bahasa Lt.2 R.2','UPT Bahasa Lt.2 R.3'));
          // $data->ept_quota         = $faker->numberBetween($min = 100, $max = 200);
	        $data->registration_date = $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null);
          $data->created_at = Carbon::now();
          $data->updated_at = Carbon::now();
          $data->save();
        }
    }
}
