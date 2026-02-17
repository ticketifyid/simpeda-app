<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('api_token')) {
            return redirect()->route('login')->withErrors([
                'email' => 'Sesi habis, silakan login kembali.'
            ]);
        }

        return $next($request);
    }
}
