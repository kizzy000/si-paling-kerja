<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        $user = Auth::user();

        if ($role === 'admin' && !$user->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        if ($role === 'pendaftar' && !$user->isPendaftar()) {
            abort(403, 'Unauthorized');
        }

        if ($role === 'perusahaan' && !$user->isPerusahaan()) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}