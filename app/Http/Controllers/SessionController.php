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

    public function store(Request $request){
        $attributes = $request->validate([
         'email' => ['required', 'email'],
         'password' => ['required'],
         'role_id' => ['required']
        ]);
 
        if(! (Auth::attempt($attributes))){
             throw ValidationException::withMessages([
                 'authFail' => 'sorry those credentials did not match'
             ]);
        }
 
        //request()->session()->regenerate();
 
        return "congrats you are done!";
     }
}
