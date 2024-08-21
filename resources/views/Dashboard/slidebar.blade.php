<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="preload" href="{{ asset('css/dashboard.css') }}" as="style">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link rel="preload" href="{{ asset('css/formulario.css') }}" as="style">
    <link href="{{ asset('css/formularios.css') }}" rel="stylesheet">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/887a835504.js" crossorigin="anonymous"></script>


</head>

<body class="sidebarbody">

    <div class="sidebar">
        <div class="logo-details">
            <div class="logo_name">SportHub</div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">

            <li>
                <a href="{{ route('dashboard.index') }}">
                    <i class='bx bx-home'></i>
                    <span class="links_name">Inicio</span>
                </a>
                <span class="tooltip">Inicio</span>
            </li>

            <li>
                <a href="{{ route('torneos.crear') }}">
                    <i class='bx bx-trophy'></i>
                    <span class="links_name">Crear Torneo</span>
                </a>
                <span class="tooltip">Crear Torneo</span>
            </li>

            <li>
                <a href="{{ route('equipos.crear') }}">
                    <i class='bx bx-group'></i>
                    <span class="links_name">Crear Equipos</span>
                </a>
                <span class="tooltip">Crear Equipos</span>
            </li>
            
            <li>
                <a href="{{ route('dash_home') }}"> <!-- Checar movimiento raro del menu-->
                    <i class='bx bx-search'></i>
                    <span class="links_name">Torneos y Equipos</span>
                </a>
                <span class="tooltip">Torneos y Equipos</span>
            </li>

            <li>
                <a href="{{ route('notification.show') }}">
                    <i class='bx bx-notification'></i>
                    <span class="links_name">Notificaciones</span>
                </a>
                <span class="tooltip">Notificaciones</span>
            </li>

        <li>
            <a href="{{route('user.edit', ['userID' => auth()->user()->id])}}">
            <i class='bx bx-user'></i>
            <span class="links_name">Perfil</span>
            </a>
            <span class="tooltip">Perfil</span>
        </li>

            <li>
                <a href="{{ route('dash_nosotros') }}">
                    <i class='bx bx-info-circle'></i>
                    <span class="links_name">Nosotros</span>
                </a>
                <span class="tooltip">Nosotros</span>
            </li>

            <form action="{{ route('logout.index') }}" method="POST">
                @csrf
                <li class="profile">
                    <div class="profile-details">
                        <img src="../img/userprofile.webp" alt="profileImg">
                        <div class="name_job">
                            <div class="out">Salir</div>
                        </div>
                    </div>
                    <a href="#" onclick="this.closest('form').submit()"><i class="bx bx-log-out"
                            id="log_out"></i></a>
                </li>
            </form>
        </ul>
    </div>

    @yield('content')

</body>

<script src="{{ asset('js/dashboard.js') }}"></script>
<script type="text/javascript">
    function text(x) {
        switch (x) {
            case 0:
                document.getElementById("individualInput").style.visibility = 'visible';
                document.getElementById("equiposInput").style.visibility = 'hidden';
                break;
            case 1:
                document.getElementById("equiposInput").style.visibility = 'visible';
                document.getElementById("individualInput").style.visibility = 'hidden';
                break;
        }
        return;
    }
</script>

</html>
