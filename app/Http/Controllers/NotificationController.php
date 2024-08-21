<?php
//Commit
namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Torneo;
use App\Models\Estadistica;
use App\Models\MiembroEquipo;
use App\Models\Notification;
use App\Models\ParticipanteTorneo;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{   //Teams notifications 
    public function index($id){

        $notification = new Notification();
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        $equipo = Equipo::find($id);
        $representante = User::find($equipo->user_id); 
        
        $existingNotification = Notification::where('user_id', $representante->id)->where('equipo_id', $id)->where('user_id2', $user_id)->first();
        $existingMember = MiembroEquipo::where('user_miembro', $user->name)->where('equipo_id', $id)->first();
        if($existingNotification || $existingMember){ //validates that the notification has already been sent
            return view('Dashboard.equipos',compact('equipo','representante'))->with('mensaje', '¡Algo salió mal! Has intentado envíar más de una solicitud o ya te encuentras registrado en el equipo.');
        }else{ //If it has not been sent, send it
         
            $notification->user_id = $representante->id;  //Para quien es
            $notification->user_id2 = auth()->user()->id; //Quien envia la notificacion
            $notification->equipo_id = $id;
            $notification->status = 'pending';
            $notification->save();
            
            return view('Dashboard.equipos',compact('equipo','representante'))->with('mensaje', 'Se envió la notificacion al representante.');
          }
        
    }
    public function send(Request $request,MiembroEquipo $miembro){
        if($request->equipo_id == null){ //Participant notification
            if($request->action == 'aceptada'){
                //When the notification is accepted, the participant is saved as a member
                $participanteTorneo = new ParticipanteTorneo();
                // $user = User::find($request->user_id2);
                $participanteTorneo->user_id = $request->user_id2;
                $participanteTorneo->torneo_id = $request->torneo_id;
                
                $participanteTorneo->save();  
                //Updates current notifications
                Notification::where('user_id', $request->user_id)->where('torneo_id', $request->torneo_id)->delete();
                $user = auth()->user();
                //Notifies the user that their request was accepted
                $notification = new Notification();
                $notification->user_id = auth()->user()->id;
                $notification->user_id2 = Torneo::find($participanteTorneo->torneo_id)->user_id;
                $notification->torneo_id = $request->torneo_id;
                $notification->status = 'accepted';
                $notification->save();

                $notifications = $user->notifications;
                return view('Notificaciones.show',compact('notifications'));
              
            }
            else{  //Tournament notification
                //When the notification was rejected it is deleted 
                Notification::where('user_id', $request->user_id)->where('torneo_id', $request->torneo_id)->delete();
                $user = auth()->user();
                $notifications = $user->notifications;
                return view('Notificaciones.show',compact('notifications'));
            }
        }else{ 
        
        if($request->torneo_id == null){ //Team notification
            if($request->action == 'aceptada'){
                //When the notification is accepted, the participant is saved as a member
                $miembro = new MiembroEquipo();
                $user = User::find($request->user_id2);
                $miembro->user_miembro = $user->name;
                $miembro->equipo_id = $request->equipo_id;
                $miembro->save();     
                //Ppdates current notifications
                Notification::where('user_id', $request->user_id)->where('equipo_id', $request->equipo_id)->delete();
                $user = auth()->user();
                //Notifies the user that their request was accepted
                $notification = new Notification();
                $notification->user_id = auth()->user()->id;
                $notification->user_id2 = Equipo::find($miembro->equipo_id)->user_id;
                $notification->equipo_id = $request->equipo_id;
                $notification->status = 'accepted';
                $notification->save();

                $notifications = $user->notifications;
                return view('Notificaciones.show',compact('notifications'));
              
            }
            else{  //Tournament notification
                //When the notification was rejected it is deleted 
                Notification::where('user_id', $request->user_id)->where('equipo_id', $request->equipo_id)->delete();
                $user = auth()->user();
                $notifications = $user->notifications;
                return view('Notificaciones.show',compact('notifications'));
            }
        }else{
            if($request->action == 'aceptada'){
                //When the notification is accepted, the participant is saved as a member
                $equipoTorneo = new Estadistica();
                $equipoTorneo->torneo_id = $request->torneo_id;
                $equipoTorneo->equipo_id = $request->equipo_id; //Equipo que desea entrar
                $equipoTorneo->save();     
                //Updates current notifications
                Notification::where('user_id', $request->user_id)->where('torneo_id', $request->torneo_id)->where('equipo_id', $request->equipo_id)->delete();
                $user = auth()->user();
                //Notifies the user that their request was accepted
                $notification = new Notification();
                $notification->user_id = auth()->user()->id;
                $notification->equipo_id = $request->equipo_id;
                $notification->torneo_id = $request->torneo_id;
                $notification->status = 'accepted';
                $notification->save();

                $notifications = $user->notifications;
                return view('Notificaciones.show',compact('notifications'));
              
            }
            else{  //Tournament notification
                //When the notification was rejected it is deleted 
                Notification::where('user_id', $request->user_id)->where('torneo_id', $request->torneo_id)->where('equipo_id', $request->equipo_id)->delete();
                $user = auth()->user();
                $notifications = $user->notifications;
                return view('Notificaciones.show',compact('notifications'));
            }
        }
    }
       
    }
    public function show(){ //Show user notifications
        $user = auth()->user();
        $notifications = $user->notifications;
        return view('Notificaciones.show',compact('notifications'));
    }
    //Tournaments notifications 
    public function torneo(Request $request, $id){
       
        $notification = new Notification();
        $user_id = auth()->user()->id;

        $torneo = Torneo::find($id);
        $organizador = User::find($torneo->user_id); 

        $existingNotification = Notification::where('user_id', $organizador->id)->where('torneo_id', $id)->where('equipo_id', $request->equipo_inscrito)->where('user_id2', $user_id)->first();
       
        if(!$existingNotification){
            $notification->user_id = $organizador->id;    //Quien la recibe
            $notification->user_id2 = auth()->user()->id; //Quien envia la notificacion
            $notification->torneo_id = $id;
            $notification->equipo_id = $request->equipo_inscrito;
            $notification->status = 'pending';
            
            $notification->save();
            return view('Dashboard.torneos',compact('torneo','organizador'))->with('mensaje', 'Se envió la notificación al organizador.');
        }else{
            return view('Dashboard.torneos',compact('torneo','organizador'))->with('mensaje', '¡Algo salió mal! Has intentado envíar más de una solicitud o el equipo ya se encuentra registrado en el torneo.');
        }
    }       
     //Tournament participants
    public function participante($id){
        $notification = new Notification();
        $user_id = auth()->user()->id;
    
        $torneo = Torneo::find($id);
        $organizador = User::find($torneo->user_id); 
        $existingUser = ParticipanteTorneo::where('user_id', $user_id)->where('torneo_id', $id)->get();
        $existingNotification = Notification::where('user_id', $organizador->id)->where('torneo_id', $id)->where('equipo_id', null)->where('user_id2', $user_id)->first();
        #Verificar notificacion
        #$existingUser = null;

        
        if(count($existingUser) == 0 && !$existingNotification){
            $notification->user_id = $organizador->id;
            $notification->user_id2 = auth()->user()->id;
            $notification->torneo_id = $id;
            $notification->status = 'pending';
            $notification->save();
            return view('Dashboard.torneos',compact('torneo','organizador'))->with('mensaje', 'Se envió la notificación al organizador.');
        }else{
            return view('Dashboard.torneos',compact('torneo','organizador'))->with('mensaje', '¡Algo salió mal! Has intentado envíar más de una solicitud o ya te encuentras registrado en el torneo.');
        }
    }

}