<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LogAktivitas
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // hanya user (bukan admin/petugas)
        if (auth()->check() && auth()->user()->role === 'user') {

         dd('middleware jalan');

    return $next($request);

            // filter route penting saja
            if ($request->is('peminjaman*') || $request->is('pengembalian*')) {

                logAktivitas(
                    $request->method() . ' ' . $request->path(),
                    'User melakukan aktivitas',
                    [
                        'ip' => $request->ip(),
                        'agent' => $request->userAgent()
                    ]
                );
            }
        }

        return $response;
    }
}