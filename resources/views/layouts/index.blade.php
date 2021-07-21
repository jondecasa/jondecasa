<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Jon de Casa</title>
        <!-- Favicon -->
        <link rel="icon" href="{{ asset('img/logo.svg') }}" type="image/svg" sizes="16x16">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
        <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
        <link rel="stylesheet" href="{{ asset('css/animaciones.css') }}">
        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js" integrity="sha512-BdHyGtczsUoFcEma+MfXc71KJLv/cd+sUsUaYYf2mXpfG/PtBjNXsPo78+rxWjscxUYN2Qr2+DbeGGiJx81ifg==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    </head>
    <body>
        <div class="scrollUp">
            <i class="fas fa-angle-up"></i>
        </div>
        
        
        @yield('cuerpo')
        
        <footer>
            <div class="row animacionVisible ani-slide-up">
                <div class="col-d-none col-md"></div>
                <div class="col-12 col-md-3 text-d-center text-md-left">
                    <ul>
                        <li><a href="{{url("/politica-privacidad")}}">Política de privacidad</a></li>
                        <li><a href="{{url("/politica-cookies")}}">Política de cookies</a></li>
                    </ul>
                    <ul class="mt-2">
                        <li class="">¿Otro color? <i class="fas fa-share fa-rotate-90"></i></li>
                    </ul>
                    <div class="social">
                        <ul>
                            <li><span class="colores red" data-color="red"></span></li>
                            <li><span class="colores purple" data-color="purple"></span></li>
                            <li><span class="colores orange" data-color="#f74602"></span></li>
                            <li><span class="colores green" data-color="green"></span></li>
                        </ul>
                    </div>
                </div>


                <div class="col-12 col-md-3 social">
                    <ul>
                        <li>
                            <a href="https://linkedin.com/in/jon-ander-de-casa-lombilla" target="_blank"><i class="fab fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-d-none col-md"></div>
            </div>
            <span class="copy">2021 <span class="far fa-copyright"></span> Copyright | Creado por <a href="#">Jon de Casa</a></span>
        </footer>
        
        @include('cookieConsent::index')
        <script src="{{ asset('js/general.js') }}"></script>
    </body>
</html>