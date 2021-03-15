<?php

use Illuminate\Database\Seeder;
use App\Model\Service;
use Faker\Factory as Faker;
use Carbon\Carbon;

class LcserviceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        //LCService
        $data                   = new Service;
        $data->name     		    = 'English Proficiency Test (EPT) for diploma and undergraduate students (S1)';
        $data->quantity      	  = 'Each Person/Test';
        $data->cost             = 25000;
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data                   = new Service;
        $data->name     		    = 'English Proficiency Test (EPT) for graduate students (S2)';
        $data->quantity      	  = 'Each Person/Test';
        $data->cost             = 125000;
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data                   = new Service;
        $data->name     		    = 'Executive class English course for graduate students (S2) and public';
        $data->quantity      	  = 'Each Person/Test';
        $data->cost             = 500000;
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data                   = new Service;
        $data->name     		    = 'Regular class English course for diploma and undergraduate students (S1)';
        $data->quantity      	  = 'Each Person/Test';
        $data->cost             = 300000;
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data                   = new Service;
        $data->name     		    = 'EPT Certificate legalization';
        $data->quantity      	  = 'Each Sheet';
        $data->cost             = 1500;
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data                   = new Service;
        $data->name     		    = 'Document translation, From English to Bahasa Indonesia';
        $data->quantity      	  = 'Each finished page';
        $data->cost             = 125000;
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data                   = new Service;
        $data->name     		    = 'Document translation, From Japanese to Bahasa Indonesia';
        $data->quantity      	  = 'Each finished page';
        $data->cost             = 200000;
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data                   = new Service;
        $data->name     		    = 'Document translation, From Chinese to Bahasa Indonesia';
        $data->quantity      	  = 'Each finished page';
        $data->cost             = 200000;
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data                   = new Service;
        $data->name     		    = 'Document translation, From Dutch to Bahasa Indonesia';
        $data->quantity      	  = 'Each finished page';
        $data->cost             = 200000;
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data                   = new Service;
        $data->name     		    = 'Document translation, From French to Bahasa Indonesia';
        $data->quantity      	  = 'Each finished page';
        $data->cost             = 145000;
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data                   = new Service;
        $data->name     		    = 'Document translation, From German to Bahasa Indonesia';
        $data->quantity      	  = 'Each finished page';
        $data->cost             = 145000;
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data                   = new Service;
        $data->name     		    = 'Document translation, From Other Languages to Bahasa Indonesia';
        $data->quantity      	  = 'Each finished page';
        $data->cost             = 145000;
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data                   = new Service;
        $data->name     		    = 'Document translation, From Bahasa Indonesia to English';
        $data->quantity      	  = 'Each finished page';
        $data->cost             = 125000;
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data                   = new Service;
        $data->name     		    = 'Document translation, From Bahasa Indonesia to Japanese';
        $data->quantity      	  = 'Each finished page';
        $data->cost             = 200000;
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data                   = new Service;
        $data->name     		    = 'Document translation, From Bahasa Indonesia to Chinese';
        $data->quantity      	  = 'Each finished page';
        $data->cost             = 125000;
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data                   = new Service;
        $data->name     		    = 'Document translation, From Bahasa Indonesia to Dutch';
        $data->quantity      	  = 'Each finished page';
        $data->cost             = 200000;
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data                   = new Service;
        $data->name     		    = 'Document translation, From Bahasa Indonesia to French';
        $data->quantity      	  = 'Each finished page';
        $data->cost             = 145000;
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data                   = new Service;
        $data->name     		    = 'Document translation, From Bahasa Indonesia to German';
        $data->quantity      	  = 'Each finished page';
        $data->cost             = 145000;
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();

        $data                   = new Service;
        $data->name     		    = 'Document translation, From Bahasa Indonesia to Other Languages';
        $data->quantity      	  = 'Each finished page';
        $data->cost             = 145000;
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->save();
    }
}
