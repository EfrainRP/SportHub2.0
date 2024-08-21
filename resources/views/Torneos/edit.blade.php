@extends('Dashboard.slidebar') {{---Inherits dashboard---}}
@section('title','Equipo')

<title>Torneo: {{$torneo->name}}</title>

@section('content')
<section class="principalbox">
    <section class="contorno">
        <h1>Editar Torneo</h1><br>

        <form action="{{route('torneos.update', $torneo)}}" method="POST">
            @csrf
            @method('put') {{-- Change POST to put route --}}
            <label>Nombre de torneo: <br>
                <input type = "text" name="name" value="{{ old('name',$torneo->name) }}"> <br>  {{-- old() recovers what was in the field before the error --}}
            </label>
            @error('name')  {{-- Checks if there has been an error in the "name" field --}}
                <span>*{{$message}}</span> {{--print a message if there is an error--}}
            <br>
            @enderror

            <label>Ubicación: <br>
                <input type = "text" name="ubicacion" value="{{ old('ubicacion',$torneo->ubicacion) }}"> <br>  {{-- old() recovers what was in the field before the error --}}
            </label>
            @error('ubicacion')  {{-- Checks if there has been an error in the "ubicacion" field --}}
                <span>*{{$message}}</span> {{--print a message if there is an error--}}
            <br>
            @enderror

            <label>Tipo de juego del torneo: <br>
                <input type = "text" name="tipoJuego" value="{{ old('tipoJuego',$torneo->tipoJuego) }}"> <br>
            </label>
            @error('tipoJuego')  {{-- Checks if there has been an error in the "name" field --}}
                <span>*{{$message}}</span> {{--print a message if there is an error--}}
            <br>
            @enderror

            <label>Descripción: <br>
                <input type = "text" name="descripcion" value="{{ old('descripcion',$torneo->descripcion) }}"> <br>
            </label>
            @error('descripcion')  {{-- Checks if there has been an error in the "name" field --}}
                <span>*{{$message}}</span> {{--print a message if there is an error--}}
            <br>
            @enderror
            
            <label>Fecha de Inicio: <br>
                <input type = "date" name="fechaInicio" value="{{ old('fechaInicio',$torneo->fechaInicio) }}"> <br>
            </label>
            @error('fechaInicio')  {{-- Checks if there has been an error in the "name" field --}}
                <span>*{{$message}}</span> {{--print a message if there is an error--}}
            <br>
            @enderror

            <label>Fecha de Fin: <br>
                <input type = "date" name="fechaFin" value="{{ old('fechaFin',$torneo->fechaFin) }}"> <br>
            </label>
            @error('fechaFin')  {{-- Checks if there has been an error in the "name" field --}}
                <span>*{{$message}}</span> {{--print a message if there is an error--}}
            <br>
            @enderror
            
            <label for="individual">Tipo de torneo actual: {{$torneo->tipoTorneo}}</label><br>

            <label for="individual">Individual</label>
            <input type="radio" id="Individual" name="tipoTorneo" value="Individual" required
                {{ old('tipoTorneo', $torneo->tipoTorneo) == 'Individual' ? 'checked' : '' }}> <br>

            <label for="equipos">Equipos</label>

            <input type="radio" id="Equipos" name="tipoTorneo" value="Equipos" required
            {{ old('tipoTorneo', $torneo->tipoTorneo) == 'Equipos' ? 'checked' : '' }}> <br>
                
            @error('tipoTorneo')  {{-- Checks if there has been an error in the "name" field --}}
                <span>*{{$message}}</span> {{--print a message if there is an error--}}
            <br>
            @enderror

            <label for="cantidad">Cantidad de miembros:</label>
                <input type="number" id="cantEquipo" name="cantEquipo" value="{{$torneo->cantEquipo}}"> 
            <br>
            @error('cantEquipo')  {{-- Checks if there has been an error in the "name" field --}}
                <span>*{{$message}}</span> {{--print a message if there is an error--}}
            @enderror
            
            @if ($torneo->tipoTorneo == "Equipos")
                @php
                    $equiposTorneo = App\Models\Estadistica::all(); 
                    $var1 = '1';
                @endphp
                <h2>Equipos del torneo</h2><br>
                @foreach ($equiposTorneo as $equipoTorneo)
                    @if ($equipoTorneo->torneo_id == $torneo->id)
                        <li>
                            @php
                                $equipo = App\Models\Equipo::find($equipoTorneo->equipo_id) 
                            @endphp
                            <form action="{{route('participantes.destroy',['torneo'=> $torneo,'equipo_id'=>$equipo->id])}}" method="POST">
                                @csrf
                                @method("delete") {{---Change the default "post" route to "delete" ---}}{{$equipo->name}} 
                                <button class="button-left" type="submit" style="height: 45px; margin-top: 13px;"> Eliminar torneo </button>
                            </form>
                        </li>     
                        @php
                            $var1 = $var1+1;
                        @endphp
                    @endif
                @endforeach
                <a class="button-right" href="{{route('equipos.torneo',$torneo)}}">Editar equipo</a>
            @else {{--Show participants--}}
                @php
                    $participantesTorneo = App\Models\ParticipanteTorneo::all(); 
                    $var1 = '1';
                @endphp
                <h2>Participantes del torneo</h2>
                    @foreach ($participantesTorneo as $participanteTorneo)
                        @if ($participanteTorneo->torneo_id == $torneo->id)
                            @php
                                $user = App\Models\User::find($participanteTorneo->user_id) 
                            @endphp
                                <li>
                                <form action="{{route('participantes.destroy',['torneo'=> $torneo,'user_id'=>$user->id])}}" method="POST">
                                    @csrf
                                    @method("delete") {{---Change the default "post" route to "delete" ---}}{{$user->name}}
                                    <button class="button-left" type="submit" style="height: 45px; margin-top: 13px;"> Eliminar torneo </button>
                                </form>
                            </li>     
                            @php
                                $var1 = $var1+1;
                            @endphp
                        @endif
                    @endforeach
                <a class="button-right" href="{{route('participantes.torneo',$torneo)}}">Editar participante/s</a>
            {{--<a href="{{route('participante.torneo')}}">Agregar participante</a>--}}
            @endif
            <div class="flex-contianer">
            {{--<a href="{{route('equipos.torneos',$torneo)}}">Agregar miembro</a>--}}
            <button type="submit" class="button-left" style="height: 45px; margin-top: 13px;">Actualizar</button>
            <a class="button-right" href="{{route('torneos.show',$torneo)}}">Volver</a>
            </div>
        </form>
    </section>
</section>
