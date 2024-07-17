<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vaccination;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\AppointmentFactory;
use Database\Factories\VaccinationFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
            ProvincesSeeder::class,
            CitiesSeeder::class,
            UsersSeeder::class
        ]);
        User::factory(10)->create();
        AppointmentFactory::factory(10)->create();
        VaccinationFactory::factory(10)->create();
        
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
