<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Pemeriksaan apakah pengguna memiliki status isAdmin dengan nilai 1
        if ($request->user() && $request->user()->isAdmin == 1) {
            return $next($request);
        }

        // Jika tidak, logout pengguna dan arahkan ke halaman login
        Auth::logout();
        return redirect()->route('login')->with('error', 'Anda tidak memiliki izin untuk mengakses halaman ini.');
    }
}