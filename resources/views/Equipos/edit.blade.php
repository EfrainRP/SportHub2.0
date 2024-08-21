@extends('Dashboard.dashboard') {{-- -Inherits dashboard- --}}
@section('title', 'Crear equipo')

@section('content')
    <main class="home-section">
        <section class="principalbox">
            <div class="contorno">
                <h1>Editar Equipo</h1>

                <form action="{{route('equipos.update', $equipo)}}" method="POST">
                    @csrf
                    @method('put') {{-- Change POST to put route --}}
                    <label>Nombre de equipo: <br>
                        <input type = "text" name="name" value="{{ old('name',$equipo->name) }}"> <br>  {{-- old() recovers what was in the field before the error --}}
                    </label>
                    @error('name')  {{-- Checks if there has been an error in the "name" field --}}
                        <span>*{{$message}}</span> {{--print a message if there is an error--}}
                    <br>
                    @enderror

                    <label>Tipo de juego del equipo: <br>
                        <input type = "text" name="tipoJuego" value="{{ old('tipoJuego',$equipo->tipoJuego) }}"> <br>
                    </label>
                    @error('tipoJuego')  {{-- Checks if there has been an error in the "name" field --}}
                        <span>*{{$message}}</span> {{--print a message if there is an error--}}
                    <br>
                    @enderror

                    <button type="submit">Actualizar</button>
                </form>
                    @php
                        $miembros = App\Models\MiembroEquipo::all(); 
                        $var1 = '1';
                    @endphp

                    <h2>Miembros del equipo:</h2>
                    @foreach ($miembros as $miembro)
                            @if ($equipo->id == $miembro->equipo_id)
                                <li>
                                    {{-- $equipo = URL team name --}}
                                    {{$miembro->user_miembro}} 
                                    <input type="hidden" name ="user_miembro{{$var1}}" value="{{$miembro->user_miembro}} ">
                                    <button type="submit" name="eliminar" value="eliminar{{$var1}}">Eliminar</button><br>{{-- View: equipos.show with argument equipo->id--}}
                                </li>     
                                @php
                                    $var1 = $var1+1;
                                @endphp
                            @endif
                    @endforeach
                
                    <form action="{{route('equipos.store',$equipo)}}" method="POST">
                    @csrf
                    <label>Nombre del nuevo miembro: <br>
                        <input type = "text" name="user_miembro" value="{{ old('user_miembro') }}"> <br>  {{-- old() recovers what was in the field before the error --}}
                    </label>

                    @error('user_miembro')  {{-- Checks if there has been an error in the "name" field --}}
                        <span>*{{$message}}</span> {{--print a message if there is an error--}}
                    <br>
                    @enderror

                    <input type="hidden" name ="equipo_id" value="{{ $equipo->id }}">
                    <button type="submit">Añadir miembro</button>
                </form>
    <a href="{{route('equipos.show',$equipo)}}">Volver</a>
</div>
</section>
</main>
@endsection

