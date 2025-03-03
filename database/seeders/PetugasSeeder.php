<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $petugas1 = User::create([
            'name' => 'John Doe',
            'username' => 'jdoe@gkm.dev',
            'email' => 'jdoe@gkm.dev',
            'password' => bcrypt('password'),
        ]);

        UserProfile::create([
            'nip' => '123456789012345678',
            'nik' => '3201011234567890',
            'nidn' => null,
            'nama' => 'John Doe',
            'jabatan_fungsional' => null,
            'jabatan_id' => 2,
            'handphone' => '081234567890',
            'user_id' => $petugas1->id,
        ]);

        $petugas1->syncRoles('petugas');

        $petugas2 = User::create([
            'name' => 'Jane Smith',
            'username' => 'jsmith@gkm.dev',
            'email' => 'jsmith@gkm.dev',
            'password' => bcrypt('password'),
        ]);

        UserProfile::create([
            'nip' => '987654321098765432',
            'nik' => '3201029876543210',
            'nidn' => null,
            'nama' => 'Jane Smith',
            'jabatan_fungsional' => null,
            'jabatan_id' => 2,
            'handphone' => '081234567891',
            'user_id' => $petugas2->id,
        ]);

        $petugas2->syncRoles('petugas');
    }
}
