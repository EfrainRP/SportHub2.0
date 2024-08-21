

@extends('Dashboard.dashboard') {{---Inherits dashboard---}}
@section('title','Pagina de torneos')

@section('content')
    <h1>¡Bienvenido a tus torneos {{auth()->user()->name}}!</h1>  
    <a href="{{route('torneos.crear')}}">Crear torneo</a> 
    <ul>
    @php
      $teams = 0; 
    @endphp
        @foreach($torneos as $torneo) {{-- For each torneo in torneos--}}     
                @if (auth()->user()->id == $torneo->user_id)
                    <li>
                    <a href="{{route('torneos.show',$torneo)}}">  {{-- $torneo = URL team name --}}
                    {{$torneo->name}}</a>  {{-- View: torneos.show with argument torneo->id--}}
                     </li> 
                     @php
                     $teams++;
                     @endphp
                @endif
        @endforeach
      @if($teams < 1)
          <p>No eres organizador de ningún torneo aún.</p>
      @endif
    </ul>
   {{---{{$torneos->links()}}   <- Torneo::paginate()---}}
@endsection
