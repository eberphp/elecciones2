<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/validacion.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/fontawesome-free/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/fontawesome-free/css/solid.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/notification/snackbar/snackbar.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('dist/css/dataTables.bootstrap4.min.css') }}">

</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<style>

</style>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light" style="background: white;">

            <!-- Left navbar links -->
            <ul class="navbar-nav">

                <li class="nav-item">

                    <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="width:"><i
                            class="fas fa-bars"></i></a>
                </li>
                <div class="container" style="">
                    <img src="" style="width:20%; " class="mx-auto d-block ">
                </div>
                {{-- <img src="{{ asset('dist/1.png') }}" class="rounded " alt=""
                height="50" width="200"  class="rounded" > --}}
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-sort-down"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header">
                            {{-- {{ auth()->user()->name }} --}}
                            <br>
                            <font style="font-weight: bold">{{ 'Tipo de Usuario' }}</font>
                        </span>

                        <div class="dropdown-divider"></div>
                      
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-dark elevation-4">
            <!-- Brand Logo -->

            <a href="#" class="brand-link">
                <div class="image">
                    <img src="{{ asset('dist/2.png') }}" style="width:20%" class="mx-auto d-block " alt=""
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                </div>
                <span class="brand-text font-weight-light">

                    <font style="font-weight: bold; color: #6d6d6d; font-size: 0.8em; margin-left:20%;">
                        {{ '' }}
                    </font>
                </span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">

                        <img src="{{ asset('dist/3.png') }}" class="img-circle elevation-2" alt="U Image">

                    </div>
                    <div class="info">
                        <a href="#" class="d-block">
                            {{-- {{ auth()->user()->name }} --}}
                        </a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar   flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


                        <li class="nav-item">
                            <a href="{{ asset('panel-administrador') }}"
                                class="nav-link
                                    {{ 'panel-administrador' == request()->segment(1) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Panel de Control
                                    {{-- <span class="right badge badge-danger">New</span> --}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link {{ 'configuracion' == request()->segment(1) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>
                                    Configuración
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ asset('configuracion/menu') }}"
                                        class="nav-link {{ 'menu' == request()->segment(2) ? 'bg-success' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <P>Menu</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ asset('configuracion/optionmenu') }}"
                                        class="nav-link {{ 'optionmenu' == request()->segment(2) ? 'bg-success' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <P>Option Menu</p>
                                    </a>
                                </li>
                            </ul>
                           
                        </li>


                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            {{-- @yield('encabezado') --}}
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    @yield('contenido')
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer text-dark">
            {{-- <strong>Copyright &copy; 2020-2021 <a href="https://adminlte.io">WIJGSOFT</a>.</strong> --}}
            {{-- <strong>Copyright &copy; CWILSOFT - 2022<a href="#"></a>.</strong>
            Todos los derechos Reservados
            <div class="float-right d-none d-sm-inline-block">
                <b>Cannabis vida Perú </b>Versión 1.0
            </div> --}}
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/bootstrap-select.min.js') }}"></script>

    <!-- AdminLTE -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('dist/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('dist/js/toastr.min.js') }}"></script>
    {{-- Data tables --}}
    <script src="{{ asset('dist/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dist/js/chart.min.js') }}"></script>
    @stack('scripts')
    <script src="{{ asset('plugins/notification/snackbar/snackbar.min.js') }}"></script>
    <script src="{{ asset('dist/js/eliminar.js') }}"></script>
</body>

</html>
