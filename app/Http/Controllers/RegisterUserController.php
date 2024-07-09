<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;
use App\Models\Role;

class RegisterUserController extends Controller
{
    public function create()
    {
        $roles = Role::all();
        $provinces = Province::all();
        return view('auth.register', ['roles' => $roles, 'provinces' => $provinces]);
    }
}
