<?php

use Illuminate\Database\Seeder;
use App\Model\Registerept;
use Faker\Factory as Faker;
use Carbon\Carbon;

class RegistereptTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        //S1/D3
        foreach (range(1, 1000) as $index) {
          $data                   = new Registerept;
	        $data->id_eptparticipant= $faker->numberBetween($min = 1, $max = 92);
	        $data->id_ept           = $faker->numberBetween($min = 1, $max = 50);
	        $data->id_availableseat = $faker->numberBetween($min = 1, $max = 50);
          $data->code      		    = 'LCUNILA-'. $faker->randomElement($array = array ('S1/D3','S2/Public')) . '-01-01-2018-0000' . $index;
          $data->qr_code      	  = 'LCUNILA-'. $faker->randomElement($array = array ('S1/D3','S2/Public')) . '-01-01-2018-0000' . $index . '.png';
          $data->status           = $faker->randomElement($array = array ('Unverified','Verified'));
          $data->attempt          = $faker->numberBetween($min = 1, $max = 5);
          $data->created_at       = Carbon::now();
          $data->updated_at       = Carbon::now();
          $data->save();
        }
    }
}
