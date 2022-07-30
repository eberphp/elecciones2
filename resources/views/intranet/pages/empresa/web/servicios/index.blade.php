@extends('intranet.layouts.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="row mt-4">
      <div class="col-12">
        <div class="card">
          <!-- Card header -->
          <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h5 class="mb-0">{{$titulos->titleServicio}}   </h5><a href="#modalCambiarTitulo" class="btn btn-success" data-bs-toggle="modal">Editar</a>
                    
                </div>
                <div class="col-6" style="text-align: right">
                    <a href="{{ route('servicios.create')}}" class="btn btn-success">Nuevo</a>
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
                  <!--<th>Orden</th>-->
                  <th>URL</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($servicios as $key => $servicio)
                    <tr>
                      <td class="text-sm font-weight-normal">
                        <a href="{{ route('servicios.edit', $servicio->id)}}" class="btn btn-success"> Editar </a>
                        <a href="{{ route('servicios.delete', $servicio->id)}}" class="btn btn-danger"> Eliminar </a>
                      </td>
                      <td class="text-sm font-weight-normal">{{$key +1}}</td>
                      <td class="text-sm font-weight-normal">{{$servicio->nombre}}</td>
                      {{--<td class="text-sm font-weight-normal">{{$servicio->orden}}</td>--}}
                      <td class="text-sm font-weight-normal">{{$servicio->url}}</td>
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

  <!-- Modal -->
<div class="modal fade" id="modalCambiarTitulo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cambiar Título de Testimonios</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('actualiza.titulo.servicio')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row mt-3">
                        <div class="col-12 col-sm-12">
                            <label for="">Titulo</label>
                            <input type="text" name="titleServicio" class="multisteps-form__input form-control" value="{{$titulos->titleServicios}}">
                        </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-12 col-sm-12">
                          <label for="">Se muestra en la web</label>
                          <select name="tituloServicioVisible" id="" class="multisteps-form__input form-control">
                            <option value="{{$titulos->tituloServicioVisible}}">{{$titulos->tituloServicioVisible}}</option>
                            <option value="SI">SI</option>
                            <option value="NO">NO</option>
                          </select>
                      </div>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">cerrar</button>
                    <button type="submit" class="btn bg-gradient-primary">Guardar</button>
                </div>
            </form>
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