@extends('web.layouts.layouts')
@section('style')
    
@endsection
@section('content')
<header class="slider slider-prlx fixed-slider text-center">
    <div class="swiper-container parallax-slider">
        <div class="swiper-wrapper altutra">
            @foreach ($sliders as $slider)
            <div class="swiper-slide">
                <div class="bg-img valign" data-background="{{ asset('img/sliders/'.$slider->imagen)}}" data-overlay-dark="6">
                    <div class="container">
                        <div class="row justify-content-center" style="float: left!important;">
                            <div class="col-lg-8 col-md-10">
                                <div class="caption center mt-30">
                                    {{--<h1>{{$slider->nombre}}</h1>--}}
                                    <p>{!!$slider->texto!!}</p>
                                    @if ($slider->url)
                                    <a href="{{$slider->url}}" class="butn bord curve mt-30">
                                        <span>Ver</span>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- slider setting -->
        <div class="setone setwo">
            <div class="swiper-button-next swiper-nav-ctrl next-ctrl cursor-pointer">
                <i class="fas fa-chevron-right"></i>
            </div>
            <div class="swiper-button-prev swiper-nav-ctrl prev-ctrl cursor-pointer">
                <i class="fas fa-chevron-left"></i>
            </div>
        </div>
        <div class="swiper-pagination top botm "></div>

        <div class="social-icon">
            <a href="{{$redes->facebook}}"><i class="fab fa-facebook-f" style="color: {{$redes->colorFondo}}"></i></a>
            <a href="{{$redes->twitter}}"><i class="fab fa-twitter" style="color: {{$redes->colorFondo}}"></i></a>
            <a href="{{$redes->instagram}}"><i class="fab fa-instagram" style="color: {{$redes->colorFondo}}"></i></a>
            <a href="{{$redes->whatsapp}}"><i class="fab fa-whatsapp" style="color: {{$redes->colorFondo}}"></i></a>
            <a href="{{$redes->linkedin}}"><i class="fab fa-linkedin" style="color: {{$redes->colorFondo}}"></i></a>
        </div>
    </div>
</header>
<div class="main-content">

    <section class="services bords section-padding pt-10" style="padding-bottom: 0%;">
        <div class="container" style="max-width: 100%;">
            <div class="row">
                @if ($titulo->tituloServicioVisible == 'SI')
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay=".5s">
                    <div class="form-group has-error has-danger controls">
                        <select name="" id="" class="form-control form-group">
                            <option value="">Productos</option>
                        </select>
                    </div>
                </div>
                @else
                <div class="col-lg-12 wow fadeInLeft" data-wow-delay=".5s">
                    <div class="form-group has-error has-danger controls">
                        <select name="" id="" class="form-control form-group">
                            <option value="">Productos</option>
                        </select>
                    </div>
                </div>
                @endif
    
                @if ($titulo->tituloServicioVisible == 'SI')
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay=".7s">
                    <div class="form-group has-error has-danger controls">
                        <select name="" id="" class="form-control form-group" onchange="redireciona()">
                            <option value="null">{{$titulo->titleServicio}}</option>
                            
                            @foreach ($servicios as $servicio)
                            <option value="{{$servicio->url}}"><a href="{{$servicio->url}}" target="_blank">{{$servicio->nombre}}</a></option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
                <!--<div class="col-lg-4 wow fadeInLeft" data-wow-delay=".9s">
                    <div class="item-box">
                        <span class="icon pe-7s-display1"></span>
                        <h6>Social media Marketing</h6>
                        <p>Tempore corrupti temporibus fuga earum asperiores fugit.</p>
                    </div>
                </div>-->
            </div>
        </div>
    </section>
    
    <section class="services bords section-padding pt-10" style="padding-bottom: 0%;">
        <div class="container" style="max-width: 100%;">
            <div class="row">
                @foreach ($botones as $boton)
                <div class="col-lg-4 wow fadeInLeft" data-wow-delay=".5s">
                    <div class="form-group has-error has-danger controls">
                        <a href="{{$boton->url}}" class="btn " target="_blank" style="width: 100%;background : {{$boton->colorFondo}}; color:white;height: auto;
                            padding: 0%;">{{$boton->nombre}}</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    
    <section class="services bords section-padding pt-10">
        <div class="container" style="max-width: 100%;">
            <div class="row">
                @foreach ($publicaciones as $publicacion)
                    @if ($publicacion->modeloBloque == 'Bloque 1')
                        @if ($publicacion->idConfiguracion == 1)
                        <div class="col-lg-12 wow fadeInLeft" style="margin-top: 1%;margin-bottom: 1%;">
                            {!!$publicacion->texto!!}
                        </div>
                        @endif
                        @if ($publicacion->idConfiguracion == 2)
                        <div class="col-lg-12 wow fadeInLeft" style="margin-top: 1%;margin-bottom: 1%;">
                            @if ($publicacion->selecciona == 'Imagen')
                                <img src="{{asset('img/publicaciones/'.$publicacion->imagen)}}" alt=""style="width: 100%;">
                            @else
                            {!!$publicacion->linkVideo!!}
                            @endif
                            <br>
                            <div>
                                {!!$publicacion->texto!!}
                            </div>
                        </div>
                        @endif
                        @if ($publicacion->idConfiguracion == 3)
                        <div class="col-lg-12 wow fadeInLeft" style="margin-top: 1%;margin-bottom: 1%;">
                            @if ($publicacion->selecciona == 'Imagen')
                                <a href="{{$publicacion->url}}" target="_blank"><img src="{{asset('img/publicaciones/'.$publicacion->imagen)}}" alt="" style="width: 100%;"></a>
                            @else
                            {!!$publicacion->linkVideo!!}
                            @endif
                            <br>
                            <div>
                                {!!$publicacion->texto!!}
                            </div>
                        </div>
                        @endif
                        @if ($publicacion->idConfiguracion == 5)
                        <div class="col-lg-12 col-sm-12" style="margin-top: 1%;margin-bottom: 1%;">
                            @if ($publicacion->selecciona == 'Imagen')
                                <a href="{{ route('subpublicaciones', [$publicacion->idUsuario, $publicacion->id])}}"  target="_blank"><img src="{{asset('img/publicaciones/'.$publicacion->imagen)}}" alt="" style="width: 100%;"></a>
                            @else
                            {!!$publicacion->linkVideo!!}
                            @endif
                            <br>
                            <div>
                                {!!$publicacion->texto!!}
                            </div>
                            {{--<a href="{{ route('subpublicaciones', [$publicacion->idUsuario, $publicacion->id])}}"  target="_blank"><span>{{$publicacion->nombre}}</span></a>--}}
                        </div>
                        @endif
                        @if ($publicacion->idConfiguracion == 6)
                        <div class="col-lg-12 col-sm-12 " style="margin-top: 1%;margin-bottom: 1%;padding-right: 0.5%;padding-left: 0.5%;">
                            <div class="slider slider-prlx text-center">
                                <?php $imagenes = App\Models\Imagen::where('idPublicacion', $publicacion->id)->get(); ?>
                            
                                <div class="swiper-container parallax-slider">
                                    <div class="swiper-wrapper altutra">
                                        @foreach ($imagenes as $imagen)
                                        <div class="swiper-slide" style="min-height: 43vh!important;">
                                            <div class="bg-img valign" style="background-size: 100%!important;background-position: center!important;" data-background="{{ asset('img/publicaciones/galeria/'.$imagen->imagen)}}" data-overlay-dark="6">
                                                
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
        
                                    <!-- slider setting -->
                                    <div class="setone setwo">
                                        <div class="swiper-button-next swiper-nav-ctrl next-ctrl cursor-pointer">
                                            <i class="fas fa-chevron-right"></i>
                                        </div>
                                        <div class="swiper-button-prev swiper-nav-ctrl prev-ctrl cursor-pointer">
                                            <i class="fas fa-chevron-left"></i>
                                        </div>
                                    </div>
                                    <div class="swiper-pagination top botm "></div>
        
                                </div>
                            </div>
                            
                            <br>
                            <a href="#"  target="_blank"><span>{!!$publicacion->texto!!}</span></a>
                        </div>
                        @endif
                    @endif
                    @if ($publicacion->modeloBloque == 'Bloque 2')
                        @if ($publicacion->idConfiguracion == 1)
                        <div class="col-lg-6 col-sm-6" style="margin-top: 1%;margin-bottom: 1%;padding-right: 0.5%;padding-left: 0.5%;">
                            {!!$publicacion->texto!!}
                        </div>
                        @endif
                        @if ($publicacion->idConfiguracion == 2)
                        <div class="col-lg-6 col-6" style="text-align: left;margin-top: 1%;margin-bottom: 1%;padding-right: 0.5%;padding-left: 0.5%;">
                            @if ($publicacion->selecciona == 'Imagen')
                                <img src="{{asset('img/publicaciones/'.$publicacion->imagen)}}" alt="" style="width: 100%;">
                            @else
                            {!!$publicacion->linkVideo!!}
                            @endif
                            <br>
                            <div>
                                {!!$publicacion->texto!!}
                            </div>
                        </div>
                        @endif
                        @if ($publicacion->idConfiguracion == 3)
                        <div class="col-lg-6 col-6" style="margin-top: 1%;margin-bottom: 1%;padding-right: 0.5%;padding-left: 0.5%;">
                            @if ($publicacion->selecciona == 'Imagen')
                                <a href="{{$publicacion->url}}"  target="_blank"><img src="{{asset('img/publicaciones/'.$publicacion->imagen)}}" alt="" style="width: 100%;"></a>
                            @else
                            {!!$publicacion->linkVideo!!}
                            @endif
                            <br>
                            <div>
                                {!!$publicacion->texto!!}
                            </div>
                        </div>
                        @endif
                        @if ($publicacion->idConfiguracion == 5)
                        <div class="col-lg-6 col-6" style="margin-top: 1%;margin-bottom: 1%;padding-right: 0.5%;padding-left: 0.5%;">
                            @if ($publicacion->selecciona == 'Imagen')
                                <a href="{{ route('subpublicaciones', [$publicacion->idUsuario, $publicacion->id])}}"  target="_blank"><img src="{{asset('img/publicaciones/'.$publicacion->imagen)}}" alt="" style="width: 100%;"></a>
                            @else
                            {!!$publicacion->linkVideo!!}
                            @endif
                            <br>
                            <div>
                                {!!$publicacion->texto!!}
                            </div>
                            {{--<a href="{{ route('subpublicaciones', [$publicacion->idUsuario, $publicacion->id])}}"  target="_blank"><span>{{$publicacion->nombre}}</span></a>--}}
                        </div>
                        @endif
                        @if ($publicacion->idConfiguracion == 6)
                        <div class="col-lg-6 col-sm-12" style="margin-top: 1%;margin-bottom: 1%;padding-right: 0.5%;padding-left: 0.5%;">
                            <div class="slider slider-prlx text-center">
                                <?php $imagenes = App\Models\Imagen::where('idPublicacion', $publicacion->id)->get(); ?>
                            
                                <div class="swiper-container parallax-slider">
                                    <div class="swiper-wrapper altutra">
                                        @foreach ($imagenes as $imagen)
                                        <div class="swiper-slide" style="min-height: 43vh!important;">
                                            <div class="bg-img valign" style="background-size: 100%!important;background-position: center!important;" data-background="{{ asset('img/publicaciones/galeria/'.$imagen->imagen)}}" data-overlay-dark="6">
                                                
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
        
                                    <!-- slider setting -->
                                    <div class="setone setwo">
                                        <div class="swiper-button-next swiper-nav-ctrl next-ctrl cursor-pointer">
                                            <i class="fas fa-chevron-right"></i>
                                        </div>
                                        <div class="swiper-button-prev swiper-nav-ctrl prev-ctrl cursor-pointer">
                                            <i class="fas fa-chevron-left"></i>
                                        </div>
                                    </div>
                                    <div class="swiper-pagination top botm "></div>
        
                                </div>
                            </div>
                            
                            <br>
                            <a href="#"  target="_blank"><span>{!!$publicacion->texto!!}</span></a>
                        </div>
                        @endif
                    @endif
                    @if ($publicacion->modeloBloque == 'Bloque 3')
                        @if ($publicacion->idConfiguracion == 1)
                        <div class="col-lg-4 col-sm-12" style="margin-top: 1%;margin-bottom: 1%;padding-right: 0.5%;padding-left: 0.5%;">
                            {!!$publicacion->texto!!}
                        </div>
                        @endif
                        @if ($publicacion->idConfiguracion == 2)
                        <div class="col-lg-4 col-sm-12" style="text-align: left;margin-top: 1%;margin-bottom: 1%;padding-right: 0.5%;padding-left: 0.5%;">
                            @if ($publicacion->selecciona == 'Imagen')
                                <img src="{{asset('img/publicaciones/'.$publicacion->imagen)}}" alt="" style="width: 100%;">
                            @else
                            {!!$publicacion->linkVideo!!}
                            @endif
                            <br>
                            <div>
                                {!!$publicacion->texto!!}
                            </div>
                        </div>
                        @endif
                        @if ($publicacion->idConfiguracion == 3)
                        <div class="col-lg-4 col-sm-12" style="margin-top: 1%;margin-bottom: 1%;padding-right: 0.5%;padding-left: 0.5%;">
                            @if ($publicacion->selecciona == 'Imagen')
                                <a href="{{$publicacion->url}}"  target="_blank"><img src="{{asset('img/publicaciones/'.$publicacion->imagen)}}" alt="" style="width: 100%;"></a>
                            @else
                            {!!$publicacion->linkVideo!!}
                            @endif
                            <br>
                            <div>
                                {!!$publicacion->texto!!}
                            </div>
                        </div>
                        @endif
                        @if ($publicacion->idConfiguracion == 5)
                        <div class="col-lg-4 col-sm-12" style="margin-top: 1%;margin-bottom: 1%;padding-right: 0.5%;padding-left: 0.5%;">
                            @if ($publicacion->selecciona == 'Imagen')
                                <a href="{{ route('subpublicaciones', [$publicacion->idUsuario, $publicacion->id])}}"  target="_blank"><img src="{{asset('img/publicaciones/'.$publicacion->imagen)}}" alt="" style="width: 100%"></a>
                            @else
                            {!!$publicacion->linkVideo!!}
                            @endif
                            <br>
                            <div>
                                {!!$publicacion->texto!!}
                            </div>
                            {{--<a href="{{ route('subpublicaciones', [$publicacion->idUsuario, $publicacion->id])}}"  target="_blank"><span>{{$publicacion->nombre}}</span></a>--}}
                        </div>
                        @endif
                        @if ($publicacion->idConfiguracion == 6)
                        <div class="col-lg-4 col-sm-12" style="margin-top: 1%;margin-bottom: 1%;padding-right: 0.5%;padding-left: 0.5%;">
                            <div class="slider slider-prlx text-center">
                                <?php $imagenes = App\Models\Imagen::where('idPublicacion', $publicacion->id)->get(); ?>
                            
                                <div class="swiper-container parallax-slider">
                                    <div class="swiper-wrapper altutra">
                                        @foreach ($imagenes as $imagen)
                                        <div class="swiper-slide" style="min-height: 43vh!important;">
                                            <div class="bg-img valign" style="background-size: 100%!important;background-position: center!important;" data-background="{{ asset('img/publicaciones/galeria/'.$imagen->imagen)}}" data-overlay-dark="6">
                                                
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
        
                                    <!-- slider setting -->
                                    <div class="setone setwo">
                                        <div class="swiper-button-next swiper-nav-ctrl next-ctrl cursor-pointer">
                                            <i class="fas fa-chevron-right"></i>
                                        </div>
                                        <div class="swiper-button-prev swiper-nav-ctrl prev-ctrl cursor-pointer">
                                            <i class="fas fa-chevron-left"></i>
                                        </div>
                                    </div>
                                    <div class="swiper-pagination top botm "></div>
        
                                </div>
                            </div>
                            
                            <br>
                            <a href="#"  target="_blank"><span>{!!$publicacion->texto!!}</span></a>
                        </div>
                        @endif
                    @endif
                    @if ($publicacion->modeloBloque == 'Bloque 4')
                        @if ($publicacion->idConfiguracion == 1)
                        <div class="col-lg-3 col-6" style="margin-top: 1%;margin-bottom: 1%;padding-right: 0.5%;padding-left: 0.5%;">
                            {!!$publicacion->texto!!}
                        </div>
                        @endif
                        @if ($publicacion->idConfiguracion == 2)
                        <div class="col-lg-3 col-6" style="text-align: left;margin-top: 1%;margin-bottom: 1%;padding-right: 0.5%;padding-left: 0.5%;">
                            @if ($publicacion->selecciona == 'Imagen')
                                <img src="{{asset('img/publicaciones/'.$publicacion->imagen)}}" alt="">
                            @else
                            {!!$publicacion->linkVideo!!}
                            @endif
                            <br>
                            <div>
                                {!!$publicacion->texto!!}
                            </div>
                        </div>
                        @endif
                        @if ($publicacion->idConfiguracion == 3)
                        <div class="col-lg-3 col-6" style="margin-top: 1%;margin-bottom: 1%;padding-right: 0.5%;padding-left: 0.5%;">
                            @if ($publicacion->selecciona == 'Imagen')
                                <a href="{{$publicacion->url}}"  target="_blank"><img src="{{asset('img/publicaciones/'.$publicacion->imagen)}}" alt="" style="width: 100%;"></a>
                            @else
                            {!!$publicacion->linkVideo!!}
                            @endif
                            <br>
                            <div>
                                {!!$publicacion->texto!!}
                            </div>
                        </div>
                        @endif
                        @if ($publicacion->idConfiguracion == 5)
                        <div class="col-lg-3 col-6" style="margin-top: 1%;margin-bottom: 1%;padding-right: 0.5%;padding-left: 0.5%;">
                            @if ($publicacion->selecciona == 'Imagen')
                                <a href="{{ route('subpublicaciones', [$publicacion->idUsuario, $publicacion->id])}}"  target="_blank"><img src="{{asset('img/publicaciones/'.$publicacion->imagen)}}" alt="" style="width: 100%;"></a>
                            @else
                            {!!$publicacion->linkVideo!!}
                            @endif
                            <br>
                            <div>
                                {!!$publicacion->texto!!}
                            </div>
                            {{--<a href="{{ route('subpublicaciones', [$publicacion->idUsuario, $publicacion->id])}}"  target="_blank"><span>{{$publicacion->nombre}}</span></a>--}}
                        </div>
                        @endif
                        @if ($publicacion->idConfiguracion == 6)
                        <div class="col-lg-3 col-6" style="margin-top: 1%;margin-bottom: 1%;padding-right: 0.5%;padding-left: 0.5%;">
                            <div class="slider slider-prlx text-center">
                                <?php $imagenes = App\Models\Imagen::where('idPublicacion', $publicacion->id)->get(); ?>
                            
                                <div class="swiper-container parallax-slider">
                                    <div class="swiper-wrapper altutra">
                                        @foreach ($imagenes as $imagen)
                                        <div class="swiper-slide" style="min-height: 43vh!important;">
                                            <div class="bg-img valign" style="background-size: 100%!important;background-position: center!important;" data-background="{{ asset('img/publicaciones/galeria/'.$imagen->imagen)}}" data-overlay-dark="6">
                                                
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
        
                                    <!-- slider setting -->
                                    <div class="setone setwo">
                                        <div class="swiper-button-next swiper-nav-ctrl next-ctrl cursor-pointer">
                                            <i class="fas fa-chevron-right"></i>
                                        </div>
                                        <div class="swiper-button-prev swiper-nav-ctrl prev-ctrl cursor-pointer">
                                            <i class="fas fa-chevron-left"></i>
                                        </div>
                                    </div>
                                    <div class="swiper-pagination top botm "></div>
        
                                </div>
                            </div>
                            
                            <br>
                            <a href="#"  target="_blank"><span>{!!$publicacion->texto!!}</span></a>
                        </div>
                        @endif
                    @endif
                    @if ($publicacion->modeloBloque == 'Bloque 5')
                        @if ($publicacion->idConfiguracion == 1)
                        <div class="col-lg-4 col-sm-6" style="margin-top: 1%;margin-bottom: 1%;padding-right: 0.5%;padding-left: 0.5%;">
                            {!!$publicacion->texto!!}
                        </div>
                        @endif
                        @if ($publicacion->idConfiguracion == 2)
                        <div class="col-lg-4 col-sm-6" style="text-align: left;margin-top: 1%;margin-bottom: 1%;padding-right: 0.5%;padding-left: 0.5%;">
                            @if ($publicacion->selecciona == 'Imagen')
                                <img src="{{asset('img/publicaciones/'.$publicacion->imagen)}}" alt="">
                            @else
                            {!!$publicacion->linkVideo!!}
                            @endif
                            <br>
                            <div>
                                {!!$publicacion->texto!!}
                            </div>
                        </div>
                        @endif
                        @if ($publicacion->idConfiguracion == 3)
                        <div class="col-lg-4 col-sm-6" style="margin-top: 1%;margin-bottom: 1%;padding-right: 0.5%;padding-left: 0.5%;">
                            @if ($publicacion->selecciona == 'Imagen')
                                <a href="{{$publicacion->url}}"  target="_blank"><img src="{{asset('img/publicaciones/'.$publicacion->imagen)}}" alt="" style="width: 100%;"></a>
                            @else
                            {!!$publicacion->linkVideo!!}
                            @endif
                            <br>
                            <div>
                                {!!$publicacion->texto!!}
                            </div>
                        </div>
                        @endif
                        @if ($publicacion->idConfiguracion == 5)
                        <div class="col-lg-4 col-sm-6" style="margin-top: 1%;margin-bottom: 1%;padding-right: 0.5%;padding-left: 0.5%;">
                            @if ($publicacion->selecciona == 'Imagen')
                                <a href="{{ route('subpublicaciones', [$publicacion->idUsuario, $publicacion->id])}}"  target="_blank"><img src="{{asset('img/publicaciones/'.$publicacion->imagen)}}" alt="" style="width: 100%;"></a>
                            @else
                            {!!$publicacion->linkVideo!!}
                            @endif
                            <br>
                            <div>
                                {!!$publicacion->texto!!}
                            </div>
                            {{--<a href="{{ route('subpublicaciones', [$publicacion->idUsuario, $publicacion->id])}}"  target="_blank"><span>{{$publicacion->nombre}}</span></a>--}}
                        </div>
                        @endif
                        @if ($publicacion->idConfiguracion == 6)
                        <div class="col-lg-4 col-sm-6" style="margin-top: 1%;margin-bottom: 1%;padding-right: 0.5%;padding-left: 0.5%;">
                            <div class="slider slider-prlx text-center">
                                <?php $imagenes = App\Models\Imagen::where('idPublicacion', $publicacion->id)->get(); ?>
                            
                                <div class="swiper-container parallax-slider">
                                    <div class="swiper-wrapper altutra">
                                        @foreach ($imagenes as $imagen)
                                        <div class="swiper-slide" style="min-height: 43vh!important;">
                                            <div class="bg-img valign" style="background-size: 100%!important;background-position: center!important;" data-background="{{ asset('img/publicaciones/galeria/'.$imagen->imagen)}}" data-overlay-dark="6">
                                                
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
        
                                    <!-- slider setting -->
                                    <div class="setone setwo">
                                        <div class="swiper-button-next swiper-nav-ctrl next-ctrl cursor-pointer">
                                            <i class="fas fa-chevron-right"></i>
                                        </div>
                                        <div class="swiper-button-prev swiper-nav-ctrl prev-ctrl cursor-pointer">
                                            <i class="fas fa-chevron-left"></i>
                                        </div>
                                    </div>
                                    <div class="swiper-pagination top botm "></div>
        
                                </div>
                            </div>
                            
                            <br>
                            <a href="#"  target="_blank"><span>{!!$publicacion->texto!!}</span></a>
                        </div>
                        @endif
                    @endif
                    @if ($publicacion->modeloBloque == 'Bloque 6')
                        @if ($publicacion->idConfiguracion == 1)
                        <div class="col-lg-8 col-sm-12" style="margin-top: 1%;margin-bottom: 1%;padding-right: 0.5%;padding-left: 0.5%;">
                            {!!$publicacion->texto!!}
                        </div>
                        @endif
                        @if ($publicacion->idConfiguracion == 2)
                        <div class="col-lg-8 col-sm-12" style="text-align: left;margin-top: 1%;margin-bottom: 1%;padding-right: 0.5%;padding-left: 0.5%;">
                            @if ($publicacion->selecciona == 'Imagen')
                                <img src="{{asset('img/publicaciones/'.$publicacion->imagen)}}" alt="">
                            @else
                            {!!$publicacion->linkVideo!!}
                            @endif
                            <br>
                            <div>
                                {!!$publicacion->texto!!}
                            </div>
                        </div>
                        @endif
                        @if ($publicacion->idConfiguracion == 3)
                        <div class="col-lg-8 col-sm-12" style="margin-top: 1%;margin-bottom: 1%;padding-right: 0.5%;padding-left: 0.5%;">
                            @if ($publicacion->selecciona == 'Imagen')
                                <a href="{{$publicacion->url}}"  target="_blank"><img src="{{asset('img/publicaciones/'.$publicacion->imagen)}}" alt="" style="width: 100%;"></a>
                            @else
                            {!!$publicacion->linkVideo!!}
                            @endif
                            <br>
                            <div>
                                {!!$publicacion->texto!!}
                            </div>
                        </div>
                        @endif
                        @if ($publicacion->idConfiguracion == 5)
                        <div class="col-lg-8 col-sm-12" style="margin-top: 1%;margin-bottom: 1%;padding-right: 0.5%;padding-left: 0.5%;">
                            @if ($publicacion->selecciona == 'Imagen')
                                <a href="{{ route('subpublicaciones', [$publicacion->idUsuario, $publicacion->id])}}"  target="_blank"><img src="{{asset('img/publicaciones/'.$publicacion->imagen)}}" alt="" style="width: 100%;"></a>
                            @else
                            {!!$publicacion->linkVideo!!}
                            @endif
                            <br>
                            <div>
                                {!!$publicacion->texto!!}
                            </div>
                            {{--<a href="{{ route('subpublicaciones', [$publicacion->idUsuario, $publicacion->id])}}"  target="_blank"><span>{{$publicacion->nombre}}</span></a>--}}
                        </div>
                        @endif
                        @if ($publicacion->idConfiguracion == 6)
                        <div class="col-lg-8 col-sm-12" style="margin-top: 1%;margin-bottom: 1%;padding-right: 0.5%;padding-left: 0.5%;">
                            <div class="slider slider-prlx text-center">
                                <?php $imagenes = App\Models\Imagen::where('idPublicacion', $publicacion->id)->get(); ?>
                            
                                <div class="swiper-container parallax-slider">
                                    <div class="swiper-wrapper altutra">
                                        @foreach ($imagenes as $imagen)
                                        <div class="swiper-slide" style="min-height: 43vh!important;">
                                            <div class="bg-img valign" style="background-size: 100%!important;background-position: center!important;" data-background="{{ asset('img/publicaciones/galeria/'.$imagen->imagen)}}" data-overlay-dark="6">
                                                
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
        
                                    <!-- slider setting -->
                                    <div class="setone setwo">
                                        <div class="swiper-button-next swiper-nav-ctrl next-ctrl cursor-pointer">
                                            <i class="fas fa-chevron-right"></i>
                                        </div>
                                        <div class="swiper-button-prev swiper-nav-ctrl prev-ctrl cursor-pointer">
                                            <i class="fas fa-chevron-left"></i>
                                        </div>
                                    </div>
                                    <div class="swiper-pagination top botm "></div>
        
                                </div>
                            </div>
                            
                            <br>
                            <a href="#"  target="_blank"><span>{!!$publicacion->texto!!}</span></a>
                        </div>
                        @endif
                    @endif
    
                @endforeach
            </div>
        </div>
    </section>
    
    
    @if ($titulo->tituloTestimonioVisible == 'SI')
    <section class="work-carousel metro position-re">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="sec-head  text-center">
                        <h3 class="wow color-font">{{$titulo->titleTestimonio}}</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 no-padding">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach ($testimonios as $testimonio)
                            <div class="swiper-slide">
                                <div class="content wow noraidus fadeInUp" data-wow-delay=".3s">
                                    <div class="item-img bg-img wow imago" style="text-align: center">
                                        <img src="{{ asset('img/testimonios/'.$testimonio->imagen)}}" alt="" style="height: 200px;width: auto;">
                                        
                                        <p>{!!$testimonio->texto!!}</p>
                                        <h6 class="color-font">{{$testimonio->nombre}}</h6>
                                    </div>
                                    <!--<div class="cont">
                                        <h6 class="color-font"><a href="#0">art & illustration</a></h6>
                                        <h4><a href="project-details2.html">Innovation and Crafts.</a></h4>
                                    </div>-->
                                </div>
                            </div>
                            @endforeach
                        </div>
    
                        <!-- slider setting -->
                        <div class="swiper-button-next swiper-nav-ctrl simp-next cursor-pointer">
                            <span class="simple-btn right">Next</span>
                        </div>
                        <div class="swiper-button-prev swiper-nav-ctrl simp-prev cursor-pointer">
                            <span class="simple-btn">Prev</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
        
    @include('web.layouts.footer')

</div>



    <script>
        function redireciona(){
            let aux = $('#servicio').val();
            console.log(aux == null);
            console.log(aux);
            if (aux != null) {
                window.open(aux, '_blank');
            }
        }
    </script>
@endsection