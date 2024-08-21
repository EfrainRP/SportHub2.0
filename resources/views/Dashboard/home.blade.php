@extends('Dashboard.dashboard') {{---Inherits dashboard---}}
@section('title','Torneo')

<title>Home</title>

@section('content')
<main class="home-section">
    <section class="principalbox">
        <section class="contorno">
            <h1>Home</h1> 
            @php
                $torneos = App\Models\Torneo::all();
                $equipos = App\Models\Equipo::all();
            @endphp
            <h3>Torneos SportHub</h3>
            @foreach ($torneos as $torneo)
                <a href="{{route('dashboard.torneo',$torneo)}}">{{$torneo->name}}</a>
                    <br>
            @endforeach
            <br><br>
            <h3>Equipos SportHub</h3>
            @foreach ($equipos as $equipo)
                <a href="{{route('dashboard.equipo',$equipo)}}">{{$equipo->name}}</a>
                    <br>
            @endforeach
        </section>
    </section>
</main>
@endsection