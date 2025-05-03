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
        JabatanFungsional::create(['nama' => 'Ketua Prodi D4']);
        JabatanFungsional::create(['nama' => 'Ketua Prodi D3']);
        JabatanFungsional::create(['nama' => 'Admin GKM']);
        JabatanFungsional::create(['nama' => 'Petugas GKM']);
        JabatanFungsional::create(['nama' => 'Teknisi Lab']);
        JabatanFungsional::create(['nama' => 'Staff TU']);
        JabatanFungsional::create(['nama' => 'Mahasiswa S2']);
        JabatanFungsional::create(['nama' => 'Asisten Ahli']);
        JabatanFungsional::create(['nama' => 'Tenaga Pengajar']);
    }
}
