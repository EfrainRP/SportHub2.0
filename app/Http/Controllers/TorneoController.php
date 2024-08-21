<?php

namespace App\Http\Controllers;

use App\Http\Requests\TorneoRequest;
use App\Models\Torneo;
use App\Models\Estadistica;
use App\Models\ParticipanteTorneo;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\EquipoRequest;
use App\Models\Partido;

class TorneoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $torneos = Torneo::all(); //Take all Equipos

        return view('Torneos.index',compact('torneos')); #Passes records to view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('torneos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TorneoRequest $request)
    {
        $torneo = new Torneo();

        $torneo->name = $request->name;
        $torneo->ubicacion = $request->ubicacion;
        $torneo->tipoJuego = $request->tipoJuego;
        $torneo->descripcion = $request->descripcion;
        $torneo->fechaInicio = $request->fechaInicio;
        $torneo->fechaFin = $request->fechaFin;
        $torneo->tipoTorneo = $request->tipoTorneo;
        $torneo->cantEquipo = $request->cantEquipo;

        $torneo->user_id = auth()->user()->id; //Organizador ID

        $torneo->save();      
        return redirect()->route('torneos.show',$torneo);
    }

    /**
     * Display the specified resource.
     */
    public function show(Torneo $torneo)
    {
        $organizador = User::find($torneo->user_id); //Search for the user "Organizador" by user_id"
        return view('torneos.show',compact('torneo','organizador')); #Passes records to view
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Torneo $torneo)
    {
        $organizador = User::find($torneo->user_id); //Search for the user "Organizador" by user_id"
        return view('torneos.edit',compact('torneo','organizador'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TorneoRequest $request, Torneo $torneo)
    {   
        
        if($request->participante == 'true'){
            if($request->eliminar){
                $eliminado = substr($request->eliminar, -1);
                $user_eliminar = "user".$eliminado;
                ParticipanteTorneo::where('user_id', $request->$user_eliminar)->where('torneo_id', $torneo->id)->delete();
                return redirect()->route('torneos.show',$torneo);
            }
        }
        if($request->participante == 'false'){
            if($request->eliminar){
                $eliminado = substr($request->eliminar, -1);
                $equipo_eliminar = "equipo".$eliminado;
                EquipoTorneo::where('equipo_id', $request->$equipo_eliminar)->where('torneo_id', $torneo->id)->delete();
                return redirect()->route('torneos.show',$torneo);
        }}
        $torneo->name = $request->name;
        $torneo->ubicacion = $request->ubicacion;
        $torneo->tipoJuego = $request->tipoJuego;
        $torneo->descripcion = $request->descripcion;
        $torneo->fechaInicio = $request->fechaInicio;
        $torneo->fechaFin = $request->fechaFin;
        $torneo->tipoTorneo = $request->tipoTorneo;
        $torneo->user_id = auth()->user()->id; //Organizador ID
        $torneo->cantEquipo = $request->cantEquipo;
        $torneo->save();
        return redirect()->route('torneos.show',$torneo);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Torneo $torneo)
    {
        $torneo->delete(); 
        return redirect()->route('dashboard.index');
    }
    //Tournament TEAMS
    public function equipos_torneo(Torneo $torneo){
        return view('Torneos.equipos_torneo',compact('torneo'));
    }
    public function equipos_store(Request $request, Torneo $torneo){
        $organizador = User::find($torneo->user_id);
        $exists = EquipoTorneo::where('equipo_id', $request->equipo_inscrito)->where('torneo_id', $torneo->id)->first();
        if(!$exists && $request->equipo_inscrito != null){ //Valida si ya se encuentra registrado el equipo en el torneo
            $conteo = EquipoTorneo::where('torneo_id', $torneo->id)->count();
            if($conteo < $torneo->cantEquipo){
                $equipoTorneo = new EquipoTorneo();
                $equipoTorneo->equipo_id = $request->equipo_inscrito;
                $equipoTorneo->torneo_id = $torneo->id;
                $equipoTorneo->save();
                return view('Torneos.show',compact('torneo','organizador'));
            }else{
                return view('Torneos.equipos_torneo',compact('torneo'))->with('mensaje', 'Se ha registrado a la cantidad máxima de equipos admitidos para el torneo.');
            }
        }
        else{
            
            return view('Torneos.equipos_torneo',compact('torneo'))->with('mensaje', 'No se encuentran equipos disponibles por añadir.');
        }  
    }
    public function equipos_destroy(Torneo $torneo, $equipo_id)
    {
        $equipo = Estadistica::where('equipo_id', $user_id)->where('torneo_id', $torneo->id)->first();
        $partidos = Partido::where('id_local', $equipo_id)->orWhere('id_visitante', $$equipo_id);
        $partidos->delete();
        $torneo->estadistica()->detach($equipo_id); 
        return view('Torneos.edit');
    }

    //Tournament PARTICIPANTS
    public function participantes_torneo(Torneo $torneo){
        return view('Torneos.participantes_torneo',compact('torneo'));
    }
    public function participantes_store(Request $request, Torneo $torneo){
        $organizador = User::find($torneo->user_id);
        $exists = ParticipanteTorneo::where('user_id', $request->participante_inscrito)->where('torneo_id', $torneo->id)->first();
        if(!$exists && $request->participante_inscrito != null){ //Valida si ya se encuentra registrado el equipo en el torneo
            $conteo = ParticipanteTorneo::where('torneo_id', $torneo->id)->count();
            if($conteo < $torneo->cantEquipo){
                $participanteTorneo = new ParticipanteTorneo();
                $participanteTorneo->user_id = $request->participante_inscrito;
                $participanteTorneo->torneo_id = $torneo->id;
                $participanteTorneo->save();
                return view('Torneos.show',compact('torneo','organizador'));
            }else{
                return view('Torneos.participantes_torneo',compact('torneo'))->with('mensaje', 'Se ha registrado a la cantidad máxima de participantes admitidos para el torneo.');
            }
        }
        else{
            return view('Torneos.participantes_torneo',compact('torneo'))->with('mensaje', 'No se encuentran participantes disponibles por añadir.');
        }  
    }
    public function participante_destroy(Torneo $torneo, $user_id)
    {
        $participante = ParticipanteTorneo::where('torneo_id', $torneo->id)->where('user_id', $user_id)->first();
        $participante->delete();
        return view('Torneos.edit');
        
        
    }
}
