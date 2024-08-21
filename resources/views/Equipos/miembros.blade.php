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
    <a href="{{route('equipos.edit',$equipo)}}">Volver</a>
</form>