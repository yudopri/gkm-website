<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dosen1 = User::create([
            'name' => 'Rani Purbaningtyas',
            'username' => 'rani.purbaningtyas@gkm.dev',
            'email' => 'rani.purbaningtyas@gkm.dev',
            'password' => bcrypt('password'),
        ]);

        UserProfile::create([
            'nip' => '198203122005012002',
            'nik' => null,
            'nidn' => '0012038203',
            'nama' => 'Rani Purbaningtyas, S.Kom., MT.',
            'jabatan_fungsional' => 'Lektor Kepala',
            'jabatan_id' => 4,
            'handphone' => '081234567892',
            'user_id' => $dosen1->id,
        ]);

        $dosen1->syncRoles(['dosen', 'D4']);

        $dosen2 = User::create([
            'name' => 'Sholihah Ayu Wulandari',
            'username' => 'sholihah.ayu@gkm.dev',
            'email' => 'sholihah.ayu@gkm.dev',
            'password' => bcrypt('password'),
        ]);

        UserProfile::create([
            'nip' => '199311242024062003',
            'nik' => null,
            'nidn' => '0024119301',
            'nama' => 'Sholihah Ayu Wulandari, S.ST., M.Tr.T.',
            'jabatan_fungsional' => 'Asisten Ahli',
            'jabatan_id' => 8,
            'handphone' => '081234567892',
            'user_id' => $dosen2->id,
        ]);

        $dosen2->syncRoles(['dosen', 'D4']);
    }
}
