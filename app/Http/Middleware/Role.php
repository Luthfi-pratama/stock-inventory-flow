<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Periksa apakah role pengguna sesuai dengan role yang diperlukan
        if ($request->user()->role !== $role) {
            // Redirect sesuai dengan role pengguna saat ini
            switch ($request->user()->role) {
                case 'manager':
                    return redirect('/dashboard/manager');
                case 'spv':
                    return redirect('/dashboard/spv');
                case 'staff':
                    return redirect('/dashboard/staff');
                default:
                    return redirect('/'); // Default fallback jika role tidak dikenali
            }
        }

        return $next($request);
    }
}
