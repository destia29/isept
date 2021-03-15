<?php

use Illuminate\Database\Seeder;
use App\Model\Major;
use Faker\Factory as Faker;
use Carbon\Carbon;

class MajorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $array_1 = array ('S3 Ilmu Ekonomi','S2 Akuntansi', 'S2 Ekonomi Pembangunan', 'S2 Manajemen', 'S1 Profesi Akuntansi', 'S1 Akuntansi', 'S1 Ekonomi Pembangunan', 'S1 Manajemen', 'D3 Akuntansi', 'D3 Keuangan, Perbankan & Asuransi', 'D3 Pemasaran', 'D3 Perpajakan');
            $array_2 = array ('S3 Ilmu Hukum','S2 Hukum', 'S1 Ilmu Hukum');
            $array_3 = array ('S2 Pendidikan IPS','S2 Teknologi Pendidikan', 'S2 Manajemen Pendidikan', 'S2 Pendidikan Bahasa Indonesia', 'S2 Pendidikan Bahasa dan Sastra Daerah', 'S2 Keguruan IPA', 'S2 Keguruan Guru SD', 'S2 Pendidikan Matematika', 'S2 Pendidikan Bahasa Inggris', 'S2 Pendidikan Fisika', 'S1 Bimbingan Konseling', 'S1 Pendidikan Bahasa dan Sastra Indonesia', 'S1 Pendidikan Bahasa Inggris', 'S1 Pendidikan Biologi', 'S1 Pendidikan Ekonomi', 'S1 Pendidikan Fisika', 'S1 Pendidikan Geografi', 'S1 Pendidikan Jasmani, Kesehatan dan Rekreasi', 'S1 Pendidikan Kimia', 'S1 Pendidikan Matematika', 'S1 Pendidikan Pancasila dan Kewarganegaraan', 'S1 Pendidikan Sejarah', 'S1 Pendidikan Seni Tari', 'S1 Pendidikan Bahasa Perancis', 'S1 Pendidikan Anak Usia Dini', 'S1 Pendidikan Guru Sekolah Dasar' );
            $array_4 = array ('S3 Ilmu Pertanian','S2 Agribisnis', 'S2 Agronomi', 'S2 Teknologi Industri Pertanian', 'S2 Manajemen Sumber Daya Alam', 'S2 Ilmu Kehutanan', 'S2 Teknologi Pangan', 'S2 Penyuluhan dan Komunikasi Pertanian', 'S2 Agroteknologi', 'S1 Agribisnis', 'S1 Agroteknologi', 'S1 Budidaya Perairan', 'S1 Kehutanan', 'S1 Teknologi Hasil Pertanian', 'S1 Peternakan', 'S1 Teknik Pertanian', 'S1 Ilmu Tanah', 'S1 Proteksi Tanaman', 'S1 Agronomi', 'S1 Penyuluhan Pertanian', 'S1 Sumberdaya Akuatik', 'D3 Perkebunan');
            $array_5 = array ('S2 Teknik Sipil','S2 Teknik Mesin', 'S1 Teknik Elektro', 'S1 Teknik Geofisika', 'S1 Teknik Kimia', 'S1 Teknik Mesin', 'S1 Teknik Sipil', 'S1 Teknik Arsitektur', 'S1 Teknik Geodesi', 'S1 Teknik Informatika', 'D3 Survei dan Pemetanaan', 'D3 Teknik Mesin', 'D3 Teknik Sipil');
            $array_6 = array ('S2 Ilmu Pemerintahan','S2 Ilmu Administrasi', 'S1 Ilmu Komunikasi', 'S1 Pemerintahan', 'S1 Sosiologi', 'S1 Administrasi Negara', 'S1 Administrasi Bisnis', 'S1 Hubungan Internasional', 'D3 Sekretaris', 'D3 Hubungan Masyarakat', 'D3 Perpustakaan');
            $array_7 = array ('S2 Ilmu Kimia', 'S2 Ilmu Biologi', 'S2 Ilmu Matematika', 'S2 Ilmu Fisika', 'S1 Fisika', 'S1 Kimia', 'S1 Matematika', 'S1 Ilmu Komputer', 'S1 Biologi', 'D3 Manajemen Informatika');
            $array_8 = array ('S1 Pendidikan Dokter');
            $array_9 = array ('S2 Ilmu Lingkungan', 'S2 Manajemen Wilayah Pesisir dan Laut', 'S2 Manajemen Perencanaan Wilayah dan Kota', 'S2 Ilmu Penyuluhan Pembangunan dan Pemberdayaan Masyarakat');
            foreach (range(0, 11) as $index) {
                $data                       = new Major;
                $data->id_faculty           = 1;
                $data->major_name           = $array_1[$index];
                $data->created_at = Carbon::now();
                $data->updated_at = Carbon::now();
                $data->save();
            }

            foreach (range(0, 2) as $index) {
                $data                       = new Major;
                $data->id_faculty           = 2;
                $data->major_name           = $array_2[$index];
                $data->created_at = Carbon::now();
                $data->updated_at = Carbon::now();
                $data->save();
            }

            foreach (range(0, 25) as $index) {
                $data                       = new Major;
                $data->id_faculty           = 3;
                $data->major_name           = $array_3[$index];
                $data->created_at = Carbon::now();
                $data->updated_at = Carbon::now();
                $data->save();
            }

            foreach (range(0, 21) as $index) {
                $data                       = new Major;
                $data->id_faculty           = 4;
                $data->major_name           = $array_4[$index];
                $data->created_at = Carbon::now();
                $data->updated_at = Carbon::now();
                $data->save();
            }

            foreach (range(0, 12) as $index) {
                $data                       = new Major;
                $data->id_faculty           = 5;
                $data->major_name           = $array_5[$index];
                $data->created_at = Carbon::now();
                $data->updated_at = Carbon::now();
                $data->save();
            }

            foreach (range(0, 10) as $index) {
                $data                       = new Major;
                $data->id_faculty           = 6;
                $data->major_name           = $array_6[$index];
                $data->created_at = Carbon::now();
                $data->updated_at = Carbon::now();
                $data->save();
            }

            foreach (range(0, 9) as $index) {
                $data                       = new Major;
                $data->id_faculty           = 7;
                $data->major_name           = $array_7[$index];
                $data->created_at = Carbon::now();
                $data->updated_at = Carbon::now();
                $data->save();
            }

                $data                       = new Major;
                $data->id_faculty           = 8;
                $data->major_name           = 'S1 Pendidikan Dokter';
                $data->created_at = Carbon::now();
                $data->updated_at = Carbon::now();
                $data->save();

            foreach (range(0, 3) as $index) {
                $data                       = new Major;
                $data->id_faculty           = 9;
                $data->major_name           = $array_9[$index];
                $data->created_at = Carbon::now();
                $data->updated_at = Carbon::now();
                $data->save();
            }
    }
}
