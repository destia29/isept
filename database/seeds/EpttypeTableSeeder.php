<?php

use Illuminate\Database\Seeder;
use App\Model\Type;
use Carbon\Carbon;

class EpttypeTableSeeder extends Seeder
{
    public function run()
    {
        $data                   = new Type;
        $data->code     		    = 1;
        $data->type     		    = 'EPT for S1/D3';
        $data->cost             = 25000;
        $data->created_at       = Carbon::now();
        $data->updated_at       = Carbon::now();
        $data->save();

        $data                   = new Type;
        $data->code     		    = 2;
        $data->type     		    = 'EPT for S2/Public';
        $data->cost             = 125000;
        $data->created_at       = Carbon::now();
        $data->updated_at       = Carbon::now();
        $data->save();
    }
}
