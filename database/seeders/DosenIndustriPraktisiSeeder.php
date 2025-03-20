<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DosenIndustriPraktisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dosen_industri_praktisi')->insert([
            [
                'user_id' => 1,
                'tahun_ajaran_id' => 7, // Ganti dari 20241 ke 7
                'nama_dosen' => 'Dr. Budi Santoso',
                'nidk' => '123456789',
                'perusahaan' => 'PT. Teknologi Maju',
                'pendidikan_tertinggi' => 'S3 Teknik Informatika',
                'bidang_keahlian' => 'Kecerdasan Buatan',
                'sertifikat_kompetensi' => 'AI Expert Certification',
                'mk_diampu' => 'Machine Learning',
                'bobot_kredit_sks' => 3,
                'deleted_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'tahun_ajaran_id' => 8, // Ganti dari 20242 ke 8
                'nama_dosen' => 'Ir. Siti Rahmawati, M.T.',
                'nidk' => '987654321',
                'perusahaan' => 'PT. Inovasi Digital',
                'pendidikan_tertinggi' => 'S2 Teknik Elektro',
                'bidang_keahlian' => 'Embedded System',
                'sertifikat_kompetensi' => 'IoT Specialist',
                'mk_diampu' => 'Internet of Things',
                'bobot_kredit_sks' => 2,
                'deleted_at' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
