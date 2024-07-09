<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvincesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('provinces')->insert([
            ['name' => 'Punjab'],
            ['name' => 'Sindh'],
            ['name' => 'KPK'],
            ['name' => 'Balochistan'],
        ]);
    }
}
