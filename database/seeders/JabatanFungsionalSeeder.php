<?php

namespace Database\Seeders;

use App\Models\JabatanFungsional;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanFungsionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JabatanFungsional::create(['nama' => 'Guru Besar']);
        JabatanFungsional::create(['nama' => 'Lektor Kepala']);
        JabatanFungsional::create(['nama' => 'Lektor']);
        JabatanFungsional::create(['nama' => 'Asisten Ahli']);
        JabatanFungsional::create(['nama' => 'Tenaga Pengajar']);
    }
}
