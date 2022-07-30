@extends('intranet.layouts.layout')
@section('content')
<div class="container-fluid py-4">
    <div class="row mt-4">
      <div class="col-12">
        <div class="card">
          <!-- Card header -->
          <div class="card-header">
            <div class="row">
              <div class="col-6"><h5 class="mb-0">Roles</h5></div>
              <div class="col-6" style="text-align: right">
                <button type="button" class="btn btn-success" style="float: right" data-bs-toggle="modal" data-bs-target="#exampleModal">Nuevo Rol</button>
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
                  <th>Rol</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($roles as $key => $rol)
                    <tr>
                      <td class="text-sm font-weight-normal">
                        <a href="{{ route('roles.delete', $rol->id)}}" class="btn btn-danger"> Eliminar </a>
                        <button type="button" class="btn btn-primary" style="float: right" data-bs-toggle="modal" data-bs-target="#exampleModalEdit{{$rol->id}}">Editar</button>
                
                      </td>
                      <td class="text-sm font-weight-normal">{{$rol->id}}</td>
                      <td class="text-sm font-weight-normal">{{$rol->rol}}</td>
                      
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
          <h5 class="modal-title" id="exampleModalLabel">Nuevo Rol</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('roles.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                  
                  
                <div class="row">
                    <div class="col-12">
                        <label for="">Rol</label>
                        <input type="text" name="rol" placeholder="Zona" class="form-control">
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

  @foreach ($roles as $rol)
      <!-- Modal Crear-->
  <div class="modal fade" id="exampleModalEdit{{$rol->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar Rol</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('roles.update', $rol->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-body">
                  
                  
                <div class="row">
                    <div class="col-12">
                        <label for="">Rol</label>
                        <input type="text" name="rol" placeholder="Zona" class="form-control" value="{{$rol->rol}}">
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
  @endforeach
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