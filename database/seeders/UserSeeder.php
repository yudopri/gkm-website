<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Admin = User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@gkm.dev',
            'password' => bcrypt('password'),
        ]);

        UserProfile::create([
            'nip' => null,
            'nik' => '9876543210',
            'nidn' => null,
            'nama' => 'Ryan Reynolds',
            'jabatan_fungsional' => 'Super Admin',
            'jabatan_id' => 1,
            'program_studi_id' => 1,
            'handphone' => '08123456789',
            'user_id' => $Admin->id,
        ]);

        $Admin->syncRoles('admin');
    }
}
