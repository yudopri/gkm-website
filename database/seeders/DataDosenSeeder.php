<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DataDosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::unprepared(File::get(database_path('seeders/sql/data-dosen/dosen_tetap_pt.sql')));
        // DB::unprepared(File::get(database_path('seeders/sql/data-dosen/dosen_pembimbing_ta.sql')));
        // DB::unprepared(File::get(database_path('seeders/sql/data-dosen/ewmp_dosen.sql')));
        // DB::unprepared(File::get(database_path('seeders/sql/data-dosen/dosen_tidak_tetap.sql')));
        // DB::unprepared(File::get(database_path('seeders/sql/data-dosen/dosen_industri_praktisi.sql')));
    }
}
