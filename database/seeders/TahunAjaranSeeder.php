<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\TahunAjaranSemester;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TahunAjaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seeds = [
            [
                'tahun_ajaran' => '2021/2022',
                'semester' => 'ganjil',
                'slug' => Str::slug('2021-2022 ganjil'),
            ],
            [
                'tahun_ajaran' => '2021/2022',
                'semester' => 'genap',
                'slug' => Str::slug('2021-2022 genap'),
            ],
            [
                'tahun_ajaran' => '2022/2023',
                'semester' => 'ganjil',
                'slug' => Str::slug('2022-2023 ganjil'),
            ],
            [
                'tahun_ajaran' => '2022/2023',
                'semester' => 'genap',
                'slug' => Str::slug('2022-2023 genap'),
            ],
            [
                'tahun_ajaran' => '2023/2024',
                'semester' => 'ganjil',
                'slug' => Str::slug('2023-2024 ganjil'),
            ],
            [
                'tahun_ajaran' => '2023/2024',
                'semester' => 'genap',
                'slug' => Str::slug('2023-2024 genap'),
            ],
            [
                'tahun_ajaran' => '2024/2025',
                'semester' => 'ganjil',
                'slug' => Str::slug('2024-2025 ganjil'),
            ],
            [
                'tahun_ajaran' => '2024/2025',
                'semester' => 'genap',
                'slug' => Str::slug('2024-2025 genap'),
            ],
        ];

        foreach ($seeds as $seed) {
            TahunAjaranSemester::create($seed);
        }
    }
}
