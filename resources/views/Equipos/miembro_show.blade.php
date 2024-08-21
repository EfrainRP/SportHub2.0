<form action="{{route('equipos.update', $miembro)}}" method="POST">
    @csrf
    @method('put') {{-- Change POST to put route --}}
    <label>Nombre del miembro: <br>
        <input type = "text" name="name" value="{{ old('name',$equipo->name) }}"> <br>  {{-- old() recovers what was in the field before the error --}}
    </label>
    @error('name')  {{-- Checks if there has been an error in the "name" field --}}
    <span>*{{$message}}</span> {{--print a message if there is an error--}}
    <br>
@enderror