<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleAndUserSeeder extends Seeder
{
    public function run(): void
    {
        // Insert 3 Role Wajib
        DB::table('roles')->insert([
            ['name' => 'Admin'],   // id: 1
            ['name' => 'Staff'],   // id: 2
            ['name' => 'Manager'], // id: 3
        ]);

        // Insert 1 Akun Admin Default
        DB::table('users')->insert([
            'role_id' => 1, // Mengacu ke Admin
            'name' => 'Super Admin',
            'email' => 'admin@telkomsel.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
