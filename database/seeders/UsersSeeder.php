<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminUsername = 'admin';
        $superAdminEmail = 'admin@gmail.com';
        $superAdminPassword = 'admin123';
        $superAdminRoleId = 1;
        $superAdminCityId = 1;

        DB::table('users')->insert([
            'name' => $superAdminUsername,
            'email' => $superAdminEmail,
            'password' => Hash::make($superAdminPassword),
            'DOB' => now()->subYears(30), // Example date of birth
            'role_id' => $superAdminRoleId,
            'city_id' => $superAdminCityId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
