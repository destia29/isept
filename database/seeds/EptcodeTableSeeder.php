<?php

use Illuminate\Database\Seeder;
use App\Model\Code;
use Carbon\Carbon;

class EptcodeTableSeeder extends Seeder
{
    public function run()
    {
        $data                   = new Code;
        $data->code     		    = '/UN26.33/TU.00.08/2018';
        $data->created_at       = Carbon::now();
        $data->updated_at       = Carbon::now();
        $data->save();
    }
}
