<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->insert([
            'id'   => '1',
            'role_name' => 'Admin God',
            'created_at' => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);
        DB::table('role')->insert([
            'id'   => '2',
            'role_name' => 'Admin LC Unila',
            'created_at' => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);
        DB::table('role')->insert([
            'id'   => '3',
            'role_name' => 'Admin EPT',
            'created_at' => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);
        DB::table('role')->insert([
            'id'   => '4',
            'role_name' => 'EPT Value Manager',
            'created_at' => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);
        DB::table('role')->insert([
            'id'   => '5',
            'role_name' => 'Admin Dekanat',
            'created_at' => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);
        DB::table('role')->insert([
            'id'   => '6',
            'role_name' => 'Chief of the Board',
            'created_at' => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);
        DB::table('role')->insert([
            'id'   => '7',
            'role_name' => 'EPT Participant',
            'created_at' => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);
        DB::table('role')->insert([
            'id'   => '8',
            'role_name' => 'Admin Self Assessment',
            'created_at' => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);
        DB::table('role')->insert([
            'id'   => '9',
            'role_name' => 'OALS Manager',
            'created_at' => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);
        DB::table('role')->insert([
            'id'   => '10',
            'role_name' => 'Instructor',
            'created_at' => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);
        DB::table('role')->insert([
            'id'   => '11',
            'role_name' => 'SA Lecturer',
            'created_at' => Carbon::now(),
            'updated_at'  => Carbon::now(),
        ]);
    }
}
