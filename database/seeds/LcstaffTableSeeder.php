<?php

use Illuminate\Database\Seeder;
use App\Model\Staff;
use Faker\Factory as Faker;
use Carbon\Carbon;

class LcstaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        //LCStaff
        $data                   = new Staff;
        $data->name     		= 'Dr. Muhammad Sukirlan, M.A.';
        $data->position      	= 'Head of LC Unila';
        $data->picture          = "msukirlan.png";
        $data->facebook         = "#";
        $data->twitter          = "#";
        $data->googleplus       = "#";
        $data->instagram        = "#";
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data                   = new Staff;
        $data->name     		= 'Mardiana, S.Pd.';
        $data->position      	= 'Head of LCU Administration';
        $data->picture          = "mardiana.png";
        $data->facebook         = "#";
        $data->twitter          = "#";
        $data->googleplus       = "#";
        $data->instagram        = "#";
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();

        $data->save();
        $data                   = new Staff;
        $data->name     		= 'Irine Isnaini';
        $data->position      	= 'Research and Devotion Division';
        $data->picture          = "irine.png";
        $data->facebook         = "#";
        $data->twitter          = "#";
        $data->googleplus       = "#";
        $data->instagram        = "#";
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data                   = new Staff;
        $data->name     		= 'Mulia, SP.d.';
        $data->position      	= 'Quality Assurance Division';
        $data->picture          = "mulia.png";
        $data->facebook         = "#";
        $data->twitter          = "#";
        $data->googleplus       = "#";
        $data->instagram        = "#";
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data                   = new Staff;
        $data->name     		= 'Gandhi Irawan, S.Pd., M.Pd.';
        $data->position      	= 'Quality Assurance Division';
        $data->picture          = "msukirlan.png";
        $data->facebook         = "#";
        $data->twitter          = "#";
        $data->googleplus       = "#";
        $data->instagram        = "#";
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data                   = new Staff;
        $data->name     		= 'Mulyati Ajeng, S.I.Kom.';
        $data->position      	= 'Quality Assurance Division';
        $data->picture          = "mulyati.png";
        $data->facebook         = "#";
        $data->twitter          = "#";
        $data->googleplus       = "#";
        $data->instagram        = "#";
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();

        $data->save();
        $data                   = new Staff;
        $data->name     		= 'Guryati, S.S.';
        $data->position      	= 'Foreign Language Division';
        $data->picture          = "guryati.png";
        $data->facebook         = "#";
        $data->twitter          = "#";
        $data->googleplus       = "#";
        $data->instagram        = "#";
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data                   = new Staff;
        $data->name     		= 'Leni Apridawati, S.Pd., M.Pd.';
        $data->position      	= 'Foreign Language Division';
        $data->picture          = "leni.png";
        $data->facebook         = "#";
        $data->twitter          = "#";
        $data->googleplus       = "#";
        $data->instagram        = "#";
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data                   = new Staff;
        $data->name     		= 'Sumiyati';
        $data->position      	= 'Indonesian and Regional Languages Division';
        $data->picture          = "sumiyati.png";
        $data->facebook         = "#";
        $data->twitter          = "#";
        $data->googleplus       = "#";
        $data->instagram        = "#";
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data                   = new Staff;
        $data->name     		= 'Diana Rizanti, S.Pd.';
        $data->position      	= 'Indonesian and Regional Languages Division';
        $data->picture          = "diana.png";
        $data->facebook         = "#";
        $data->twitter          = "#";
        $data->googleplus       = "#";
        $data->instagram        = "#";
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();

        $data->save();
        $data                   = new Staff;
        $data->name     		= 'Fevi Susanti, A.Md.';
        $data->position      	= 'Indonesian and Regional Languages Division';
        $data->picture          = "fevi.png";
        $data->facebook         = "#";
        $data->twitter          = "#";
        $data->googleplus       = "#";
        $data->instagram        = "#";
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data                   = new Staff;
        $data->name     		= 'Aditya Arief, S.I.P.';
        $data->position      	= 'ICT Division';
        $data->picture          = "aditya.png";
        $data->facebook         = "#";
        $data->twitter          = "#";
        $data->googleplus       = "#";
        $data->instagram        = "#";
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data                   = new Staff;
        $data->name     		= 'Arif Andi Susanto, S.Kom.';
        $data->position      	= 'ICT Division';
        $data->picture          = "arif.png";
        $data->facebook         = "#";
        $data->twitter          = "#";
        $data->googleplus       = "#";
        $data->instagram        = "#";
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();
        
        $data                   = new Staff;
        $data->name     		= 'Pamujiarto';
        $data->position      	= 'Janitor';
        $data->picture          = "pamujiarto.png";
        $data->facebook         = "#";
        $data->twitter          = "#";
        $data->googleplus       = "#";
        $data->instagram        = "#";
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

    }
}
