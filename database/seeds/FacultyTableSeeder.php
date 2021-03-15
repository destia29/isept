<?php

use Illuminate\Database\Seeder;
use App\Model\Faculty;
use Carbon\Carbon;

class FacultyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	foreach (range(1, 9) as $index) {
	        $data                 = new Faculty;
            if ($index == 1) {
                $data->faculty_name     = 'Ekonomi dan Bisnis';
                $data->faculty_alias    = 'FEB';
            }
            elseif ($index == 2) {
                $data->faculty_name     = 'Hukum';
                $data->faculty_alias    = 'FH';
            }
            elseif ($index == 3) {
                $data->faculty_name     = 'Keguruan dan Ilmu Pendidikan';
                $data->faculty_alias    = 'FKIP';
            }
            elseif ($index == 4) {
                $data->faculty_name     = 'Pertanian';
                $data->faculty_alias    = 'FP';
            }
            elseif ($index == 5) {
                $data->faculty_name     = 'Teknik';
                $data->faculty_alias    = 'FT';
            }
            elseif ($index == 6) {
                $data->faculty_name     = 'Ilmu Sosial dan Ilmu Politik';
                $data->faculty_alias    = 'FISIP';
            }
            elseif ($index == 7) {
                $data->faculty_name     = 'Matematika dan Ilmu Pengetahuan Alam';
                $data->faculty_alias    = 'FMIPA';
            }
            elseif ($index == 8) {
                $data->faculty_name     = 'Kedokteran';
                $data->faculty_alias    = 'FK';
            }
            elseif ($index == 9) {
                $data->faculty_name     = 'Pasca Sarjana';
                $data->faculty_alias    = 'FPS';
            }
            $data->created_at = Carbon::now();
            $data->updated_at = Carbon::now();
            $data->save();
        }
    }
}
