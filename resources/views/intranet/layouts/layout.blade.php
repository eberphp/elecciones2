<!DOCTYPE html>
<html lang="en">
    <!-- Mirrored from demos.creative-tim.com/argon-dashboard-pro/pages/dashboards/default.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 14 Mar 2022 17:18:56 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admin/assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{ asset('admin/assets/img/favicon.png')}}">
    <title>Intranet - SIGE</title>
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('admin/assets/css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="{{ asset('admin/kit.fontawesome.com/42d5adcbca.js')}}" crossorigin="anonymous"></script>
    <link href="{{ asset('admin/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
    <!-- CSS Files -->
    
    <link id="pagestyle" href="{{ asset('admin/assets/css/argon-dashboard.min790f.css?v=2.0.1')}}" rel="stylesheet" />
    <!-- Anti-flicker snippet (recommended)  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/datatables.min.css')}}"/>
 
    <style>
        .async-hide {
        opacity: 0 !important
        }
      
    </style>

    @yield('style')
    
</head>
<body class="g-sidenav-show   bg-gray-100">
    
    <div class="min-height-300 bg-primary position-absolute w-100"></div>

    @include('intranet.layouts.menu')

    <main class="main-content position-relative border-radius-lg ">

        @include('intranet.layouts.header')

        @yield('content')

    </main>


    <!--   Core JS Files   -->
    <script src="{{ asset('admin/assets/js/core/popper.min.js')}}"></script>
    <script src="{{ asset('admin/assets/js/core/bootstrap.min.js')}}"></script>
    <script src="{{ asset('admin/assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
    <script src="{{ asset('admin/assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
    <script src="{{ asset('admin/assets/js/jquery.min.js')}}" ></script>
    <!-- Kanban scripts -->
    <script src="{{ asset('admin/assets/js/plugins/dragula/dragula.min.js')}}"></script>
    <script src="{{ asset('admin/assets/js/plugins/jkanban/jkanban.js')}}"></script>
    {{--<script src="{{ asset('admin/assets/js/plugins/chartjs.min.js')}}"></script>--}}
    <!-- Github buttons -->
    <script async defer src="{{ asset('admin/buttons.js')}}"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('admin/assets/js/argon-dashboard.min790f.js?v=2.0.1')}}"></script>{{-- 
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> --}}

    <script src="{{asset('admin/assets/js/datatables.min.js') }}"></script>
    @yield('script')
</body>
</html>