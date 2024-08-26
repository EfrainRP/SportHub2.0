<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Partido;
use App\Models\MiembroEquipo;
use App\Models\Torneo;
use App\Models\User;
use App\Models\Estadistica;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){ //View Login
      // MIS TORNEOS
      $misTorneos = Torneo::where('user_id',auth()->user()->id)->get()->map(function ($item){
        $item['rol'] = 'Organizador'; return $item;
      });
      
      $capitanes = Equipo::where('user_id',auth()->user()->id)->get();
      foreach ($capitanes as $capitan){ 
        $nameEquipo = $capitan->name;
        $capitan_torneo = $capitan->torneo->map(function ($item) use ($nameEquipo){
          $item['rol'] = 'Capitan de'. $nameEquipo; return $item;
        });
        
        $misTorneos = $capitan_torneo->merge($misTorneos);//mezclo las consultas
      }
      $misTorneos = $misTorneos->unique('id');//quitamos repetidas

      $miembros = MiembroEquipo::where('user_miembro', auth()->user()->name)->get();
      foreach($miembros as $miembro){
        $miembroEquipo = $miembro->miembros;//Recibo sql de equipo indv.
        $nameEquipo = $miembroEquipo->name; //Nombre del equipo

        $miembroEquipoTorneo = $miembroEquipo->torneo
        ->map(function ($item) use ($nameEquipo){ 
          $item['rol'] = 'Miembro de '.$nameEquipo; return $item;
        });
        
        $misTorneos = $miembroEquipoTorneo->merge($misTorneos);//mezclo las consultas
      }
      $misTorneos =$misTorneos->unique('id');//quitamos repetidas
      
      // MIS EQUIPOS
      $misEquipos = Equipo::where('user_id',auth()->user()->id)
      ->get()
      ->map(function ($item){
        $item['rol'] = 'Capitan'; return $item;
      });
      $miembros = MiembroEquipo::where('user_miembro', auth()->user()->name)->get();
      
      foreach($miembros as $miembro){
        $miembroEquipo = $miembro->miembros;//Recibo sql de equipo indv. del miembro
        
        $misEquipos = $misEquipos->push($miembroEquipo);//mezclo las consultas
      }
      $misEquipos = $misEquipos->unique('id'); //quitamos repetidas

      // PROXIMOS PARTIDOS
      $misPartidos = collect();
      foreach($misEquipos as $currEquipo){
        $partidos = Partido::where('equipoLocal_id', $currEquipo->id)
        ->orWhere('equipoVisitante_id',$currEquipo->id)
        ->orderBy('fechaPartido','asc')
        ->orderBy('horaPartido','asc')
        ->get();

        foreach($partidos as $miPartido){
          $nameTorneo = $miPartido->estanTorneos->first()->name;

          $misPartidos->push($miPartido)->map(function ($item) use ($nameTorneo){
            $item['equipoLocalName'] = $item->local->name;
            unset($item['equipoLocal_id']); // Eliminar atributo original
            $item['equipoVisName'] = $item->visitante->name;
            unset($item['equipoVisitante_id']); // Eliminar atributo original
            unset($item['local']); // Eliminar atributo original
            $item['torneoName'] = $nameTorneo; return $item;
            unset($item['estan_torneos']); // Eliminar atributo original
            // $item['fechaPartido'] = Carbon::parse($item->fechaPartido)->format('d F, Y');
            // $item['horaPartido'] = Carbon::parse($item->horaPartido)->format('h:i A'); 
          });
        }
      }
      
      return view('Dashboard.dashboard',[
        'equipos' => $misEquipos,
        'torneos' => $misTorneos,
        'partidos' => $misPartidos
      ]); //Folder and file (Route)
      }
    public function nosotros(){
      
      return view('Dashboard.nosotros');
    }
    public function home(){
      
      return view('Dashboard.home');
    }

      public function equipo(Equipo $equipo){
        $representante = User::find($equipo->user_id); //Search for the user "Representante" by user_id"
        return view('Dashboard.equipos',compact('equipo','representante')); #Passes records to view
      }
      public function torneo(Torneo $torneo){
        $organizador = User::find($torneo->user_id); //Search for the user "Representante" by user_id"
        return view('Dashboard.torneos',compact('torneo','organizador')); #Passes records to view
      }

      public function slidebar(){
        $user = User::all();
        return view('Dashboard.slidebar',compact('user'));
      }
}
