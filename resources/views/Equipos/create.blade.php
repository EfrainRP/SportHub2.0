@extends('Dashboard.dashboard') {{-- -Inherits dashboard- --}}
@section('title', 'Crear equipo')

@section('content')
    <main class="home-section">
        <section class="principalbox">
            <div class="contorno">
                <h1>Crear Equipo</h1>
                <form action="#" method="POST">
                    @csrf
                    <label>Nombre de equipo: <br><br>
                        <input type = "text" name="name" value="{{ old('name') }}"> <br>
                        {{-- old() recovers what was in the field before the error --}}
                    </label>
                    @error('name')
                        {{-- Checks if there has been an error in the "name" field --}}
                        <span style="margin-top:-30px; margin-left:110px;">
                            *{{ $message }}
                        </span> {{-- print a message if there is an error --}}
                        <br>
                    @enderror

                    <label>Tipo de juego del equipo: <br><br>
                        <input type = "text" name="tipoJuego" value="{{ old('tipoJuego') }}"> <br>
                    </label>
                    @error('tipoJuego')
                        {{-- Checks if there has been an error in the "name" field --}}
                        <span style="margin-top:-30px; margin-left:90px;">
                            *{{ $message }}
                        </span> {{-- print a message if there is an error --}}
                        <br>
                    @enderror

                    <div class="flex-contianer">
                        <button type="submit" class="button-left" style="height: 45px; margin-top: 13px;">
                            Crear
                        </button>
                        <a href="{{route('dashboard.index')}}" class="button-right">Volver</a>
                    </div>

                    <!-- <a href="/equipos">Volver</a> -->
                </form>
            </div>
        </section>
    </main>
@endsection
