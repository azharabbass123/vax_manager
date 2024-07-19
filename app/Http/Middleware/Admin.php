<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user()->role_id;

        if (Auth::user()->role_id == 1) {
            return $next($request);
        } else if (Auth::user()->role_id == 2) {
            return redirect()->route('health_worker');
        } else if (Auth::user()->role_id == 3) {
            return redirect()->route('patient');
        } else {
            return redirect()->route('session');
        }
    }
}
