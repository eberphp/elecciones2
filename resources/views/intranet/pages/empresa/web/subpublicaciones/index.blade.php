@extends('intranet.layouts.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="row mt-4">
      <div class="col-12">
        <div class="card">
          <!-- Card header -->
          <div class="card-header">
            <div class="row">
              <div class="col-6"><h5 class="mb-0">Sub Publicaciones - {{$publicacion->nombre}}</h5></div>
              <div class="col-6" style="text-align: right">
                <a href="{{ route('subpublicaciones.create', $publicacion->id)}}" class="btn btn-success">Nuevo</a>
                <a href="#" class="btn btn-info">Exportar</a>
                <!--<button type="button" class="btn btn-success" style="float: right" data-bs-toggle="modal" data-bs-target="#exampleModal">Nuevo</button>-->
              </div>
            </div>
            
            
            <p class="text-sm mb-0">
              
            </p>
          </div>
          <div class="table-responsive">
            <table class="table table-flush" id="datatable-search">
              <thead class="thead-light">
                <tr>
                  <th>Acciones</th>
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Orden</th>
                  <th>URL</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($subpublicaciones as $key => $subpublicacion)
                    <tr>
                      <td class="text-sm font-weight-normal">
                        @if ($subpublicacion->idConfiguracion == 6)
                        <a href="{{ route('subimagenes', $subpublicacion->id)}}" class="btn btn-info"> Galeria </a>
                        @else
                        <a href="#" class="btn btn-secondary" > Galeria </a>
                        @endif
                        <a href="{{ route('subpublicaciones.edit', $subpublicacion->id)}}" class="btn btn-success"> Editar </a>
                        <a href="{{ route('subpublicaciones.delete', $subpublicacion->id)}}" class="btn btn-danger"> Eliminar </a>
                      </td>
                      <td class="text-sm font-weight-normal">{{$key+1}}</td>
                      <td class="text-sm font-weight-normal">{{$subpublicacion->nombre}}</td>
                      <td class="text-sm font-weight-normal">{{$subpublicacion->orden}}</td>
                      <td class="text-sm font-weight-normal">{{$subpublicacion->url}}</td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-4" style="display: none;">
      <div class="col-12">
        <div class="card">
          <!-- Card header -->
          
          <div class="table-responsive">
            <table class="table table-flush" id="datatable-basic">
              
            </table>
          </div>
        </div>
      </div>
    </div>
    <!--<footer class="footer pt-3  ">
      <div class="container-fluid">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6 mb-lg-0 mb-4">
            <div class="copyright text-center text-sm text-muted text-lg-start">
              © <script>
                document.write(new Date().getFullYear())
              </script>,
              made with <i class="fa fa-heart"></i> by
              <a href="https://www.creative-tim.com/" class="font-weight-bold" target="_blank">Creative Tim</a>
              for a better web.
            </div>
          </div>
          <div class="col-lg-6">
            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
              <li class="nav-item">
                <a href="https://www.creative-tim.com/" class="nav-link text-muted" target="_blank">Creative Tim</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>-->
  </div>
@endsection

@section('script')
    <script src="{{ asset('admin/assets/js/plugins/multistep-form.js')}}"></script>
    <script src="{{ asset('admin/assets/js/plugins/datatables.js')}}"></script>

    <script>
        const dataTableBasic = new simpleDatatables.DataTable("#datatable-basic", {
            searchable: false,
            fixedHeight: true
        });

        const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
            searchable: true,
            fixedHeight: true
        });
    </script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
@endsection