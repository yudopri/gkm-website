<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jurusan::create(['nama' => 'Jurusan Teknik']);
        Jurusan::create(['nama' => 'Jurusan Kesehatan']);
        Jurusan::create(['nama' => 'Jurusan Bahasa Komunikasi dan Pariwisata']);
        Jurusan::create(['nama' => 'Jurusan Peternakan']);
        Jurusan::create(['nama' => 'Jurusan Teknik Pertanian']);
        Jurusan::create(['nama' => 'Jurusan Produksi Pertanian']);
        Jurusan::create(['nama' => 'Jurusan Manajemen Agribisnis']);
        Jurusan::create(['nama' => 'Jurusan Teknologi Informasi']);
    }
}
