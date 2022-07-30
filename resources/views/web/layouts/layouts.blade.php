<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from portotheme.com/html/porto_ecommerce/demo4.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 May 2022 23:03:39 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{$datos->nombre}}</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Place favicon.png in the root directory -->
    <link rel="shortcut icon" href="{{ asset('img/favicon/'.$datos->favicon)}}" type="image/x-icon" />
    <!-- Font Icons css -->
    {{--<link rel="stylesheet" href="{{ asset('web/css/font-icons.css')}}">
    <!-- plugins css -->
    <link rel="stylesheet" href="{{ asset('web/css/plugins.css')}}">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('web/css/style.css')}}">
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{ asset('web/css/responsive.css')}}">

    <style>
        .nice-select-2{
            -webkit-tap-highlight-color: transparent;
            background-color: #fff;
            border-radius: 5px;
            border: solid 1px #e8e8e8;
            box-sizing: border-box;
            clear: both;
            cursor: pointer;
            display: block;
            float: left;
            font-family: inherit;
            font-size: 14px;
            font-weight: 400;
            height: 42px;
            line-height: 40px;
            outline: 0;
            padding-left: 18px;
            padding-right: 30px;
            position: relative;
            text-align: left!important;
            -webkit-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            white-space: nowrap;
            width: 100%;
        }
    </style>--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">

    <!-- Plugins -->
    <link rel="stylesheet" href="{{ asset('web2/css/plugins.css')}}" />
    <link rel="stylesheet" href="{{ asset('web2/css/plugins/pe-icon-7-stroke.css')}}" />

    <!-- Core Style Css -->
    <link rel="stylesheet" href="{{ asset('web2/css/style.css')}}" />
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .whatsapp {
            position: fixed;
            width: 50px;
            height: 50px;
            bottom: 90px;
            right: 30px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 26px;
            z-index: 100;
        }

        .whatsapp-icon {
            margin-top:13px;
        }
    </style>

    @yield('style')

</head>

<body>
    
    <div class="loading">
        <span>L</span>
        <span>o</span>
        <span>a</span>
        <span>d</span>
        <span>i</span>
        <span>n</span>
        <span>g</span>
    </div>

    <div id="preloader">
    </div>

    <div class="progress-wrap cursor-pointer">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>

    <nav class="navbar navbar-expand-lg" style="padding-top: 1%;">
        <div class="container">

            <!-- Logo -->
            <a class="logo" href="{{ route('/')}}">
                <img src="{{ asset('img/bannerPrincipal/'.$datos->bannerPrincipal)}}" alt="logo">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-bar"><i class="fas fa-bars"></i></span>
            </button>

            <!-- navbar links -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('/')}}">Inicio</a>
                        <!--<div class="dropdown-menu">
                            <a class="dropdown-item" href="index.html">Main Home</a>
                            <a class="dropdown-item" href="index2.html">Creative Agency</a>
                            <a class="dropdown-item" href="index5.html">Digital Agency</a>
                            <a class="dropdown-item" href="index4.html">Business One Page</a>
                            <a class="dropdown-item" href="index3.html">Corporate Business</a>
                            <a class="dropdown-item" href="index6.html">Modern Agency</a>
                            <a class="dropdown-item" href="index7.html">Freelancer</a>
                            <a class="dropdown-item" href="index8.html">Architecture</a>
                        </div>-->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Productos</a>
                    </li>
                    @if ($titulo->tituloServicioVisible == 'SI')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">{{$titulo->titleServicio}}</a>
                        <div class="dropdown-menu">
                            @foreach ($servicios as $servicio)
                            <a class="dropdown-item" href="{{$servicio->url}}">{{$servicio->nombre}}</a>
                            @endforeach
                        </div>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login')}}" target="_blank">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Pages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contáctanos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    

    

    <a href="https://wa.me/51{{$datos->telefono1}}?text=Me%20gustaría%20saber%20el%20precio%20del%20coche" class="whatsapp" target="_blank"> 
        <i class="fa fa-whatsapp whatsapp-icon"></i>
    </a>

    
    
    <!-- All JS Plugins -->
    {{--<script src="{{ asset('web/js/plugins.js')}}"></script>
    <!-- Main JS -->
    <script src="{{ asset('web/js/main.js')}}"></script>--}}

    <!-- jQuery -->
    <script src="{{ asset('web2/js/jquery-3.0.0.min.js')}}"></script>
    <script src="{{ asset('web2/js/jquery-migrate-3.0.0.min.js')}}"></script>

    <!-- plugins -->
    <script src="{{ asset('web2/js/plugins.js')}}"></script>

    <!-- custom scripts -->
    <script src="{{ asset('web2/js/scripts.js')}}"></script>
    
</body>


<!-- Mirrored from portotheme.com/html/porto_ecommerce/demo4.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 May 2022 23:04:14 GMT -->
</html>