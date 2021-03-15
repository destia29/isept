<?php

use Illuminate\Database\Seeder;
use App\Model\User;
use Faker\Factory as Faker;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $data = new User;
        $data->id_role  = 1;
        $data->username   = 'admingod';
        $data->name       = $faker->name;
        $data->email      = $faker->email;
        $data->password   = bcrypt('admin12390');
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data = new User;
        $data->id_role  = 2;
        $data->username   = 'adminlcunila';
        $data->name       = $faker->name;
        $data->email      = $faker->email;
        $data->password   = bcrypt('admin12390');
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data = new User;
        $data->id_role  = 3;
        $data->username   = 'adminept';
        $data->name       = $faker->name;
        $data->email      = $faker->email;
        $data->password   = bcrypt('admin12390');
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data = new User;
        $data->id_role  = 4;
        $data->username   = 'eptvaluemanager';
        $data->name       = $faker->name;
        $data->email      = $faker->email;
        $data->password   = bcrypt('admin12390');
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data = new User;
        $data->id_role  = 5;
        $data->username   = 'admindekanat';
        $data->name       = $faker->name;
        $data->email      = $faker->email;
        $data->password   = bcrypt('admin12390');
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data = new User;
        $data->id_role  = 6;
        $data->username   = 'headoflcunila';
        $data->name       = $faker->name;
        $data->email      = $faker->email;
        $data->password   = bcrypt('admin12390');
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        foreach (range(1, 92) as $index) {
        $data                   = new User;
        $data->id_role          = 7;
        $data->username         = $faker->unique()->userName;
        $data->name             = $faker->name;
        $data->email            = $faker->unique()->email;
        $data->password         = bcrypt('admin12390');
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();
        }
    }
}
