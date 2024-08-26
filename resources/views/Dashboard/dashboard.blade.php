@extends('Dashboard.slidebar')
@section('title', 'SPORTHUB')

@section('content')

<main class="home-section">
    <section class="principalbox">
            <p class="title">Mis Torneos</p>
            <div class="box">
                {{-- TORNEOS --}}
                @foreach($torneos as $torneo)
                    <div class="minibox">
                        <a class="name" href="{{route('torneos.show',$torneo)}}"> {{$torneo->name}}</a>
                        <p class="description">Tipo: Baloncesto</p>
                        <p class="description">Rol: {{$torneo->rol}}</p>
                    </div>
                @endforeach
            </div>
        </section>

        {{-- EQUIPOS --}}
        <section class="principalbox">
            <p class="title">Mis equipos</p>
            <div class="box">
                @foreach($equipos as $equipo) 
                    <div class="minibox">
                        <a class="name" href="{{route('equipos.show',$equipo)}}">{{$equipo->name}}</a>
                        <p class="teamdescription">Rol:  {{$equipo->rol}}</p>
                    </div>
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
                    <tr>
                        <td>{{$partido->torneoName}}</td> {{--checar posibles errores--}}
                        <td>{{$partido->equipoLocalName}}</td>
                        <td>{{$partido->equipoVisName}}</td>
                        <td>{{$partido->fechaPartido}}</td>
                        <td>{{$partido->horaPartido}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>
</main>
@endsection