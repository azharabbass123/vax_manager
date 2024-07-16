<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\HealthWorker;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class RegisterUserController extends Controller
{
    public function create()
    {
        $roles = Role::all();
        $provinces = Province::all();
        return view('auth.register', ['roles' => $roles, 'provinces' => $provinces]);
    }

    public function store(Request $request){
        $attributes = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'DOB' => ['required'],
            'role_id' => ['required'],
            'city_id' => ['required'],
            'password' => ['required', Password::min(6)],
        ]);
        
        $user = User::create($attributes);
    
        if ($user->role_id == 2) {
        
            HealthWorker::create(['user_id' => $user->id]);
        } elseif ($user->role_id == 3) {
        
            Patient::create(['user_id' => $user->id]);
        }

        Auth::login($user);

        session(['userRole' => $user->role_id]);
        session(['userName' => $user->name]);
        session(['userId' => $user->id]);

        $request->session()->regenerate();

        $result = match($user->role_id) {
            "1" => redirect('/admin'),
            "2" => redirect('/health_worker'),
            default => redirect('/patient'),
        };

        return $result;
    }

    public function fetchCities(Request $request)
    {
        $provinceId = $request->input('id');

        $cities = \App\Models\City::where('province_id', $provinceId)->get();

        return response()->json($cities);
    }

    public function fetchHw(Request $request){
        $date = $request->input('date');
    $healthWorkers = DB::table('health_workers as hw')
    ->select('hw.id as id', 'u.name as name')
    ->join('users as u', 'hw.user_id', '=', 'u.id')
    ->where('u.role_id', 2) // Assuming health workers have role_id 2
    ->whereNull('u.deleted_at')
    ->whereNotExists(function ($query) use ($date) {
        $query->select(DB::raw(1))
            ->from('appointments')
            ->whereColumn('appointments.hw_id', 'hw.id')
            ->whereDate('appointments.apt_Date', '=', $date);
    })
    ->get();

    return response()->json($healthWorkers);
    }

    public function edit($id){
        $userData = User::find($id);
        $provinces = Province::all();
        return view('auth.updateProfile', ['userData' => $userData, 'provinces' => $provinces]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => ['required'],
            'DOB' => ['required'],
            'city_id' => ['required'],
        ]);

        $user = User::find($id);

        $user->name = $request->name;
        $user->DOB = $request->DOB;
        $user->city_id = $request->city_id;

        $user->save();
        $result = match($user->role_id) {
            2 => redirect('/health_worker')->with('status', 'Data Updated Successfully!'),
            default => redirect('/patient')->with('status', 'Data Updated Successfully!'),
        };

        return $result;
        
    }
}
