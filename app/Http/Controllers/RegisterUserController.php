<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

        Auth::login($user);

        session(['userRole' => $user->role_id]);

        $request->session()->regenerate();

        $result = match($user->role_id) {
            1 => redirect('/admin'),
            2 => redirect('/health_worker'),
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
}
