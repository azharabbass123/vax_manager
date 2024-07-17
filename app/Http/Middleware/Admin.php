<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if((session('userRole') == 1) && (Auth::check()))
        {
            return $next($request);
        }
        else if((session('userRole') == 2) && (Auth::check()))
        {
            return redirect()->route('health_worker');
        }
        else if((session('userRole') == 3) && (Auth::check()))
        {
            return redirect()->route('patient');
        }
        else
        {
            return redirect()->route('session');
        }

    }
}
