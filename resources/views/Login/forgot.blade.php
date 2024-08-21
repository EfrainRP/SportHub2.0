<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportHub Recuperar contraseña</title>
    <link rel="preload" href="{{ asset('css/styles.css') }}" as="style">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body class="login-body">
    <!-- <header>
        <nav class="nav">
            <a href="#"> Inicio </a>
            <a href="#"> Registro </a>
            <a href="#"> Redes </a>
            <a href="#"> Contacto </a>
        </nav>
    </heade> -->
    <section class="login-section">
        <div class="form-box"></div>
            <div class="form-value">
                <form method="POST" action="#">
                    @csrf
                    <h1 class="login-h1"> Recuperar Cuenta </h1>
                    <div class="inputbox-forgot">
                        <ion-icon name="mail-outline">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail" width="44" height="44" viewBox="0 0 24" stroke-width="1.5" stroke="#F4EDE8" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                                <path d="M3 7l9 6l9 -6" />
                            </svg>
                        </ion-icon>
                        <input name="email" type="email" required autofocus value="{{old('email')}}">
                        <label for=""> Correo electrónico </label> <br> <br>
                        @error('email')  {{-- Checks if there has been an error in the "name" field --}}
                        <span>*{{$message}}</span> {{--print a message if there is an error--}}
                        <br>
                        @enderror
                    </div>
                    <button class="login-button" type="submit"> Envíar correo </button>
                    <div class="register">
                        <p><a href="/login">volver<br><br></a></p>
                    </div>
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                </form>
            </div>
    </section>
</body>
</html>