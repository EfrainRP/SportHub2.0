@extends('Dashboard.slidebar') {{---Inherits dashboard---}}
@section('title','Equipo')

<title>Equipo: {{$equipo->name}}</title>
@section('content')
<main class="home-section">
    <section class="principalbox">
        <section class="contorno">
            <h1>Equipo: {{$equipo->name}}</h1><br>
            <p>Representante: {{$representante->name}} <br>El equipo juega: {{$equipo->tipoJuego}} <br></p>
                @php
                    $miembros = App\Models\MiembroEquipo::all(); 
                @endphp

            <h2>Miembros del equipo:</h2>
            @foreach ($miembros as $miembro)
                @php
                    $equipoMiembro = App\Models\Equipo::find($miembro->equipo_id);
                @endphp
                @if ($equipoMiembro->user_id == auth()->user()->id && $miembro->equipo_id == $equipo->id)
                    Miembro: {{$miembro->user_miembro}}<br>
                @endif
            @endforeach

            <div class="flex-contianer">
                @if(auth()->user()->id == $equipo->user_id) {{-- Verifica si el usuario es el representante --}}
                    <a class="button-right" href="{{route('equipos.edit',$equipo)}}">Editar equipo</a>

                    <form action="{{route('equipos.destroy',$equipo)}}" method="POST">
                        @csrf
                        @method("delete") {{---Change the default "post" route to "delete" ---}}
                            <button class="button-left" type="submit" style="height: 45px; margin-top: 13px;"> Eliminar equipo </button>
                    </form>
                @endif

                <a class="button-right" href="{{route('dashboard.index')}}">Volver</a>

                
            </div>
        </section>
    </section>
</main>
@endsection
