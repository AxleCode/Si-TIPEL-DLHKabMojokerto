<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && !auth()->user()->active) {
            auth()->logout(); // Logout the current user
            abort(403, 'Akun Anda Dinonaktifkan');
              
        }
    
        return $next($request);
    }
    
}
