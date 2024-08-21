<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="preload" href="{{ asset('css/welcome.css') }}" as="style">
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">

</head>
<body>
    <section class="showcase">
        <header>
            <h2 class="logo">Sporthub</h2>
            <div class="container">
                <nav>
                    <a href="{{route('login.user')}}">Iniciar sesion</a>
                    <a href="/register">Registrarse</a>
                </nav>
            </div>
        </header>
        <video src="{{ asset('video/welcome.webm') }}" muted loop autoplay></video>
        <div class="overlay"></div>
        <div class="text">
            <h2>TORNEOS</h2>
            <h3>DE BALONCESTO</h3>
            <p>SportHub es una plataforma web que permite la creación de torneos locales en donde los usuarios pueden disfrutar de participar en eventos competitivos y así promover el deporte, la diversión y el entusiasmo.</p>
                <p>Contacto: 33-22-11-44-55</p>
                <p>Correo de contacto: <i>sporthub@gmail.com</i></p>
                <p>© Coopyright todos los derechos reservados.</p>
            <a href="{{route('login.user')}}">Iniciar sesion</a>
        </div>
        <ul class="social">
            <li><a href="#"><img src="https://i.ibb.co/x7P24fL/facebook.png"></a></li>
            <li><a href="#"><img src="https://i.ibb.co/Wnxq2Nq/twitter.png"></a></li>
            <li><a href="#"><img src="https://i.ibb.co/ySwtH4B/instagram.png"></a></li>
        </ul>
    </section>
    <script src="{{ asset('js/welcome.js') }}"></script>
</body>
</html>
