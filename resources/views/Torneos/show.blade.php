@extends('Dashboard.dashboard') {{---Inherits dashboard---}}
@section('title','Torneo')

<title>Torneo: {{$torneo->name}}</title>

@section('content')
<main class="home-section">
    <section class="principalbox" style="margin: 20px 20px;">
            <h1>Torneo: {{$torneo->name}}</h1><br>
            <p>El torneo juega: {{$torneo->tipoJuego}} <br> 
                Organizador: {{$organizador->name}} <br> 
                Detalles: {{$torneo->descripcion}}<br> 
                Ubicacion de torneo: {{$torneo->ubicacion}}<br> 
                Fecha de comienzo: {{$torneo->fechaInicio}}<br> 
                Fecha de finalizacion: {{$torneo->fechaFin}}<br> 
                Tipo de torneo: {{$torneo->tipoTorneo}}<br> 
                Cantidad de miembros admitida: {{$torneo->cantEquipo}}<br> <br> 

                <style>
                th {
                        text-align: center;
                    }
                </style>
                
                <h1>Estadisticas</h1>
                <table>
                <thead>
                    <tr>
                        <th>Equipo</th>
                        <th>Puntaje</th>
                        <th>DC</th>
                        <th>CA</th>
                        <th>CC</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($torneo->estadistica as $equipo)
                        <tr>
                            <td>{{$equipo->name}}</td><!--equipo-->
                            <td>{{$equipo->pivot->PT}}</td><!-- Puntos a favor -->
                            <td>{{$equipo->pivot->DC}}</td><!-- diferencia de canasta -->
                            <td>{{$equipo->pivot->CA}}</td><!--canasta anotadas-->
                            <td>{{$equipo->pivot->CC}}</td><!-- canastas en contra-->
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>

            <h1>Proximos Partidos</h1>
            <table>
                <thead>
                    <tr>
                        <th>Equipo Local</th>
                        <th>PL</th>
                        <th>PV</th>
                        <th>Equipo Visitante</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @php
                        $torneoEquipo = App\Models\Partido::find($torneo);
                    @endphp
                    @foreach($torneoEquipo as $equipo)
                        <tr>
                            <td>{{$equipo->local->name}}</td><!--Local-->
                            <td>{{$equipo->resLocal}}</td><!-- PL -->
                            <td>{{$equipo->resVisitante}}</td><!-- PV -->
                            <td>{{$equipo->visitante->name}}</td><!--Visitante-->
                            <td>{{$equipo->fechaPartido}}</td><!-- Fecha -->
                            <td>{{$equipo->horaPartido}}</td><!-- Hora -->
                        </tr>
                    @endforeach
                </tbody>
            </table>

            
            @if ($torneo->tipoTorneo == "Equipos")
                @php
                    $equiposTorneo = App\Models\Estadistica::all(); 
                @endphp
                <h2>Equipos en el torneo:</h2>
                    @foreach ($equiposTorneo as $equipoTorneo)
                        @if($equipoTorneo->torneo_id == $torneo->id)
                            @php
                                $equipo = App\Models\Equipo::find($equipoTorneo->equipo_id);
                            @endphp
                            Equipo: {{$equipo->name}}<br>
                        @endif
                    @endforeach
            @else
                @php
                    $participantesTorneo = App\Models\ParticipanteTorneo::all(); 
                @endphp
                <h2>Participantes en el torneo:</h2>
                    @foreach ($participantesTorneo as $participanteTorneo)
                        @if($participanteTorneo->torneo_id == $torneo->id)
                            @php
                                $user = App\Models\user::find($participanteTorneo->user_id);
                            @endphp
                            Participante: {{$user->name}}<br>
                        @endif
                    @endforeach
            @endif

            <div class="flex-contianer">
                @if(auth()->user()->id == $organizador->id) {{-- Verifica si el usuario es el representante --}}
                    <a class="button-right" href="{{route('torneos.edit',$torneo)}}">Editar torneo</a>
                    <form action="{{route('torneos.destroy',$torneo)}}" method="POST">
                        @csrf
                        @method("delete") {{---Change the default "post" route to "delete" ---}}
                        <button class="button-left" type="submit" style="height: 45px; margin-top: 13px;"> Eliminar torneo </button>
                    </form>
                    <a class="button-right" href="{{route('partidos.crear',['torneoID'=>$torneo->id])}}">Crear partidos</a>
                @endif
                <a class="button-right" href="{{route('dashboard.index')}}">Volver</a>
            </div>
    </section>
</main>
@endsection
