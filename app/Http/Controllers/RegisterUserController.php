<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Patient;
use App\Models\Province;
use App\Models\HealthWorker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class RegisterUserController extends Controller
{
    public function create()
    {
        $roles = Role::all();
        $provinces = Province::all();
        return view('auth.register', ['roles' => $roles, 'provinces' => $provinces]);
    }

    public function store(CreateUserRequest $request)
    {
        $attributes = $request->validated();

        $user = User::create($attributes);

        if ($user->role_id == 2) {

            HealthWorker::create(['user_id' => $user->id]);
        } elseif ($user->role_id == 3) {

            Patient::create(['user_id' => $user->id]);
        }

        Auth::login($user);

        $result = match ($user->role_id) {
            "1" => redirect('/admin'),
            "2" => redirect('/health_worker'),
            default => redirect('/patient'),
        };

        return $result;
    }

    public function edit($id)
    {
        $userData = User::find($id);
        $provinces = Province::all();
        return view('auth.updateProfile', ['userData' => $userData, 'provinces' => $provinces]);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $request->validated();

        $user = User::find($id);

        $user->name = $request->name;
        $user->DOB = $request->DOB;
        $user->city_id = $request->city_id;

        $user->save();
        $result = match ($user->role_id) {
            2 => redirect('/health_worker')->with('status', 'Data Updated Successfully!'),
            default => redirect('/patient')->with('status', 'Data Updated Successfully!'),
        };

        return $result;
    }
}
