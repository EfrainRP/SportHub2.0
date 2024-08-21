<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SportHub Login</title>
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
                    <h1 class="login-h1"> Inicio </h1>
                    <div class="inputbox">
                        <ion-icon name="mail-outline">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail" width="44" height="44" viewBox="0 0 24" stroke-width="1.5" stroke="#F4EDE8" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                                <path d="M3 7l9 6l9 -6" />
                            </svg>
                        </ion-icon>
                        <input name="email" type="email" required autofocus value="{{old('email')}}">
                        <label for=""> Correo </label>
                        @error('email')  {{-- Checks if there has been an error in the "name" field --}}
                        <span>*{{$message}}</span> {{--print a message if there is an error--}}
                        <br>
                        @enderror
                    </div>
                    

                    <div class="inputbox">
                        <input id="password" name="password" type="password" required>
                            <label for=""> Contraseña </label>
                        <button type="button" id="togglePassword">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-hide icon-tabler icon-tabler-eye-closed" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="#F4EDE8" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M21 9c-2.4 2.667 -5.4 4 -9 4c-3.6 0 -6.6 -1.333 -9 -4" />
                                <path d="M3 15l2.5 -3.8" />
                                <path d="M21 14.976l-2.492 -3.776" />
                                <path d="M9 17l.5 -4" />
                                <path d="M15 17l-.5 -4" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-show icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="#F4EDE8" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                            </svg>
                        </button>
                    </div>
                    <div class="forget">
                        <label for=""><input type="checkbox" name ="remember">Recordar</label>
                        <a href="{{route('login.recover')}}">Olvidé la Contraseña</a>
                    </div>
                    <button class="login-button" type="submit"> Iniciar Sesión </button>
                    <div class="register">
                        <p>No tengo una cuenta - <a href="/register">Registrarse<br><br></a>
                        </p>
                    </div> 
                    <h4 class="credential-h4">
                        
                        @error('password')  {{-- Checks if there has been an error in the "name" field --}}
                        <span>*{{$message}}</span> {{--print a message if there is an error--}}
                        <br>
                        @enderror

                        @if ($band)
                        > Sistema: Credenciales Incorrectas  
                        @endif
                        @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif
                    <h4> 
                    @if (Session::has('registro_exitoso'))
                           <div class="alert alert-success">
                                {{ Session::get('registro_exitoso') }}
                           </div>
                    @endif
                </form>
            </div>
    </section>
    <script src="{{ asset('js/login.js') }}" ></script>
</body>
</html>