@extends('Dashboard.slidebar')
@section('title', 'SPORTHUB')

@section('content')
<main class="home-section">
    <section class="principalbox">
        <div class="contorno">
            <title>Torneo {{$torneo->name}}</title>
            <h1>{{$torneo->name}}</h1>
            @if ($torneo->tipoTorneo == "Equipos")
                    @php
                    $equiposTorneo = App\Models\Estadistica::all(); 
                    $count = 0;
                    @endphp
                        @foreach ($equiposTorneo as $equipoTorneo)
                                @if($equipoTorneo->torneo_id == $torneo->id)
                                    @php
                                    $count = $count+1;
                                    @endphp
                                @endif
                        @endforeach
                        <h4 style="margin-bottom: 5px">Cantidad de equipos registrados actualmente: <b>{{$count}}</b></h4>
                        <form action="{{route('notification.torneo',['id' => $torneo->id])}}" method="POST">
                            @csrf
                            @php
                                $equipos = App\Models\Equipo::all();
                                $equiposTorneo = App\Models\Estadistica::all();
                            @endphp
                            <label for="equipo_inscrito">Deseo inscribir a mi equipo: </label>
                            <select id="equipo_inscrito" name="equipo_inscrito">
                            @foreach($equipos as $equipo)
                            @php
                                $equipoPerteneceAlUsuario = $equipo->user_id == auth()->user()->id;
                                $equipoYaRegistrado = false;

                                foreach ($equiposTorneo as $equipo_inscrito) {
                                    if ($equipo->id == $equipo_inscrito->equipo_id) {
                                        $equipoYaRegistrado = true;
                                        break;
                                    }
                                }
                            @endphp
                        
                            @if ($equipoPerteneceAlUsuario && !$equipoYaRegistrado)
                                <option value="{{ $equipo->id }}">{{ $equipo->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <button type="submit">Enviar solicitud de inscripción </button><br>
                    @if(isset($mensaje))
                        <b><p>{{ $mensaje }}</p></b>
                    @endif
                        </form>
                        
                    {{--Participants--}}
                    @else
                    @php
                    $participantesTorneo = App\Models\ParticipanteTorneo::all(); 
                    $count = 0;
                    @endphp
                        @foreach ($participantesTorneo as $participanteTorneo)
                                @if($participanteTorneo->torneo_id == $torneo->id)
                                    @php
                                    $count = $count+1;
                                    @endphp
                                @endif
                        @endforeach
                    <h4>Cantidad de participantes registrados actualmente:  <b>{{$count}}</b></h4>
                    <form action="{{route('notification.participante',['id' => $torneo->id])}}" method="POST">
                                @csrf
                                
                                <label for="equipo_inscrito">Inscribirme como: </label>
                                <select id="equipo_inscrito" name="equipo_inscrito">
                                    <option value="{{ auth()->user()->id }}">{{ auth()->user()->name }}</option>
                                </select>
                        <button type="submit">Enviar solicitud de inscripción </button><br>
                        @if(isset($mensaje))
                            <b><p>{{ $mensaje }}</p></b>
                        @endif
                </form>
                    
                    @endif
            @if($count < $torneo->cantEquipo)
                    <p><br>El torneo juega: {{$torneo->tipoJuego}}</p><br> 
                    <p>Organizador: {{$organizador->name}}</p><br> 
                    <p>Detalles: {{$torneo->descripcion}}</p><br> 
                    <p>Ubicacion de torneo: {{$torneo->ubicacion}}</p><br> 
                    <p>Fecha de comienzo: {{$torneo->fechaInicio}}</p><br> 
                    <p>Fecha de finalizacion: {{$torneo->fechaFin}}</p><br> 
                    <p>Tipo de torneo: {{$torneo->tipoTorneo}}</p><br> 
                    <p>Cantidad de miembros admitida: {{$torneo->cantEquipo}}</p>
                @else
                ¡Hola jugador! El torneo {{$torneo->name}} se encuentra actualmente lleno.
            <br>
            @endif
            <br><a class="button-right" href="{{route('dash_home')}}">Volver</a>
        </div>
    </section>
 </main>
        
 @endsection