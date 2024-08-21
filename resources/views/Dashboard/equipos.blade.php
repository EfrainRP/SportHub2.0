@extends('Dashboard.slidebar')
@section('title', 'SPORTHUB')

@section('content')
<main class="home-section">
    <section class="principalbox">
        <div class="contorno">

            <title>Equipo {{$equipo->name}}</title>
                    <h1>Equipo {{$equipo->name}}</h1>
                    <p>
                        El equipo juega: {{$equipo->tipoJuego}} <br> <br>Representante: {{$representante->name}}</p><br>
                    @php
                    $miembros = App\Models\MiembroEquipo::all(); 
                    @endphp
                    <h2>Miembros del equipo:</h2>
                    @foreach ($miembros as $miembro)
                    
                            @if ($equipo->id == $miembro->equipo_id)
                            <br>Miembro: {{$miembro->user_miembro}}<br>
                            @endif
                
                    @endforeach
                    <form action="{{route('notification.index',['id' => $equipo->id])}}" method="POST">
                        @csrf
                        <br><button type="submit">Enviar solicitud de inscripción </button><br>
                        @if(isset($mensaje))
                        <b><p>{{ $mensaje }}</p></b>
                        @endif
                    </form>
                    <a class="button-right" href="{{route('dash_home')}}">Volver</a>
        </div>
    </section>
</main>
@endsection