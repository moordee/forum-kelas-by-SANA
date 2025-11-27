<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SiswaAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('siswa_logged_in')) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
