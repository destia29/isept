<?php

use Illuminate\Database\Seeder;
use App\Model\Adminuser;
use Faker\Factory as Faker;
use Carbon\Carbon;

class AdminuserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
	        $data                   = new Adminuser;
          $data->id_user          = $faker->unique()->numberBetween($min = 1, $max = 10);
	        $data->position         = $faker->randomElement($array = array ('Admin LC Unila','Admin EPT','Admin Dekanat','EPT Value Manager'));
	        $data->nip_user         = $this->random18();
	        $data->handphone_number = $faker->tollFreePhoneNumber;
          $data->created_at       = Carbon::now();
          $data->updated_at       = Carbon::now();
          $data->save();
        }
    }
        public function random18() {
          $number = "";
          for($i=0; $i<18; $i++) {
            $min = ($i == 0) ? 1:0;
            $number .= mt_rand($min,9);
          }
          return $number;
        }
}
