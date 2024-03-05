<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Acceso
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('userType') || $request->session()->get('userType') != 'bedelia' && $request->session()->get('userType') != 'admin') {
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
        return $next($request);
    }
}
