<?php

use Illuminate\Database\Seeder;
use App\Model\Room;
use Carbon\Carbon;

class EptroomTableSeeder extends Seeder
{
    public function run()
    {
      $data                   = new Room;
      $data->room_name 		    = 'Language Center of Unila 2nd Floor - Room 1';
      $data->capacity         = 90;
      $data->created_at       = Carbon::now();
      $data->updated_at       = Carbon::now();
      $data->save();

      $data                   = new Room;
      $data->room_name 		    = 'Language Center of Unila 2nd Floor - Room 2';
      $data->capacity         = 80;
      $data->created_at       = Carbon::now();
      $data->updated_at       = Carbon::now();
      $data->save();

      $data                   = new Room;
      $data->room_name 		    = 'Language Center of Unila 2nd Floor - Room 3';
      $data->capacity         = 85;
      $data->created_at       = Carbon::now();
      $data->updated_at       = Carbon::now();
      $data->save();
    }
}
