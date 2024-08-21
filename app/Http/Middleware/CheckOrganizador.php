<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Torneo;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckOrganizador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response //Middleware Organizador
    {   //Note: define tournament routes in "web.php" Ex: "torneos" add a name to the main tournament page Ex: 'torneos.index'
        $torneo = $request->route('torneo'); // 'equipo' Singular name of the route 'equipos'
        if ($torneo->user_id != auth()->user()->id) { //Validates that the tournament belongs to the user
            return redirect()->route('dashboard.index'); //Tournament main page
        }else{ //if the tournament belongs to the user <- continue
            return $next($request);
        }
    }
}
