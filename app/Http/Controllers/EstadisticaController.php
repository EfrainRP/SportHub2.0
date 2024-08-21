<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstadisticaRequest;
use App\Models\Estadistica;
use App\Models\Torneo;
use App\Models\Equipos;
use App\Models\Partido;
use App\Models\User;
use App\Http\Requests\TorneoRequest;

use Illuminate\Http\Request;

class EstadisticaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Torneo $torneo)
    {
        $estadistica = Estadistica::with($torneo->id)->get(); //Take all Equipos

        return view('Estadistica.index',compact('estadistica')); #Passes records to view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('estadisticas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    static function store(Torneo $torneo, Partido $partido, Request $request)
    {
        $estadistica = new Estadistica();

        $estadistica->PT = $request->name;
        $estadistica->CA = $request->ubicacion;
        $estadistica->DC = $request->tipoJuego;
        $estadistica->CC = $request->descripcion;
        $estadistica->fechaInicio = $request->fechaInicio;
        
        $estadistica->save();      

        $estadistica->torneo()->attach($torneo->id); //Organizador ID

        return redirect()->route('estadisticas.show',$estadistica);
    }

    /**
     * Display the specified resource.
     */
    public function show(Torneo $torneo)
    {
        $estadistica = Estadistica::with($torneo->id)->get(); //Take all Equipos

        return view('torneos.show',compact('torneo','estadistica')); #Passes records to view
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Torneo $torneo)
    {
        $estadistica = User::find($torneo->user_id); //Search for the user "Organizador" by user_id"
        return view('torneos.edit',compact('torneo','organizador'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TorneoRequest $request, Torneo $torneo)
    {
        $torneo->name = $request->name;
        $torneo->ubicacion = $request->ubicacion;
        $torneo->tipoJuego = $request->tipoJuego;
        $torneo->descripcion = $request->descripcion;
        $torneo->fechaInicio = $request->fechaInicio;
        $torneo->fechaFin = $request->fechaFin;
        $torneo->tipoTorneo = $request->tipoTorneo;
        $torneo->user_id = auth()->user()->id; //Organizador ID
        $torneo->save();
        return redirect()->route('$torneos.show',$torneo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Torneo $torneo)
    {
        $torneo->delete(); 
        return redirect()->route('torneos.index');
    }
}
