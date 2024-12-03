<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Cek apakah user sudah login
        if (!auth()->check()) {
            return redirect('/login'); // Jika user belum login, redirect ke halaman login
        }

        $userRole = auth()->user()->role;

        // Cek apakah role user ada di dalam list roles yang diijinkan
        if (!in_array($userRole, $roles)) {
            // Redirect sesuai dengan role
            if ($userRole === 'admin') {
                return redirect('/admin');
            } elseif ($userRole === 'mm') {
                return redirect('/manager-marketing');
            } elseif ($userRole === 'marketing') {
                return redirect('/marketing');
            } elseif ($userRole == 'gm') {
                return redirect('/general-manager');
            } elseif ($userRole == 'mh') {
                return redirect('/manager-hrd');
            }

            // Jika role tidak ditemukan, redirect ke halaman utama
            return redirect('/');
        }

        return $next($request);
    }
}
