@extends('Dashboard.dashboard') {{-- -Inherits dashboard- --}}
@section('title', 'Crear Torneo')

@section('content')
        <section class="principalbox">
            <div class="contorno">
                <h1>Crear Torneo</h1>
                <form action="#" method="POST">
                    @csrf
                    <label>Nombre de torneo: <br>
                        <input type = "text" name="name" value="{{ old('name') }}"> <br> {{-- old() recovers what was in the field before the error --}}
                    </label>
                    @error('name')
                        {{-- Checks if there has been an error in the "name" field --}}
                        <span style="margin-top:-30px; margin-left:105px;">
                            *{{ $message }}
                        </span> {{-- print a message if there is an error --}}
                        <br>
                    @enderror

                    <label>Ubicación: <br>
                        <input type = "text" name="ubicacion" value="{{ old('ubicacion') }}"> <br>
                        {{-- old() recovers what was in the field before the error --}}
                    </label>
                    @error('ubicacion')
                        {{-- Checks if there has been an error in the "ubicacion" field --}}
                        <span style="margin-top:-30px; margin-left:100px;">
                            *{{ $message }}
                        </span> {{-- print a message if there is an error --}}
                        <br>
                    @enderror

                    <label>Tipo de juego del torneo: <br>
                        <input type = "text" name="tipoJuego" value="{{ old('tipoJuego') }}"> <br>
                    </label>
                    @error('tipoJuego')
                        {{-- Checks if there has been an error in the "name" field --}}
                        <span style="margin-top:-30px; margin-left:90px;">
                            *{{ $message }}
                        </span> {{-- print a message if there is an error --}}
                        <br>
                    @enderror

                    <label>Descripción: <br>
                        <input type = "text" name="descripcion" value="{{ old('descripcion') }}"> <br>
                    </label>
                    @error('descripcion')
                        {{-- Checks if there has been an error in the "name" field --}}
                        <span style="margin-top:-30px; margin-left:90px;">
                            *{{ $message }}
                        </span> {{-- print a message if there is an error --}}
                        <br>
                    @enderror

                    <label>Fecha de Inicio: <br>
                        <input type = "date" name="fechaInicio" value="{{ old('fechaInicio') }}"> <br>
                    </label>
                    @error('fechaInicio')
                        {{-- Checks if there has been an error in the "name" field --}}
                        <span style="margin-top:-30px; margin-left:85px;">
                            *{{ $message }}
                        </span> {{-- print a message if there is an error --}}
                        <br>
                    @enderror

                    <label>Fecha de Fin: <br>
                        <input type = "date" name="fechaFin" value="{{ old('fechaFin') }}"> <br>
                    </label>
                    @error('fechaFin')
                        {{-- Checks if there has been an error in the "name" field --}}
                        <span style="margin-top:-30px; margin-left:65px;">
                            *{{ $message }}
                        </span> {{-- print a message if there is an error --}}
                        <br>
                    @enderror
                    <label class="tipo torneo">Elige el tipo de torneo:</label><br>
                    <label for="Individual">Individual</label>
                    <input type="radio" id="Individual" name="tipoTorneo" value="Individual" required
                        {{ old('tipoTorneo') == 'Individual' ? 'checked' : '' }}> <br>
                    <label for="Equipos">Equipos</label>
                    <input type="radio" id="Equipos" name="tipoTorneo" value="Equipos" required
                        {{ old('tipoTorneo') == 'Equipos' ? 'checked' : '' }}>
                    <br>
                    @error('tipoTorneo')
                        {{-- Checks if there has been an error in the "name" field --}}
                        <span>
                            *{{ $message }}
                        </span> {{-- print a message if there is an error --}}
                        <br>
                    @enderror
                    
                    @if (old('tipoTorneo') == 'Individual' || old('tipoTorneo') == 'Equipos')
                        <label for="cantidad">
                            Cantidad de miembros en el torneo aceptada:
                        </label>
                        <input type="number" id="cantEquipo" name="cantEquipo" style="display: block"
                            value="{{ old('cantEquipo') }}">
                        <br>
                    @else
                        <label for="cantidad" style="display: none">
                            Cantidad de equipo/participantes en el torneo:
                        </label>
                        <input type="number" id="cantEquipo" name="cantEquipo" style="display: none"
                            value="{{ old('cantEquipo') }}">
                        <br>
                    @endif
                    
                    @error('cantEquipo')
                        {{-- Checks if there has been an error in the "name" field --}}
                        <span style="margin-top:-10px; margin-left:65px;">
                            *{{ $message }}</span> {{-- print a message if there is an error --}}
                    @enderror
                    
                    <script>
                        // Agregar un listener para el cambio en el radio button
                        document.querySelectorAll('input[name="tipoTorneo"]').forEach(function(radio) {
                            radio.addEventListener('change', function() {
                                // Mostrar u ocultar el input adicional según la opción seleccionada
                                document.getElementById('cantEquipo').style.display = (this.value === 'Individual' || this.value === 'Equipos') ? 'block' : 'none';
                                // Mostrar u ocultar el label adicional según la opción seleccionada
                                document.querySelector('label[for="cantidad"]').style.display = (this.value === 'Individual' || this.value === 'Equipos') ? 'block' : 'none';
                            });
                        });
                    
                        // Mostrar u ocultar el input y label adicionales al cargar la página
                        document.addEventListener('DOMContentLoaded', function() {
                            const selectedValue = document.querySelector('input[name="tipoTorneo"]:checked').value;
                            document.getElementById('cantEquipo').style.display = (selectedValue === 'Individual' || selectedValue === 'Equipos') ? 'block' : 'none';
                            document.querySelector('label[for="cantidad"]').style.display = (selectedValue === 'Individual' || selectedValue === 'Equipos') ? 'block' : 'none';
                        });
                    </script>

                    <div class="flex-contianer">
                        <button type="submit" class="button-left" style="height: 45px; margin-top: 13px;">
                            Crear
                        </button>
                        <a href="{{route('dashboard.index')}}" class="button-right">Volver</a>
                    </div>

                    <!-- <button type="submit" class="button-left" style="margin-right: 290px">
                        Crear
                    </button>
                    <a href="/equipos" class="button-right">Volver</a>

                    <a href="/torneos">Volver</a> -->
                </form>
            </div>
        </section>

@endsection
