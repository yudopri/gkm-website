<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jabatan::create(['nama' => 'Super Admin']);
        Jabatan::create(['nama' => 'Petugas GKM']);

        Jabatan::create(['nama' => 'Ketua Jurusan']);
        Jabatan::create(['nama' => 'Sekretaris Jurusan']);
        Jabatan::create(['nama' => 'Koordinator Program Studi']);
        Jabatan::create(['nama' => 'Kepala Laboratorium']);
        Jabatan::create(['nama' => 'Teknisi Laboratorium']);
        Jabatan::create(['nama' => 'Staff Administrasi']);
        Jabatan::create(['nama' => 'Staff Pengajar']);
    }
}
