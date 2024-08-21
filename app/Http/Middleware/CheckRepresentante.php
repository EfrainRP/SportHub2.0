<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Equipo;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRepresentante
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response //Middleware Representante
    {   
        $equipo = $request->route('equipo'); // 'equipo' Singular name of the route 'equipos'
        if ($equipo->user_id != auth()->user()->id) { //Validates that the team belongs to the user
            return redirect()->route('dashboard.index');  //Teams main page: 'equipos.index'
        }else{ //if the team belongs to the user <- continue
            return $next($request);
        }
    }
}
