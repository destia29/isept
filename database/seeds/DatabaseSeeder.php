<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(FacultyTableSeeder::class);
        $this->call(MajorTableSeeder::class);
        $this->call(EptparticipantTableSeeder::class);
        $this->call(EpttypeTableSeeder::class);
        $this->call(EptcodeTableSeeder::class);
        $this->call(EptTableSeeder::class);
        $this->call(EptroomTableSeeder::class);
        $this->call(AvailableseatTableSeeder::class);
        $this->call(RegistereptTableSeeder::class);
        $this->call(EptscoreTableSeeder::class);
        $this->call(AdminuserTableSeeder::class);
        $this->call(LcannouncementTableSeeder::class);
        $this->call(LceventTableSeeder::class);
        $this->call(LcstaffTableSeeder::class);
        $this->call(LcserviceTableSeeder::class);
        $this->call(LcmessageTableSeeder::class);
    }
}
