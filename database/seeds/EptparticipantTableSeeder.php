<?php

use Illuminate\Database\Seeder;
use App\Model\Eptparticipant;
use Faker\Factory as Faker;
use Carbon\Carbon;

class EptparticipantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 92) as $index) {
	        $data                          = new Eptparticipant;
          $data->id_user                 = $faker->unique()->numberBetween($min = 7, $max = 98);
	        $data->id_major                = $faker->numberBetween($min = 1, $max = 102);
	        $data->idnumber_eptparticipant = $this->random10();
	        $data->gender                  = $faker->randomElement($array = array ('Male','Female'));
	        $data->place_of_birth          = $faker->city;
          $data->date_of_birth           = $faker->date($format = 'Y-m-d', $max = 'now');
	        $data->address                 = $faker->streetAddress;
	        $data->handphone_number        = $faker->tollFreePhoneNumber;
          $data->created_at = Carbon::now();
          $data->updated_at = Carbon::now();
          $data->save();
        }
    }

    public function random10() {
      $number = "";
      for($i=0; $i<10; $i++) {
        $min = ($i == 0) ? 1:0;
        $number .= mt_rand($min,9);
      }
      return $number;
    }
}
