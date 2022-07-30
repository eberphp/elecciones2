@extends('intranet.layouts.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="row mt-4">
      <div class="col-12">
        <div class="card">
          <!-- Card header -->
          <div class="card-header">
            <div class="row">
              <div class="col-6"><h5 class="mb-0">Galeria</h5></div>
              <div class="col-6" style="text-align: right">
                <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Nuevo</a>
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
                  <th>Imagen</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($imagenes as $key => $imagen)
                    <tr>
                      <td class="text-sm font-weight-normal">
                        <a href="{{ route('subimagenes.delete', $imagen->id)}}" class="btn btn-danger"> Eliminar </a>
                        
                      </td>
                      <td class="text-sm font-weight-normal">{{$key+1}}</td>
                      <td class="text-sm font-weight-normal">
                          <img src="{{ asset('img/subpublicaciones/galeria/'.$imagen->imagen)}}" alt="" style="height: 100px;">
                        </td>
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

  <!-- Modal Crear-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Imagen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('subimagenes.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <label for="">Imagen</label>
                                <input type="file" name="imagen" class="form-control">
                                <input type="text" name="idSubpublicacion" class="form-control" value="{{$subpublicacion->id}}" hidden>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cerrar</button>
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