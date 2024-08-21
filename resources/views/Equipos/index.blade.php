@extends('Dashboard.dashboard') {{---Inherits dashboard---}}
@section('title','Pagina de equipos')

@section('content')
<main class="home-section">
  <section class="principalbox">
    <div class="contorno">     
      <h1>¡Bienvenido a tus equipos {{auth()->user()->name}}!</h1>   

            <a class="button-right" href="{{route('equipos.crear')}}">Crear equipo</a> 
            <ul>
            @php
              $teams = 0; 
            @endphp
                @foreach($equipos as $equipo) {{-- For each equipo in equipos--}}     
                        @if (auth()->user()->id == $equipo->user_id)
                            <li>
                            <a href="{{route('equipos.show',$equipo)}}">  {{-- $equipo = URL team name --}}
                            {{$equipo->name}}</a>  {{-- View: equipos.show with argument equipo->id--}}
                            </li> 
                            @php
                            $teams++;
                            @endphp
                        @endif
                @endforeach
              @if($teams < 1)
                  <p>No eres representante de ningún equipo aún.</p>
              @endif
            </ul>
          {{---{{$equipos->links()}}   <- Equipo::paginate()---}}
    </div>
  </section>
</main>
@endsection

