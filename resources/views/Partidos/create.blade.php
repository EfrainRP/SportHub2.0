@extends('Dashboard.dashboard') {{-- -Inherits dashboard- --}}
@section('title', 'Crear partido')

@section('content')
    <main class="home-section">
        <section class="principalbox">
            <div class="contorno">
                <h1>Crear Partido</h1>

                <form action="{{ route('partidos.store', $torneoID) }}" method="POST">
                    @csrf
                    <label>Fecha del Partido:<br>
                        <input type = "date" name="fechaPartido" value="{{ old('fechaPartido') }}"> <br>
                    </label>
                    @error('fechaPartido')
                        {{-- Checks if there has been an error in the "name" field --}}
                        <span>*{{ $message }}</span> {{-- print a message if there is an error --}}
                        <br>
                    @enderror

                    <label>Hora del partido: <br>
                        <input type = "time" name="horaPartido" value="{{ old('horaPartido') }}"> <br>
                    </label>
                    @error('horaPartido')
                        {{-- Checks if there has been an error in the "name" field --}}
                        <span>*{{ $message }}</span> {{-- print a message if there is an error --}}
                        <br>
                    @enderror

                    <label>Jornada:<br>
                        <input type = "date" name="jornada" value="{{ old('jornada') }}"> <br>
                    </label>
                    @error('jornada')
                        {{-- Checks if there has been an error in the "name" field --}}
                        <span>*{{ $message }}</span> {{-- print a message if there is an error --}}
                        <br>
                    @enderror

                    <label styles="margin-botton: 20px; ">Equipo Local:<br>
                        <select name="equipoLocal_id">
                            <option value="">Seleccione equipo</option>
                            @foreach ($equipos as $equipo)
                                <option value="{{ $equipo->id }}">{{ $equipo->name }}</option>
                            @endforeach
                        </select> <br>
                    </label>
                        @error('equipoLocal_id')
                            {{-- Checks if there has been an error in the "name" field --}}
                            <span>*{{ $message }}</span> {{-- print a message if there is an error --}}
                            <br>
                        @enderror

                    <label>Equipo Visitante:<br>
                        <select name="equipoVisitante_id">
                            <option value="">Seleccione equipo</option>
                            @foreach ($equipos as $equipo)
                                <option value="{{ $equipo->id }}">{{ $equipo->name }}</option>
                            @endforeach
                        </select> <br>
                    </label>
                        @error('equipoVisitante_id')
                            {{-- Checks if there has been an error in the "name" field --}}
                            <span>*{{ $message }}</span> {{-- print a message if there is an error --}}
                            <br>
                        @enderror

                        <label style="margin-top:20px;" for="cantidad" >Resultado de equipo Local: </label>
                        <input type="number" name="resLocal" value="{{ old('resLocal') }}">
                        @error('resLocal')
                            {{-- Checks if there has been an error in the "name" field --}}
                            <span>*{{ $message }}</span> {{-- print a message if there is an error --}}
                            <br>
                        @enderror

                        <label for="cantidad" >
                            Resultado de equipo Visitante:
                        </label>
                        <input type="number" name="resVisitante" value="{{ old('resVisitante') }}">
                        @error('resVisitante')
                            {{-- Checks if there has been an error in the "name" field --}}
                            <span>*{{ $message }}</span> {{-- print a message if there is an error --}}
                            <br>
                        @enderror

                        <button class="button-left" type="submit">Crear</button>
                        @php    
                            $torneo = App\Models\Torneo::find($torneoID);
                        @endphp
                        <a class="button-right" href="{{ route('torneos.show', $torneo) }}">Volver</a>
                </form>
            </div>
        </section>
    </main>
@endsection