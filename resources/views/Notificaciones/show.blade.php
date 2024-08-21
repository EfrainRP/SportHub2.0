@extends('Dashboard.dashboard') {{-- -Inherits dashboard- --}}
@section('title', 'Notificaciones')

@section('content')
    <main class="home-section">
        <section class="principalbox">
            <div class="contorno">
                <h1 style="color: #3498db;">Notificaciones</h1>
                <h3>¡Hola {{ auth()->user()->name }}! Aquí podrás encontrar las notificaciones de tus equipos y torneos que
                    lideres.</h3>
                @foreach ($notifications as $notification)
                    {{-- Notificaciones de representantes (miembros-equipos) --}}
                    <form action="{{ route('notification.send') }}" method="post">
                        @csrf
                        @php
                            $equipo = App\Models\Equipo::find($notification->equipo_id);
                            $user = App\Models\User::find($notification->user_id);
                            $userEnvia = App\Models\User::find($notification->user_id2);
                        @endphp
                        @if ($notification->torneo_id == null && $notification->status == 'pending')
                            El usuario: <b>{{ $userEnvia->name }}</b> desea ser miembro del equipo
                            <b>"{{ $equipo->name }}."</b>
                            <input type="hidden" name="equipo_id" value="{{ $notification->equipo_id }}" />
                            <input type="hidden" name="user_id" value="{{ $notification->user_id }}" />
                            <input type="hidden" name="user_id2" value="{{ $notification->user_id2 }}" />
                            <button type="submit" name="action" value="aceptada">Aceptar</button>
                            <button type="submit" name="action" value="rechazada">Rechazar</button>
                            <br>
                        @endif
                    </form>
                @endforeach
                @foreach ($notifications as $notification)
                    {{-- Notificaciones de organizadores torneos por equipo --}}
                    <form action="{{ route('notification.send') }}" method="post">
                        @csrf
                        @php
                            $equipo = App\Models\Equipo::find($notification->equipo_id);
                            $user = App\Models\User::find($notification->user_id);
                            $torneo = App\Models\Torneo::find($notification->torneo_id);
                        @endphp
                        @if ($notification->torneo_id && $notification->equipo_id && $notification->status == 'pending')
                            El equipo: <b>{{ $equipo->name }}</b> desea ser miembro del torneo por equipos
                            <b>{{ $torneo->name }}.</b><input type="hidden" name="user_id"
                                value="{{ $notification->user_id }}" />
                            <input type="hidden" name="equipo_id" value="{{ $notification->equipo_id }}" />
                            <input type="hidden" name="torneo_id" value="{{ $notification->torneo_id }}" />
                            <button type="submit" name="action" value="aceptada">Aceptar</button>
                            <button type="submit" name="action" value="rechazada">Rechazar</button>
                            <br>
                        @endif
                    </form>
                @endforeach
                @foreach ($notifications as $notification)
                    {{-- Notificaciones de organizadores torneos individuales --}}
                    <form action="{{ route('notification.send') }}" method="post">
                        @csrf
                        @php
                            $user = App\Models\User::find($notification->user_id);
                            $torneo = App\Models\Torneo::find($notification->torneo_id);
                            $userEnvia = App\Models\User::find($notification->user_id2);
                        @endphp
                        @if ($notification->equipo_id == null && $notification->status == 'pending' && $notification->user_id2 != null)
                            El participante: <b>{{ $userEnvia->name }}</b> desea ser miembro del torneo individual
                            <b>{{ $torneo->name }}.</b>
                            <input type="hidden" name="user_id" value="{{ $notification->user_id }}" />
                            <input type="hidden" name="user_id2" value="{{ $notification->user_id2 }}" />
                            <input type="hidden" name="torneo_id" value="{{ $notification->torneo_id }}" />
                            <button type="submit" name="action" value="aceptada">Aceptar</button>
                            <button type="submit" name="action" value="rechazada">Rechazar</button>
                            <br>
                        @endif
                    </form>
                @endforeach
                @foreach ($notifications as $notification)
                    {{-- Notificaciones de usuario (participante) --}}
                    <form action="{{ route('notification.send') }}" method="post">
                        @csrf
                        @php
                            $user = App\Models\User::find($notification->user_id);
                            $torneo = App\Models\Torneo::find($notification->torneo_id);
                        @endphp
                        @if ($notification->status == 'accepted' && $notification->equipo_id == null)
                            Tú solicitud fue aceptada <b>{{ $userEnvia->name }}</b> y ahora eres participante del torneo
                            <b>{{ $torneo->name }}.</b>
                            <input type="hidden" name="user_id" value="{{ $notification->user_id }}" />
                            <input type="hidden" name="torneo_id" value="{{ $notification->torneo_id }}" />
                            <button type="submit" name="action" value="rechazada">Aceptar</button>
                            <br>
                        @endif
                    </form>
                @endforeach
                @foreach ($notifications as $notification)
                    {{-- Notificaciones de usuario (equipo) --}}
                    <form action="{{ route('notification.send') }}" method="post">
                        @csrf
                        @php
                            $equipo = App\Models\Equipo::find($notification->equipo_id);
                            $user = App\Models\User::find($notification->user_id);
                            $torneo = App\Models\Torneo::find($notification->torneo_id);
                        @endphp
                        @if ($notification->status == 'accepted' && $notification->torneo_id && $notification->equipo_id)
                            Tú solicitud de equipo fue aceptada <b>{{ $user->name }}</b> y ahora tú equipo
                            <b>{{ $equipo->name }}</b> es miembro del torneo <b>{{ $torneo->name }}.</b>
                            <input type="hidden" name="user_id" value="{{ $notification->user_id }}" />
                            <input type="hidden" name="equipo_id" value="{{ $notification->equipo_id }}" />
                            <input type="hidden" name="torneo_id" value="{{ $notification->torneo_id }}" />
                            <button type="submit" name="action" value="rechazada">Aceptar</button>
                            <br>
                        @endif
                    </form>
                @endforeach
                @foreach ($notifications as $notification)
                    {{-- Notificaciones de usuario (miembro) --}}
                    <form action="{{ route('notification.send') }}" method="post">
                        @csrf
                        @php
                            $equipo = App\Models\Equipo::find($notification->equipo_id);
                            $user = App\Models\User::find($notification->user_id);
                        @endphp
                        @if ($notification->status == 'accepted' && $notification->torneo_id == null)
                            Tú solicitud fue aceptada <b>{{ $user->name }}</b> y ahora eres miembro del equipo
                            <b>{{ $equipo->name }}</b>
                            <input type="hidden" name="user_id" value="{{ $notification->user_id }}" />
                            <input type="hidden" name="equipo_id" value="{{ $notification->equipo_id }}" />
                            <button type="submit" name="action" value="rechazada">Aceptar</button>
                            <br>
                        @endif
                    </form>
                @endforeach
                <a class="button-right" href="\dashboard">Volver</a>
            </div>
        </section>
    </main>
@endsection
