@extends('intranet.layouts.layout')
@section('content')
<div class="container-fluid py-4">
    <div class="row mt-4">
      <div class="col-12">
        <div class="card">
          <!-- Card header -->
          <div class="card-header">
            <div class="row">
              <div class="col-6"><h5 class="mb-0">Partidos</h5></div>
              <div class="col-6" style="text-align: right">
                {{--<button type="button" class="btn btn-success" style="float: right" data-bs-toggle="modal" data-bs-target="#exampleModal">Importar Departamentos</button>--}}
                {{--<a href="{{ route('sliders.craete')}}" class="btn btn-success">Importar Departamentos</a>
                <a href="#" class="btn btn-info">Exportar</a>--}}
                <button type="button" class="btn btn-success" style="float: right" data-bs-toggle="modal" data-bs-target="#exampleModal">Nuevo</button>
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
                  <th>Partido</th>
                  <th>Region</th>
                  <th>Logotipo</th>
                  <th>Observación</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($partidos as $key => $partido)
                    <tr>
                        <td class="text-sm font-weight-normal">
                            <a href="{{ route('partidos.delete', $partido->id)}}" class="btn btn-danger"> Eliminar </a>
                            <button type="button" class="btn btn-success" style="float: right" data-bs-toggle="modal" data-bs-target="#exampleModalEdit{{$key}}">Editar</button>
                            
                            
                        </td>
                        <td class="text-sm font-weight-normal">{{$partido->id}}</td>
                        <td class="text-sm font-weight-normal">{{$partido->partido}}</td>
                        <td class="text-sm font-weight-normal">
                            <?php $dep = App\Models\Departamento::find($partido->idDepartamento); ?>
                            {{$dep->departamento}}
                        </td>
                        <td class="text-sm font-weight-normal">
                            <img src="{{ asset('img/logotipos/'.$partido->logotipo)}}" alt="" style="width:auto; height: 65px;;">
                        </td>
                        <td class="text-sm font-weight-normal">{{$partido->observacion}}</td>
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
          <h5 class="modal-title" id="exampleModalLabel">Crear Nuevo Partido</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('partidos.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label for="">Partido</label>
                        <input type="text" name="partido" placeholder="Partido" class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <label for="">Región</label>
                        <select name="idDepartamento" id="idDepartamento" class="form-control">
                            @foreach ($departamentos as $departamento)
                            <option value="{{$departamento->id}}">{{$departamento->departamento}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <label for="">Logotipo</label>
                        <input type="file" name="logotipo"  class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <label for="">Observación</label>
                        <textarea type="text" name="observacion" placeholder="observacion" class="form-control"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn bg-gradient-primary">Crear</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  @foreach ($partidos as $key => $partido)
  <div class="modal fade" id="exampleModalEdit{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar Partido</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('partidos.update', $partido->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label for="">Partido</label>
                        <input type="text" name="partido" placeholder="Partido" class="form-control" value="{{$partido->partido}}">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <label for="">Región</label>
                        <select name="idDepartamento" id="idDepartamento" class="form-control">
                            <?php $depa = App\Models\Departamento::find($partido->idDepartamento); ?>
                            <option value="{{$depa->id}}">{{$depa->departamento}}</option>
                            @foreach ($departamentos as $departamento)
                            <option value="{{$departamento->id}}">{{$departamento->departamento}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <label for="">Logotipo</label>
                        <input type="file" name="logotipo"  class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <label for="">Observación</label>
                        <textarea type="text" name="observacion" placeholder="observacion" class="form-control">{{$partido->observacion}}</textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn bg-gradient-primary">Actualizar</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  @endforeach

  {{--<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Importar Departamentos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('departamentos.import')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <input type="file" name="departamentos" placeholder="Importar Departamentos" class="form-control">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn bg-gradient-primary">Crear</button>
            </div>
        </form>
      </div>
    </div>
  </div>--}}
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