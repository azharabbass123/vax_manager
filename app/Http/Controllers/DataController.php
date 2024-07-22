<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\HealthWorker;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function fetchCities(Request $request)
    {
        $provinceId = $request->input('id');

        $cities = City::where('province_id', $provinceId)->orderBy('name')->get();

        return response()->json($cities);
    }

    public function fetchHw(Request $request)
    {
        $date = $request->input('date');
        $healthWorkers = HealthWorker::select('health_workers.id as id', 'users.name as name')
            ->join('users', 'health_workers.user_id', '=', 'users.id')
            ->where('users.role_id', 2) // Assuming health workers have role_id 2
            ->whereNull('users.deleted_at')
            ->whereDoesntHave('appointments', function ($query) use ($date) {
                $query->whereDate('apt_Date', $date);
            })
            ->get();

        return response()->json($healthWorkers);
    }
}
