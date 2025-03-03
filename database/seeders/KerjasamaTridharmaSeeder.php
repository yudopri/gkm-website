<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class KerjasamaTridharmaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::unprepared(File::get(database_path('seeders/sql/kerjasama-tridharma/kerjasama_tridharma_pendidikan.sql')));
        DB::unprepared(File::get(database_path('seeders/sql/kerjasama-tridharma/kerjasama_tridharma_penelitian.sql')));
        DB::unprepared(File::get(database_path('seeders/sql/kerjasama-tridharma/kerjasama_tridharma_pengmas.sql')));
    }
}
