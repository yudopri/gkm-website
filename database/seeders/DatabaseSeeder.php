<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            JurusanSeeder::class,
            ProgramStudiSeeder::class,
            JabatanFungsionalSeeder::class,
            JabatanSeeder::class,

            RoleSeeder::class,
            UserSeeder::class,
            PetugasSeeder::class,
            DosenSeeder::class,
            TahunAjaranSeeder::class,

            KerjasamaTridharmaSeeder::class,
            DataMahasiswaSeeder::class,
            DataDosenSeeder::class,
            // KinerjaDosenSeeder::class,
        ]);
    }
}
