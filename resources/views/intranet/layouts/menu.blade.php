<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('usuarios.admin') }}" target="_blank">

            <img src="{{ asset('web/images/logo.png') }}" class="navbar-brand-img h-100" alt="main_logo"
                style="margin-bottom: 30px;">
            <br>
            <span class="ms-1 font-weight-bold" style="margin-top: 30px;">
                <?php $perfil = App\Models\Perfil::find(auth()->user()->idPerfil);
                echo 'hola, ' . $perfil->nombres;
                ?>
            </span>
        </a>
    </div>
    <hr class="horizontal dark mt-0" style="margin-top: 60px!important;">
    <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @if ($perfil->tipo  == 'admin')
            <li class="nav-item">
                <a href="{{ route('usuarios.admin')}}" class="nav-link {{ (request()->is('usuarios')) ? 'active' : '' }}">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-shop text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Usuarios</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('empresas.admin')}}" class="nav-link {{ (request()->is('empresas')) ? 'active' : '' }}">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-shop text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Empresas</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link {{ (request()->is('dashboard')) ? 'active' : '' }}">
                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                        <i class="ni ni-shop text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Roles Empresas</span>
                </a>
            </li>
            @else
                @if ($perfil->tipo  == 'empresa')
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#web" class="nav-link {{ (request()->is('datos-empresa')) || (request()->is('redes-sociales')) || (request()->is('sliders')) ? 'active' : '' }}" aria-controls="web" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-ungroup text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Web</span>
                    </a>
                    <div class="collapse " id="web">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link  {{ (request()->is('datos-empresa')) ? 'active' : '' }}" href="{{ route('datos.empresa')}}">
                                    <span class="sidenav-mini-icon"> DE </span>
                                    <span class="sidenav-normal"> Datos de la Empresa <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('redes-sociales')) ? 'active' : '' }}" href="{{ route('redes.empresa')}}">
                                    <span class="sidenav-mini-icon"> RS </span>
                                    <span class="sidenav-normal"> Redes Sociales <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('sliders')) ? 'active' : '' }}" href="{{ route('sliders.index')}}">
                                    <span class="sidenav-mini-icon"> S </span>
                                    <span class="sidenav-normal"> Sliders <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('publicaciones')) ? 'active' : '' }}" href="{{ route('publicaciones.index')}}">
                                    <span class="sidenav-mini-icon"> S </span>
                                    <span class="sidenav-normal"> Publicaciones <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('botones')) ? 'active' : '' }}" href="{{ route('botones.index')}}">
                                    <span class="sidenav-mini-icon"> S </span>
                                    <span class="sidenav-normal"> Botones <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('servicios')) ? 'active' : '' }}" href="{{ route('servicios.index')}}">
                                    <span class="sidenav-mini-icon"> S </span>
                                    <span class="sidenav-normal"> Servicios <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('testimonios')) ? 'active' : '' }}" href="{{ route('testimonios.index')}}">
                                    <span class="sidenav-mini-icon"> S </span>
                                    <span class="sidenav-normal"> Testimonios <b class="caret"></b></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{ route('roles.index')}}" class="nav-link " aria-controls="rol" role="button" >
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-ungroup text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Roles</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#configuracion"
                        class="nav-link {{ (request()->is('datos-empresa') || request()->is('redes-sociales') || request()->is('sliders')) ? 'active' : '' }}"
                        aria-controls="configuracion" role="button" aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-ungroup text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Configuracion</span>
                    </a>
                    <div class="collapse " id="configuracion">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link  {{ request()->is('configuracion/area') ? 'active' : '' }}"
                                    href="{{ route('configuracion.area') }}">
                                    <span class="sidenav-normal"> Area <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link  {{ request()->is('configuracion/cargo') ? 'active' : '' }}"
                                    href="{{ route('configuracion.cargo') }}">
                                    <span class="sidenav-normal"> Cargo <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link  {{ request()->is('configuracion/estadoActividad') ? 'active' : '' }}"
                                    href="{{ route('configuracion.estadoActividad') }}">
                                    <span class="sidenav-normal"> Estado Actividad <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link  {{ request()->is('configuracion/estadoEvaluacion') ? 'active' : '' }}"
                                    href="{{ route('configuracion.estadoEvaluacion') }}">
                                    <span class="sidenav-normal"> Estado Evaluacion <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link  {{ request()->is('configuracion/estadoGestion') ? 'active' : '' }}"
                                    href="{{ route('configuracion.estadoGestion') }}">
                                    <span class="sidenav-normal"> Estado Gestion <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link  {{ request()->is('configuracion/estadoProceso') ? 'active' : '' }}"
                                    href="{{ route('configuracion.estadoProceso') }}">
                                    <span class="sidenav-normal"> Estado Proceso <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link  {{ request()->is('configuracion/funcion') ? 'active' : '' }}"
                                    href="{{ route('configuracion.funcion') }}">
                                    <span class="sidenav-normal"> Funcion <b class="caret"></b></span>
                                </a>
                            </li>
                          
    
                            <li class="nav-item ">
                                <a class="nav-link  {{ request()->is('configuracion/prioridad') ? 'active' : '' }}"
                                    href="{{ route('configuracion.prioridad') }}">
                                    <span class="sidenav-normal"> Prioridad <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link  {{ request()->is('configuracion/tipoActividad') ? 'active' : '' }}"
                                    href="{{ route('configuracion.tipoActividad') }}">
                                    <span class="sidenav-normal"> Tipo Actividad <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link  {{ request()->is('configuracion/tipoUbigeo') ? 'active' : '' }}"
                                    href="{{ route('configuracion.tipoUbigeo') }}">
                                    <span class="sidenav-normal"> Tipo Ubigeo <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link  {{ request()->is('configuracion/tipoUsuario') ? 'active' : '' }}"
                                    href="{{ route('configuracion.tipoUsuario') }}">
                                    <span class="sidenav-normal"> Tipo Usuario <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link  {{ request()->is('configuracion/usuarioResponsable') ? 'active' : '' }}"
                                    href="{{ route('configuracion.usuarioResponsable') }}">
                                    <span class="sidenav-normal"> Usuario Responsable <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link  {{ request()->is('configuracion/vinculo') ? 'active' : '' }}"
                                    href="{{ route('configuracion.vinculo') }}">
                                    <span class="sidenav-normal"> Vinculo <b class="caret"></b></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#configuracion"
                        class="nav-link {{ request()->is('personal')?'active' : '' }}"
                        aria-controls="configuracion" role="button" aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-ungroup text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Personal</span>
                    </a>
                    <div class="collapse " id="configuracion">
                        <ul class="nav ms-4">
                         
                            <li class="nav-item ">
                                <a class="nav-link  {{ request()->is('configuracion/personal') ? 'active' : '' }}"
                                    href="{{ route('configuracion.personal') }}">
                                    <span class="sidenav-normal"> Personal <b class="caret"></b></span>
                                </a>
                            </li>
    
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#encuestas" class="nav-link {{ (request()->is('departamentos')) || (request()->is('provincias')) || (request()->is('distritos')) || (request()->is('zonas')) || (request()->is('partidos')) ? 'active' : '' }}" aria-controls="encuestas" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-ungroup text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Encuestas</span>
                    </a>
                    <div class="collapse " id="encuestas">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a data-bs-toggle="collapse" href="#ubigeo" class="nav-link {{ (request()->is('departamentos')) || (request()->is('provincias')) || (request()->is('distritos')) || (request()->is('zonas')) ? 'active' : '' }}" aria-controls="ubigeo" role="button" aria-expanded="false">
                                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                                        <i class="ni ni-ungroup text-warning text-sm opacity-10"></i>
                                    </div>
                                    <span class="nav-link-text ms-1">Ubigeo</span>
                                </a>
                                <div class="collapse " id="ubigeo">
                                    <ul class="nav ms-4">
                                        <li class="nav-item ">
                                            <a class="nav-link  {{ (request()->is('departamentos')) ? 'active' : '' }}" href="{{ route('departamentos.index')}}">
                                                <span class="sidenav-mini-icon"> D </span>
                                                <span class="sidenav-normal"> Departamentos <b class="caret"></b></span>
                                            </a>
                                        </li>
                                        <li class="nav-item ">
                                            <a class="nav-link {{ (request()->is('provincias')) ? 'active' : '' }}" href="{{ route('provincias.index')}}">
                                                <span class="sidenav-mini-icon"> P </span>
                                                <span class="sidenav-normal"> Provincias <b class="caret"></b></span>
                                            </a>
                                        </li>
                                        <li class="nav-item ">
                                            <a class="nav-link {{ (request()->is('distritos')) ? 'active' : '' }}" href="{{ route('distritos.index')}}">
                                                <span class="sidenav-mini-icon"> D </span>
                                                <span class="sidenav-normal"> Distritos <b class="caret"></b></span>
                                            </a>
                                        </li>
                                        <li class="nav-item ">
                                            <a class="nav-link {{ (request()->is('zonas')) ? 'active' : '' }}" href="{{ route('zonas.index')}}">
                                                <span class="sidenav-mini-icon"> Z </span>
                                                <span class="sidenav-normal"> Zonas <b class="caret"></b></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a data-bs-toggle="collapse" href="#partidos" class="nav-link {{ (request()->is('partidos')) ? 'active' : '' }}" aria-controls="partidos" role="button" aria-expanded="false">
                                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                                        <i class="ni ni-ungroup text-warning text-sm opacity-10"></i>
                                    </div>
                                    <span class="nav-link-text ms-1">Partidos y Candidatos</span>
                                </a>
                                <div class="collapse " id="partidos">
                                    <ul class="nav ms-4">
                                        <li class="nav-item ">
                                            <a class="nav-link  {{ (request()->is('partidos')) ? 'active' : '' }}" href="{{ route('partidos.index')}}">
                                                <span class="sidenav-mini-icon"> P </span>
                                                <span class="sidenav-normal"> Partidos <b class="caret"></b></span>
                                            </a>
                                        </li>
                                        <li class="nav-item ">
                                            <a class="nav-link {{ (request()->is('provincias')) ? 'active' : '' }}" href="{{ route('candidatos.index')}}">
                                                <span class="sidenav-mini-icon"> c </span>
                                                <span class="sidenav-normal"> Candidatos <b class="caret"></b></span>
                                            </a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('Encuesta') }}" class="nav-link {{ (request()->is('Encuesta')) ? 'active' : '' }}">
                                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                                        <i class="ni ni-ungroup text-warning text-sm opacity-10"></i>
                                    </div>
                                    <span class="nav-link-text ms-1">Crear Encuestas</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('Votos') }}" class="nav-link {{ (request()->is('Votos')) ? 'active' : '' }}">
                                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                                        <i class="ni ni-ungroup text-warning text-sm opacity-10"></i>
                                    </div>
                                    <span class="nav-link-text ms-1">Votos</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a data-bs-toggle="collapse" href="#resultados" class="nav-link " aria-controls="resultados" role="button" aria-expanded="false">
                                    <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                                        <i class="ni ni-ungroup text-warning text-sm opacity-10"></i>
                                    </div>
                                    <span class="nav-link-text ms-1">Resultados y Gráficos</span>
                                </a>
                                <div class="collapse " id="resultados">
                                    <ul class="nav ms-4">
                                        <li class="nav-item ">
                                            <a class="nav-link  " href="#">
                                                <span class="sidenav-mini-icon"> R </span>
                                                <span class="sidenav-normal"> Resultados <b class="caret"></b></span>
                                            </a>
                                        </li>
                                        <li class="nav-item ">
                                            <a class="nav-link " href="#">
                                                <span class="sidenav-mini-icon"> G </span>
                                                <span class="sidenav-normal"> Gráficos <b class="caret"></b></span>
                                            </a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#agenda" class="nav-link {{ (request()->is('datos-empresa')) || (request()->is('redes-sociales')) || (request()->is('sliders')) ? 'active' : '' }}" aria-controls="agenda" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-ungroup text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Agenda</span>
                    </a>
                    <div class="collapse " id="agenda">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link  {{ (request()->is('datos-empresa')) ? 'active' : '' }}" href="{{ route('datos.empresa')}}">
                                    <span class="sidenav-mini-icon"> DE </span>
                                    <span class="sidenav-normal"> Datos de la Empresa <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('redes-sociales')) ? 'active' : '' }}" href="{{ route('redes.empresa')}}">
                                    <span class="sidenav-mini-icon"> RS </span>
                                    <span class="sidenav-normal"> Redes Sociales <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('sliders')) ? 'active' : '' }}" href="{{ route('sliders.index')}}">
                                    <span class="sidenav-mini-icon"> S </span>
                                    <span class="sidenav-normal"> Sliders <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('publicaciones')) ? 'active' : '' }}" href="{{ route('publicaciones.index')}}">
                                    <span class="sidenav-mini-icon"> S </span>
                                    <span class="sidenav-normal"> Publicaciones <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('botones')) ? 'active' : '' }}" href="{{ route('botones.index')}}">
                                    <span class="sidenav-mini-icon"> S </span>
                                    <span class="sidenav-normal"> Botones <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('servicios')) ? 'active' : '' }}" href="{{ route('servicios.index')}}">
                                    <span class="sidenav-mini-icon"> S </span>
                                    <span class="sidenav-normal"> Servicios <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('testimonios')) ? 'active' : '' }}" href="{{ route('testimonios.index')}}">
                                    <span class="sidenav-mini-icon"> S </span>
                                    <span class="sidenav-normal"> Testimonios <b class="caret"></b></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#actividades" class="nav-link {{ (request()->is('datos-empresa')) || (request()->is('redes-sociales')) || (request()->is('sliders')) ? 'active' : '' }}" aria-controls="actividades" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-ungroup text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Actividades</span>
                    </a>
                    <div class="collapse " id="actividades">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link  {{ (request()->is('datos-empresa')) ? 'active' : '' }}" href="{{ route('datos.empresa')}}">
                                    <span class="sidenav-mini-icon"> DE </span>
                                    <span class="sidenav-normal"> Datos de la Empresa <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('redes-sociales')) ? 'active' : '' }}" href="{{ route('redes.empresa')}}">
                                    <span class="sidenav-mini-icon"> RS </span>
                                    <span class="sidenav-normal"> Redes Sociales <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('sliders')) ? 'active' : '' }}" href="{{ route('sliders.index')}}">
                                    <span class="sidenav-mini-icon"> S </span>
                                    <span class="sidenav-normal"> Sliders <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('publicaciones')) ? 'active' : '' }}" href="{{ route('publicaciones.index')}}">
                                    <span class="sidenav-mini-icon"> S </span>
                                    <span class="sidenav-normal"> Publicaciones <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('botones')) ? 'active' : '' }}" href="{{ route('botones.index')}}">
                                    <span class="sidenav-mini-icon"> S </span>
                                    <span class="sidenav-normal"> Botones <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('servicios')) ? 'active' : '' }}" href="{{ route('servicios.index')}}">
                                    <span class="sidenav-mini-icon"> S </span>
                                    <span class="sidenav-normal"> Servicios <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('testimonios')) ? 'active' : '' }}" href="{{ route('testimonios.index')}}">
                                    <span class="sidenav-mini-icon"> S </span>
                                    <span class="sidenav-normal"> Testimonios <b class="caret"></b></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#elecciones" class="nav-link {{ (request()->is('datos-empresa')) || (request()->is('redes-sociales')) || (request()->is('sliders')) ? 'active' : '' }}" aria-controls="elecciones" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-ungroup text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Elecciones</span>
                    </a>
                    <div class="collapse " id="elecciones">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link  {{ (request()->is('datos-empresa')) ? 'active' : '' }}" href="{{ route('datos.empresa')}}">
                                    <span class="sidenav-mini-icon"> DE </span>
                                    <span class="sidenav-normal"> Datos de la Empresa <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('redes-sociales')) ? 'active' : '' }}" href="{{ route('redes.empresa')}}">
                                    <span class="sidenav-mini-icon"> RS </span>
                                    <span class="sidenav-normal"> Redes Sociales <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('sliders')) ? 'active' : '' }}" href="{{ route('sliders.index')}}">
                                    <span class="sidenav-mini-icon"> S </span>
                                    <span class="sidenav-normal"> Sliders <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('publicaciones')) ? 'active' : '' }}" href="{{ route('publicaciones.index')}}">
                                    <span class="sidenav-mini-icon"> S </span>
                                    <span class="sidenav-normal"> Publicaciones <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('botones')) ? 'active' : '' }}" href="{{ route('botones.index')}}">
                                    <span class="sidenav-mini-icon"> S </span>
                                    <span class="sidenav-normal"> Botones <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('servicios')) ? 'active' : '' }}" href="{{ route('servicios.index')}}">
                                    <span class="sidenav-mini-icon"> S </span>
                                    <span class="sidenav-normal"> Servicios <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('testimonios')) ? 'active' : '' }}" href="{{ route('testimonios.index')}}">
                                    <span class="sidenav-mini-icon"> S </span>
                                    <span class="sidenav-normal"> Testimonios <b class="caret"></b></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#sugerencias" class="nav-link {{ (request()->is('datos-empresa')) || (request()->is('redes-sociales')) || (request()->is('sliders')) ? 'active' : '' }}" aria-controls="sugerencias" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="ni ni-ungroup text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Sugerencias</span>
                    </a>
                    <div class="collapse " id="sugerencias">
                        <ul class="nav ms-4">
                            <li class="nav-item ">
                                <a class="nav-link  {{ (request()->is('datos-empresa')) ? 'active' : '' }}" href="{{ route('datos.empresa')}}">
                                    <span class="sidenav-mini-icon"> DE </span>
                                    <span class="sidenav-normal"> Datos de la Empresa <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('redes-sociales')) ? 'active' : '' }}" href="{{ route('redes.empresa')}}">
                                    <span class="sidenav-mini-icon"> RS </span>
                                    <span class="sidenav-normal"> Redes Sociales <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('sliders')) ? 'active' : '' }}" href="{{ route('sliders.index')}}">
                                    <span class="sidenav-mini-icon"> S </span>
                                    <span class="sidenav-normal"> Sliders <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('publicaciones')) ? 'active' : '' }}" href="{{ route('publicaciones.index')}}">
                                    <span class="sidenav-mini-icon"> S </span>
                                    <span class="sidenav-normal"> Publicaciones <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('botones')) ? 'active' : '' }}" href="{{ route('botones.index')}}">
                                    <span class="sidenav-mini-icon"> S </span>
                                    <span class="sidenav-normal"> Botones <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('servicios')) ? 'active' : '' }}" href="{{ route('servicios.index')}}">
                                    <span class="sidenav-mini-icon"> S </span>
                                    <span class="sidenav-normal"> Servicios <b class="caret"></b></span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ (request()->is('testimonios')) ? 'active' : '' }}" href="{{ route('testimonios.index')}}">
                                    <span class="sidenav-mini-icon"> S </span>
                                    <span class="sidenav-normal"> Testimonios <b class="caret"></b></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @else

                @endif
            @endif
        </ul>
    </div>
</aside>
