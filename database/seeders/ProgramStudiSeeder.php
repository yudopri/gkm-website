<?php

namespace Database\Seeders;

use App\Models\ProgramStudi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramStudiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seeds = [
            [
                'nama' => 'D3 Manajemen Informatika',
                'jenjang' => 'D3',
                'jurusan_id' => 8,
            ],
            [
                'nama' => 'D3 Teknik Komputer',
                'jenjang' => 'D3',
                'jurusan_id' => 8,
            ],
            [
                'nama' => 'D4 Teknik Informatika',
                'jenjang' => 'STr',
                'jurusan_id' => 8,
            ],
            [
                'nama' => 'D4 Teknik Informatika - Kampus Bondowoso',
                'jenjang' => 'STr',
                'jurusan_id' => 8,
            ],
            [
                'nama' => 'D4 Teknik Informatika - PSDKU Nganjuk',
                'jenjang' => 'STr',
                'jurusan_id' => 8,
            ],
            [
                'nama' => 'D4 Teknik Informatika - PSDKU Sidoarjo',
                'jenjang' => 'STr',
                'jurusan_id' => 8,
            ],
            [
                'nama' => 'D4 Bisnis Digital',
                'jenjang' => 'STr',
                'jurusan_id' => 8,
            ],
            [
                'nama' => 'D3 Manajemen Informatika - Internasional (CZIMT China)',
                'jenjang' => 'D3',
                'jurusan_id' => 8,
            ],
            [
                'nama' => 'D3 Teknik Komputer - Internasional (WXIT China)',
                'jenjang' => 'D3',
                'jurusan_id' => 8,
            ],
            [
                'nama' => 'D4 Teknik Komputer - Internasional (MSU Malaysia)',
                'jenjang' => 'STr',
                'jurusan_id' => 8,
            ],
            [
                'nama' => 'Magister Terapan Agribisnis',
                'jenjang' => 'MTr',
                'jurusan_id' => 7,
            ],
        ];

        foreach ($seeds as $prodi) {
            ProgramStudi::create($prodi);
        }
    }
}
