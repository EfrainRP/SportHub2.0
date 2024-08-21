@extends('Dashboard.dashboard') {{---Inherits dashboard---}}
@section('title','Partido')

@section('content')

<main class="home-section">
        <section class="principalbox">
            <div class="contorno">
<title>Partido {{$partido->id}}</title>
    
<h1>{{$partido->local->name}} VS {{$partido->visitante->name}}</h1>        
        <p>
        Resultado: {{$partido->resLocal}}   -   {{$partido->resVisitante}}<br>
        Hora: {{$partido->horaPartido}} <br>
        Fecha: {{$partido->fechaPartido}} <br>
        Jornada: {{$partido->jornada}}<br>
    </p>
        <a class="button-left" href="{{route('partidos.edit',['partido' =>$partido, 'torneoID'=> $torneoID])}}">Editar partido</a>
        <a class="button-right" href="{{route('partidos.index',$torneoID)}}">Volver a partidos</a>

        <form action="{{route('partidos.destroy',['partido' =>$partido, 'torneoID'=> $torneoID])}}" method="POST">
            @csrf
            @method("delete") {{---Change the default "post" route to "delete" ---}}
            <button class="button-left" style="margin-top: 20px;" type="submit"> Eliminar partido </button>
        </form>
            </div>
            </section>
</main>
@endsection
