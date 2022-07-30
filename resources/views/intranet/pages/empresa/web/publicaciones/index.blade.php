@extends('intranet.layouts.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="row mt-4">
      <div class="col-12">
        <div class="card">
          <!-- Card header -->
          <div class="card-header">
            <div class="row">
              <div class="col-6"><h5 class="mb-0">Publicaciones</h5></div>
              <div class="col-6" style="text-align: right">
                <a href="{{ route('publicaciones.create')}}" class="btn btn-success">Nuevo</a>
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
                @foreach ($publicaciones as $key => $publicacion)
                    <tr>
                      <td class="text-sm font-weight-normal">
                        @if ($publicacion->idConfiguracion == 6)
                        <a href="{{ route('imagenes', $publicacion->id)}}" class="btn btn-info"> Galeria </a>
                        @else
                        <a href="#" class="btn btn-secondary" > Galeria </a>
                        @endif
                        <a href="{{ route('publicaciones.edit', $publicacion->id)}}" class="btn btn-success"> Editar </a>
                        <a href="{{ route('publicaciones.delete', $publicacion->id)}}" class="btn btn-danger"> Eliminar </a>
                        @if ($publicacion->idConfiguracion == 5)
                        <a href="{{ route('subpublicaciones.index', $publicacion->id)}}" class="btn btn-primary"> Subpublicacion </a>
                        @else
                        <a href="#" class="btn btn-secondary" > Subpublicacion </a>
                        @endif
                      </td>
                      <td class="text-sm font-weight-normal">{{$key+1}}</td>
                      <td class="text-sm font-weight-normal">{{$publicacion->nombre}}</td>
                      <td class="text-sm font-weight-normal">{{$publicacion->orden}}</td>
                      <td class="text-sm font-weight-normal">{{$publicacion->url}}</td>
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