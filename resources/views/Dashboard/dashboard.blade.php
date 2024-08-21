@extends('Dashboard.slidebar')
@section('title', 'SPORTHUB')

@section('content')

@php
    $equipos = App\Models\Equipo::all();
    $miembrosEquipos= App\Models\MiembroEquipo::all();

    $torneos = App\Models\Torneo::all();
    $participanteTorneos = App\Models\ParticipanteTorneo::all();
    $equipoTorneos = App\Models\Estadistica::all();
    $torneo = App\Models\Torneo::find($equipoTorneos);
    $partidos = App\Models\Partido::all();

    $flag = true


@endphp
<main class="home-section">
    <section class="principalbox">
            <p class="title">Mis Torneos</p>
            <div class="box">
                @foreach($torneos as $torneo)
                    @if (auth()->user()->id == $torneo->user_id)  {{-- organizador--}}
                        <div class="minibox">
                        <a class="name" href="{{route('torneos.show',$torneo)}}"> {{$torneo->name}}</a>
                        <p class="description">Tipo: Baloncesto</p>
                        <p class="description">Rol: Organizador</p>
                        </div>
                        @php
                            $flag =false;
                        @endphp
                    @endif
                    @endforeach
                    @foreach($equipoTorneos as $equipoTorneo) {{-- Representantes de equipo--}}
                        @php
                            $equipo = App\Models\Equipo::find($equipoTorneo->equipo_id);
                            $torneo = App\Models\Torneo::find($equipoTorneo->torneo_id);
                        @endphp
                        @if (auth()->user()->id == $equipo->user_id)
                            <div class="minibox">
                                <a class="name" href="{{route('torneos.show',$torneo)}}">{{$torneo->name}}</a>
                                <p class="description">Organizador: {{$torneo->organizador->nickname}}</p>
                                <p class="description">Equipo: {{$equipo->name}}</p>
                                <p class="description">Tipo: Baloncesto</p>
                                <p class="description">Rol: Capitan </p>
                            </div>
                        @endif 
                    @endforeach

                @foreach($miembrosEquipos as $miembro)    {{-- miembro de equipo--}}
                    @php
                        $equipo = App\Models\Equipo::find($miembro->equipo_id)->first();
                        $capitan = App\Models\User::find($miembro->miembros->user_id);
                        $torneo = App\Models\Torneo::find($equipo->estadistica)->first();
                    @endphp
                    @if (auth()->user()->name == $miembro->user_miembro && (auth()->user()->name != $capitan->name))
                        
                        <div class="minibox">
                        <a class="name" href="{{route('torneos.show',$torneo)}}">{{$torneo->name}}</a> 
                        <p class="description">Organizador:{{$torneo->organizador->nickname}}</p>
                        <p class="description">Equipo:{{$miembro->miembros->name}}</p>
                        <p class="description">Tipo: Baloncesto</p>
                        <p class="description">Rol: Miembro</p>
                        </div>
                        @php
                            $flag =false;
                        @endphp
                    @endif
                @endforeach
                
                @foreach($participanteTorneos as $individualTorneo)    {{-- representante individual--}}
                        @if (auth()->user()->id == $individualTorneo->user_id)
                            <div class="minibox">
                                @php
                                    $torneo = App\Models\Torneo::find($individualTorneo->torneo_id);
                                @endphp
                            <a href="{{route('torneos.show',$torneo)}}" class="name">{{$torneo->name}}</a>
                            <p class="description">Organizador:{{$torneo->organizador->nickname}}</p>
                            <p class="description">Tipo: Baloncesto</p>
                            <p class="description">Rol: Individual</p>
                            </div>
                            @php
                                $flag =false;
                            @endphp
                        @endif
                    @endforeach
            </div>
        </section>

        <section class="principalbox">
            <p class="title">Mis equipos</p>
            <div class="box">
                @foreach($equipos as $equipo)    {{-- representante de equipo--}}
                    @if (auth()->user()->id == $equipo->user_id )
                        <div class="minibox">
                            <a class="name" href="{{route('equipos.show',$equipo)}}">{{$equipo->name}}</a>
                            <p class="teamdescription">Rol: Capitan</p>
                        </div>
                    @endif
                @endforeach

                @foreach($miembrosEquipos as $miembro)    {{-- miembro --}}
                    @php
                        $capitan = App\Models\User::find($miembro->miembros->user_id);
                    @endphp
                    @if (auth()->user()->name == $miembro->user_miembro && (auth()->user()->name != $capitan->name))
                        <div class="minibox">
                            <a class="name" href="{{route('equipos.show',$miembro->miembros)}}">{{$miembro->miembros->name}}</a>
                            <p class="teamdescription">Rol: Miembro</p>

                    @endif
                @endforeach
            </div>
        </section>
        
        <section class="principalbox">
            <p class="title">Próximos partidos</p>
            <table>
                <thead>
                <tr>
                    <th>Torneo</th>
                    <th>Equipo Local</th>
                    <th>Equipo Visitante</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                </tr>
                </thead>
                <tbody>
                @foreach($partidos as $partido) {{-- Representantes de equipo--}}
                    @php
                        $torneo = App\Models\Torneo::find($partido->estanTorneos)->first();
                    @endphp
                    @if($torneo != null)
                    @if (auth()->user()->id == $partido->local->user_id)
                        <tr>
                            <td>Torneo {{$torneo->name}}</td> {{--checar posibles errores--}}
                            <td>Equipo {{$partido->local->name}}</td>
                            <td>Equipo {{$partido->visitante->name}}</td>
                            <td>{{$partido->fechaPartido}}</td>
                            <td>{{$partido->horaPartido}}</td>
                        </tr>
                    @elseif (auth()->user()->id == $partido->visitante->user_id)
                        <tr>
                            <td>Torneo {{$torneo->name}}</td>{{--checar posibles errores--}}
                            <td>Equipo {{$partido->visitante->name}}</td>
                            <td>Equipo {{$partido->local->name}}</td>
                            <td>{{$partido->fechaPartido}}</td>
                            <td>{{$partido->horaPartido}}</td>
                        </tr>
                    @else
                        @foreach($miembrosEquipos as $miembro) {{-- Participante de partidos--}}   
                            @if (auth()->user()->name == $miembro->user_miembro)
                                <tr>
                                    <td>Torneo {{$torneo->name}}</td> {{--checar posibles errores--}}
                                    <td>Equipo {{$partido->local->name}}</td>
                                    <td>Equipo {{$partido->visitante->name}}</td>
                                    <td>{{$partido->fechaPartido}}</td>
                                    <td>{{$partido->horaPartido}}</td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                    @endif
                @endforeach
                </tbody>
            </table>
        </section>
    </main>
@endsection