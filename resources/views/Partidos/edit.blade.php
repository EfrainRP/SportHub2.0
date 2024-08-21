
<h1>Editar Partido</h1>

<form action="{{route('partidos.update',['partido' =>$partido, 'torneoID'=> $torneoID])}}" method="POST">
    @csrf
    @method('put')
    <label>Fecha del Partido: <br>
        <input type = "date" name="fechaPartido" value="{{ old('fechaPartido',$partido->fechaPartido) }}"> <br>
    </label>
    @error('fechaPartido')  {{-- Checks if there has been an error in the "name" field --}}
    <span>*{{$message}}</span> {{--print a message if there is an error--}}
    <br>
    @enderror

    <label>Hora del partido: <br>
        <input type = "time" name="horaPartido" value="{{ old('horaPartido',$partido->horaPartido) }}"> <br> 
    </label>
    @error('horaPartido')  {{-- Checks if there has been an error in the "name" field --}}
    <span>*{{$message}}</span> {{--print a message if there is an error--}}
    <br>
    @enderror

    <label>Jornada: <br>
        <input type = "date" name="jornada" value="{{ old('jornada',$partido->jornada) }}"> <br>
    </label>
    @error('jornada')  {{-- Checks if there has been an error in the "name" field --}}
    <span>*{{$message}}</span> {{--print a message if there is an error--}}
    <br>
    @enderror

    <label>Equipo Local: <br>
    <select name="equipoLocal_id">
        <option value="{{ old('equipoLocal_id',$partido->local->id) }}">{{$partido->local->name}}</option>
        @foreach($equipos as $equipo) 
            <option value="{{ $equipo->id }}">{{ $equipo->name }}</option>
        @endforeach
    </select> <br>
    @error('equipoLocal_id')  {{-- Checks if there has been an error in the "name" field --}}
    <span>*{{$message}}</span> {{--print a message if there is an error--}}
    <br>
    @enderror

    <label>Equipo Visitante: <br>
    <select name="equipoVisitante_id">
        <option value="{{ old('equipoVisitante_id',$partido->visitante->name) }}">{{$partido->visitante->name}}</option>
        @foreach($equipos as $equipo) 
            <option value="{{ $equipo->id }}">{{ $equipo->name }}</option>
        @endforeach
    </select> <br>
    @error('equipoVisitante_id')  {{-- Checks if there has been an error in the "name" field --}}
    <span>*{{$message}}</span> {{--print a message if there is an error--}}
    <br>
    @enderror

    <input type="hidden" name="partido_id" value="{{$partido->id}}" />

    <button type="submit">Actualizar</button>
    <a href="{{route('partidos.show',['partido' =>$partido, 'torneoID'=> $torneoID])}}">Volver</a>
