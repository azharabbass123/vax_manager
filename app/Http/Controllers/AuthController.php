<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\AuthUserRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function create()
    {
        $roles = Role::all();
        return view('auth.login', ['roles' => $roles]);
    }

    public function store(AuthUserRequest $request)
    {
        $attributes = $request->validated();

        if (!Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'authFail' => 'Sorry, those credentials did not match.'
            ]);
        }

        $user = Auth::user();

        if ($user->deleted_at !== null) {
            Auth::logout(); // Log out the user if soft deleted
            throw ValidationException::withMessages([
                'authFail' => 'Sorry, your account has been deactivated.'
            ]);
        }

        //$request->session()->regenerate();

        $redirectRoute = match ($user->role_id) {
            1 => '/admin',
            2 => '/health_worker',
            3 => '/patient',
            default => '/login'
        };

        return redirect()->intended($redirectRoute);
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
