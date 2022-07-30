<footer class="sub-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="item md-mb50">
                    <div class="title">
                        <h5>Contáctenos</h5>
                    </div>
                    <ul>
                        <!--<li>
                            <span class="icon pe-7s-map-marker"></span>
                            <div class="cont">
                                <h6>Dirección</h6>
                                <p>504 White St . Dawsonville,
                                    GA 30534 , New York</p>
                            </div>
                        </li>-->
                        <li>
                            <span class="icon pe-7s-mail"></span>
                            <div class="cont">
                                <h6>Email</h6>
                                <p>{{$datos->correo}}</p>
                            </div>
                        </li>
                        <li>
                            <span class="icon pe-7s-call"></span>
                            <div class="cont">
                                <h6>Telefono</h6>
                                <p>{{$datos->telefono1}}</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="item md-mb50">
                    <div class="title">
                        <h5></h5>
                    </div>
                    <ul>
                        <li>
                            {!!$datos->piePagina!!}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="item">
                    <div class="logo">
                        <img src="img/logo-light.png" alt="">
                    </div>
                    <div class="social">
                        <a href="{{$redes->facebook}}"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{$redes->twitter}}"><i class="fab fa-twitter"></i></a>
                        <a href="{{$redes->instagram}}"><i class="fab fa-instagram"></i></a>
                        <a href="{{$redes->whatsapp}}"><i class="fab fa-whatsapp"></i></a>
                        <a href="{{$redes->linkedin}}"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>