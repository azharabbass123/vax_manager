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
            'username' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(6), 'confirmed'],
        ]);
        
        $user = User::create($attributes);

        Auth::login($user);

        return redirect('/jobs');
    }

    public function fetchCities(Request $request)
    {
        $provinceId = $request->input('id');

        $cities = \App\Models\City::where('province_id', $provinceId)->get();

        return response()->json($cities);
    }
}
