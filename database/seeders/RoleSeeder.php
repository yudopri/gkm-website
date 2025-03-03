<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'petugas']);
        Role::create(['name' => 'dosen']);
        Role::create(['name' => 'staff']);
        Role::create(['name' => 'teknisi']);

        Role::create(['name' => 'D3']);
        Role::create(['name' => 'D4']);
        Role::create(['name' => 'S2']);
    }
}
