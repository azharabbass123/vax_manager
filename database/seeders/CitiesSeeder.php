<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinceIds = [1, 2, 3, 4]; // Adjust as per your provinces

$cities = [
    // Punjab cities
    ['name' => 'Lahore', 'province_id' => $provinceIds[0]],
    ['name' => 'Faisalabad', 'province_id' => $provinceIds[0]],
    ['name' => 'Rawalpindi', 'province_id' => $provinceIds[0]],
    ['name' => 'Gujranwala', 'province_id' => $provinceIds[0]],
    ['name' => 'Multan', 'province_id' => $provinceIds[0]],
    ['name' => 'Bahawalpur', 'province_id' => $provinceIds[0]],
    ['name' => 'Sialkot', 'province_id' => $provinceIds[0]],
    ['name' => 'Gujrat', 'province_id' => $provinceIds[0]],
    ['name' => 'Sheikhupura', 'province_id' => $provinceIds[0]],
    ['name' => 'Jhang', 'province_id' => $provinceIds[0]],
    ['name' => 'Attock', 'province_id' => $provinceIds[0]],
    // Sindh cities
    ['name' => 'Karachi', 'province_id' => $provinceIds[1]],
    ['name' => 'Hyderabad', 'province_id' => $provinceIds[1]],
    ['name' => 'Sukkur', 'province_id' => $provinceIds[1]],
    ['name' => 'Larkana', 'province_id' => $provinceIds[1]],
    ['name' => 'Mirpur Khas', 'province_id' => $provinceIds[1]],
    ['name' => 'Nawabshah', 'province_id' => $provinceIds[1]],
    ['name' => 'Jacobabad', 'province_id' => $provinceIds[1]],
    ['name' => 'Shikarpur', 'province_id' => $provinceIds[1]],
    ['name' => 'Khairpur', 'province_id' => $provinceIds[1]],
    ['name' => 'Dadu', 'province_id' => $provinceIds[1]],
    // KPK cities
    ['name' => 'Peshawar', 'province_id' => $provinceIds[2]],
    ['name' => 'Abbottabad', 'province_id' => $provinceIds[2]],
    ['name' => 'Mardan', 'province_id' => $provinceIds[2]],
    ['name' => 'Swat', 'province_id' => $provinceIds[2]],
    ['name' => 'Nowshera', 'province_id' => $provinceIds[2]],
    ['name' => 'Charsadda', 'province_id' => $provinceIds[2]],
    ['name' => 'Kohat', 'province_id' => $provinceIds[2]],
    ['name' => 'Haripur', 'province_id' => $provinceIds[2]],
    ['name' => 'Dera Ismail Khan', 'province_id' => $provinceIds[2]],
    ['name' => 'Mansehra', 'province_id' => $provinceIds[2]],
    // Balochistan cities
    ['name' => 'Quetta', 'province_id' => $provinceIds[3]],
    ['name' => 'Gwadar', 'province_id' => $provinceIds[3]],
    ['name' => 'Khuzdar', 'province_id' => $provinceIds[3]],
    ['name' => 'Chaman', 'province_id' => $provinceIds[3]],
    ['name' => 'Turbat', 'province_id' => $provinceIds[3]],
    ['name' => 'Sibi', 'province_id' => $provinceIds[3]],
    ['name' => 'Zhob', 'province_id' => $provinceIds[3]],
    ['name' => 'Hub', 'province_id' => $provinceIds[3]],
    ['name' => 'Loralai', 'province_id' => $provinceIds[3]],
    ['name' => 'Kharan', 'province_id' => $provinceIds[3]],
    // Add more cities as needed
];

DB::table('cities')->insert($cities);
    }
}
