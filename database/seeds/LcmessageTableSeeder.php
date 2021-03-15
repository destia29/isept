<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Model\Message;
use Carbon\Carbon;

class LcmessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,3) as $index) {
        $data                   = new Message;
        $data->name             = $faker->name;
        $data->email            = $faker->unique()->email;
        $data->subject          = $faker->text($maxNbChars = 200);
        $data->message          = $faker->text($maxNbChars = 1201);
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();
        }
    }
}
