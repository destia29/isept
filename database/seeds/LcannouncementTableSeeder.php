<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Model\Announcement;
use Carbon\Carbon;

class LcannouncementTableSeeder extends Seeder
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
        $data                   = new Announcement;
        $data->id_user     		= '2';
        $data->title      	    = 'Open New Courses';
        $data->thumbnail        = $faker->text($maxNbChars = 50). '.png';
        $data->description      = $faker->text($maxNbChars = 1201);
        $data->release_date     = $faker->date($format = 'Y-m-d', $max = 'now');
        $data->tag             = 'Education';
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();
    }
    }
}
