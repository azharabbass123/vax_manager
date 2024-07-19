<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        $roles = Role::all();
        return view('auth.login', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'role_id' => ['required']
        ]);

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
            default => '/login' // Default redirection if role_id is unexpected
        };

        return redirect()->intended($redirectRoute);
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
