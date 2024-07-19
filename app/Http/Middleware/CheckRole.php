<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param int $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, int $role)
    {
        if (Auth::check() && Auth::user()->role_id == $role) {
            return $next($request);
        } else {
            Auth::logout();
            return redirect('session');
        }
    }
}
