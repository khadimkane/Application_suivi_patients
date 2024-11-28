<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class MedecinMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response

    {
        $user = Auth::user();

        if ($user && $user instanceof \App\Models\Medecin) {
            return $next($request);
        }
        return redirect('/login')->withErrors(['error' => 'Vous devez être médecin pour accéder à cette ressource.']);

    }
}
