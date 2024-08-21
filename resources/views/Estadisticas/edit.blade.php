
<h1>Editar Torneo</h1>

<form action="{{route('torneos.update', $torneo)}}" method="POST">
    @csrf
    @method('put') {{-- Change POST to put route --}}
    <label>Nombre de torneo: <br>
        <input type = "text" name="name" value="{{ old('name') }}"> <br>  {{-- old() recovers what was in the field before the error --}}
    </label>
    @error('name')  {{-- Checks if there has been an error in the "name" field --}}
    <span>*{{$message}}</span> {{--print a message if there is an error--}}
    <br>
    @enderror

    <label>Ubicación: <br>
        <input type = "text" name="ubicacion" value="{{ old('ubicacion') }}"> <br>  {{-- old() recovers what was in the field before the error --}}
    </label>
    @error('ubicacion')  {{-- Checks if there has been an error in the "ubicacion" field --}}
    <span>*{{$message}}</span> {{--print a message if there is an error--}}
    <br>
    @enderror

    <label>Tipo de juego del torneo: <br>
        <input type = "text" name="tipoJuego" value="{{ old('tipoJuego') }}"> <br>
    </label>
    @error('tipoJuego')  {{-- Checks if there has been an error in the "name" field --}}
    <span>*{{$message}}</span> {{--print a message if there is an error--}}
    <br>
    
    @enderror

    <label>Descripción: <br>
        <input type = "text" name="descripcion" value="{{ old('descripcion') }}"> <br>
    </label>
    @error('descripcion')  {{-- Checks if there has been an error in the "name" field --}}
    <span>*{{$message}}</span> {{--print a message if there is an error--}}
    <br>
    @enderror
    
    <label>Fecha de Inicio: <br>
        <input type = "date" name="fechaInicio" value="{{ old('fechaInicio') }}"> <br>
    </label>
    @error('fechaInicio')  {{-- Checks if there has been an error in the "name" field --}}
    <span>*{{$message}}</span> {{--print a message if there is an error--}}
    <br>
    @enderror

    <label>Fecha de Fin: <br>
        <input type = "date" name="fechaFin" value="{{ old('fechaFin') }}"> <br>
    </label>
    @error('fechaFin')  {{-- Checks if there has been an error in the "name" field --}}
    <span>*{{$message}}</span> {{--print a message if there is an error--}}
    <br>
    @enderror
    
    <label>Tipo de torneo: <br>
        <input type = "text" name="tipoTorneo" value="{{ old('tipoTorneo') }}"> <br>
    </label>
    @error('tipoTorneo')  {{-- Checks if there has been an error in the "name" field --}}
    <span>*{{$message}}</span> {{--print a message if there is an error--}}
    <br>
    @enderror

    <button type="submit">Actualizar</button>
    
    <a href="/torneos">Volver</a>
