@extends('intranet.layouts.layout')
@section('content')
<div class="container-fluid py-4">
    <div class="row mt-4">
      <div class="col-12">
        <div class="card">
          <!-- Card header -->
          <div class="card-header">
            <div class="row">
              <div class="col-6"><h5 class="mb-0">Personal</h5></div>
              <div class="col-6" style="text-align: right">
                <button type="button" class="btn btn-success" style="float: right" data-bs-toggle="modal" data-bs-target="#exampleModal">Nuevo Personal</button>
                {{--<a href="{{ route('sliders.craete')}}" class="btn btn-success">Nueva Zona</a>
                <a href="#" class="btn btn-info">Exportar</a>--}}
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
                  <th>Nombres</th>
                  <th>Rol</th>
                  <th>Distritos</th>
                  <th>Zona</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($zonas as $key => $zona)
                    <tr>
                      <td class="text-sm font-weight-normal">
                        {{--<a href="{{ route('sliders.edit', $slider->id)}}" class="btn btn-success"> Editar </a>--}}
                        <a href="{{ route('zonas.delete', $zona->id)}}" class="btn btn-danger"> Eliminar </a>
                      </td>
                      <td class="text-sm font-weight-normal">{{$zona->id}}</td>
                      <td class="text-sm font-weight-normal">
                        <?php $depa = App\Models\Departamento::find($zona->idDepartamento); ?>
                        {{$depa->departamento}}
                      </td>
                      <td class="text-sm font-weight-normal">
                        <?php $prov = App\Models\Provincia::find($zona->idProvincia); ?>
                        {{$prov->provincia}}
                      </td>
                      <td class="text-sm font-weight-normal">
                        <?php $dist = App\Models\Distrito::find($zona->idDistrito); ?>
                        {{$dist->distrito}}
                      </td>
                      <td class="text-sm font-weight-normal">
                        {{$zona->zona}}
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

  <!-- Modal Crear-->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Importar Distritos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('zonas.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                  <div class="row">
                    <div class="col-12">
                        <label for="">Departamento</label>
                        <select name="idDepartamento" id="idDepartamento" class="form-control" onchange="getProvincias(idDepartamento)">
                          <option value=""></option>
                            @foreach ($departamentos as $departamento)
                            <option value="{{$departamento->id}}">{{$departamento->departamento}}</option>
                            @endforeach
                        </select>
                    </div>
                  </div><br>
                  <div class="row">
                    <div class="col-12">
                        <label for="">Provincia</label>
                        <select name="idProvincia" id="idProvincia" class="form-control" onchange="getDistritos()">
                          <option value=""></option>
                        </select>
                    </div>
                  </div><br>
                  <div class="row">
                    <div class="col-12">
                        <label for="">Distrito</label>
                        <select name="idDistrito" id="idDistrito" class="form-control">
                            @foreach ($distritos as $distrito)
                            
                            @endforeach
                        </select>
                    </div>
                  </div><br>
              <div class="row">
                <div class="col-12">
                  <label for="">Zona</label>
                  <input type="text" name="zona" placeholder="Zona" class="form-control">
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
    <script>
      function getProvincias(){
        let idDepartamento = $('#idDepartamento').val();
        let ip = window.location.origin;
        console.log('la ip es : '+ip);
        console.log('la id del departamento es: '+idDepartamento);
        $.ajax({
          url: ip+"/getProvincias/"+idDepartamento,
          type: 'GET',
          dataType: 'json', // added data type
          success: function(res) {
            var fila = "";
            for (let i = 0; i < res.length; i++) {
              fila += '<option value="'+res[i].id+'">'+res[i].provincia+'</option>';
              
            }
            console.log(fila);
            $("#idProvincia option").remove();
            $("#idProvincia").append(fila);
            getDistritos(res[0].id);
              //console.log(res[0]);
              //alert(res);
          }
        })
      }

      function getDistritos(id){
        let idProvincia = $('#idProvincia').val();
        let ip = window.location.origin;
        console.log('la ip es : '+ip);
        console.log('la id del provincia es: '+idProvincia);
        $.ajax({
          url: ip+"/getDistritos/"+idProvincia,
          type: 'GET',
          dataType: 'json', // added data type
          success: function(res) {
            var fila = "";
            for (let i = 0; i < res.length; i++) {
              fila += '<option value="'+res[i].id+'">'+res[i].distrito+'</option>';
              
            }
            $("#idDistrito option").remove();
            $("#idDistrito").append(fila);
              //console.log(res[0]);
              //alert(res);
          }
        })
      }
    </script>
@endsection