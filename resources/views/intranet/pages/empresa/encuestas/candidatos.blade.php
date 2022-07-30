@extends('intranet.layouts.layout')
@section('content')
<div class="container-fluid py-4">
    <div class="row mt-4">
      <div class="col-12">
        <div class="card">
          <!-- Card header -->
          <div class="card-header">
            <div class="row">
              <div class="col-6"><h5 class="mb-0">Candidatos</h5></div>
              <div class="col-6" style="text-align: right">
                {{--<button type="button" class="btn btn-success" style="float: right" data-bs-toggle="modal" data-bs-target="#exampleModal">Importar Candidatos</button>--}}
                {{--<a href="{{ route('sliders.craete')}}" class="btn btn-success">Importar Candidatos</a>
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
                  <th>Vis.en Gráfico</th>
                  <th>ID</th>
                  <th>Nombre Corto</th>
                  <th>Tipo</th>
                  <th>Departamento</th>
                  <th>Provincia</th>
                  <th>Distrito</th>
                  <th>Partido</th>
                  <th>Nombres y Apellidos</th>
                  <th>Foto</th>
                  <th>Observador</th>
                  <!--<th>URL</th>-->
                </tr>
              </thead>
              <tbody>
                @foreach ($candidatos as $key => $candidato)
                    <tr>
                      <td class="text-sm font-weight-normal">
                        <a href="{{ route('elimina-candidatos', $candidato->id)}}" class="btn btn-danger"> Eliminar </a>
                        <button type="button" class="btn btn-success" style="float: right" data-bs-toggle="modal" data-bs-target="#exampleModalEdit{{$key}}">Editar</button>
                      </td>
                      <td class="text-sm font-weight-normal">
                        <a href="#" class="btn btn-info"> {{$candidato->visualiza}} </a>
                      </td>
                      <td class="text-sm font-weight-normal">{{$candidato->id}}</td>
                      <td class="text-sm font-weight-normal">{{$candidato->nombreCorto}}</td>
                      <td class="text-sm font-weight-normal">{{$candidato->tipo}}</td>
                      <td class="text-sm font-weight-normal">
                        <?php $dep = App\Models\Departamento::find($candidato->idDepartamento); ?>
                        {{$dep->departamento}}
                      </td>
                      <td class="text-sm font-weight-normal">
                        @if ($candidato->tipo == 'Provincial' || $candidato->tipo == 'Distrital')
                        <?php $prov = App\Models\Provincia::find($candidato->idProvincia); ?>
                        {{$prov->provincial}}
                        @else 
                          ---
                        @endif
                      </td>
                      <td class="text-sm font-weight-normal">
                        @if ($candidato->tipo == 'Distrital')
                        <?php $dist = App\Models\Distrito::find($candidato->idDistrito); ?>
                        {{$dist->distrito}}
                        @else 
                          ---
                        @endif
                      </td>
                      <td class="text-sm font-weight-normal">
                        <?php $part = App\Models\Partido::find($candidato->idPartido); ?>
                        {{$part->partido}}
                      </td>
                      <td class="text-sm font-weight-normal">{{$candidato->nombresApellidos}}</td>
                      <td class="text-sm font-weight-normal">
                        <img src="{{ asset ('img/fotos/'.$candidato->foto)}}" alt="">
                      </td>
                      <td class="text-sm font-weight-normal">{{$candidato->observaciones}}</td>
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
          <h5 class="modal-title" id="exampleModalLabel">Crear Candidato</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('candidatos.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                <label for="">Nombre Corto</label>
                  <input type="text" name="nombreCorto" placeholder="Nombre Corto" class="form-control">
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                    <label for="">Tipo</label>
                    <select name="tipo" id="tipo" class="form-control" onchange="selectTipo()">
                      <option value="Regional">Regional</option>
                      <option value="Provincial">Provincial</option>
                      <option value="Distrital">Distrital</option>
                        
                    </select>
                </div>
              </div>
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
              </div>
              <div class="row" id="div-provincia" style="display: none;">
                <div class="col-12">
                    <label for="">Provincia</label>
                    <select name="idProvincia" id="idProvincia" class="form-control" onchange="getDistritos()">
                      <option value=""></option>
                    </select>
                </div>
              </div>
              <div class="row" id="div-distrito" style="display: none;">
                <div class="col-12">
                    <label for="">Distrito</label>
                    <select name="idDistrito" id="idDistrito" class="form-control">
                        @foreach ($distritos as $distrito)
                        
                        @endforeach
                    </select>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                    <label for="">Partido</label>
                    <select name="idPartido" id="idPartido" class="form-control" >
                      
                        @foreach ($partidos as $partido)
                        <option value="{{$partido->id}}">{{$partido->partido}}</option>
                        @endforeach
                    </select>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                <label for="">Nombres y Apellidos</label>
                  <input type="text" name="nombresApellidos" placeholder="Nombres y Apellidos" class="form-control">
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                <label for="">Foto</label>
                  <input type="file" name="foto" placeholder="Foto" class="form-control">
                </div>
              </div>
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

  @foreach ($candidatos as $key => $candidato)
      <!-- Modal Crear-->
  <div class="modal fade" id="exampleModalEdit{{$key}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar Candidato</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('candidatos.update', $candidato->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                <label for="">Nombre Corto</label>
                  <input type="text" name="nombreCorto" placeholder="Nombre Corto" class="form-control" value="{{$candidato->nombreCorto}}">
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                    <label for="">Tipo</label>
                    <select name="tipo" id="tipo" class="form-control" onchange="selectTipo()">
                      <option value="{{$candidato->tipo}}">{{$candidato->tipo}}</option>
                      <option value="Regional">Regional</option>
                      <option value="Provincial">Provincial</option>
                      <option value="Distrital">Distrital</option>
                        
                    </select>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                    <label for="">Departamento</label>
                    <select name="idDepartamento" id="idDepartamento" class="form-control" onchange="getProvincias(idDepartamento)">
                      <?php $departamentoAux = App\Models\Departamento::find($candidato->idDepartamento); ?>
                        <option value="{{$candidato->idDepartamento}}">{{$departamentoAux->departamento}}</option>
                        @foreach ($departamentos as $departamento)
                        <option value="{{$departamento->id}}">{{$departamento->departamento}}</option>
                        @endforeach
                    </select>
                </div>
              </div>
              <div class="row" id="div-provincia" style="display: none;">
                <div class="col-12">
                    <label for="">Provincia</label>
                    <select name="idProvincia" id="idProvincia" class="form-control" onchange="getDistritos()">
                      <option value=""></option>
                    </select>
                </div>
              </div>
              <div class="row" id="div-distrito" style="display: none;">
                <div class="col-12">
                    <label for="">Distrito</label>
                    <select name="idDistrito" id="idDistrito" class="form-control">
                        @foreach ($distritos as $distrito)
                        
                        @endforeach
                    </select>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                    <label for="">Partido</label>
                    <select name="idPartido" id="idPartido" class="form-control" >
                      
                        @foreach ($partidos as $partido)
                        <option value="{{$partido->id}}">{{$partido->partido}}</option>
                        @endforeach
                    </select>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                <label for="">Nombres y Apellidos</label>
                  <input type="text" name="nombresApellidos" placeholder="Nombres y Apellidos" class="form-control" value="{{$candidato->nombresApellidos}}">
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                <label for="">Foto</label>
                  <input type="file" name="foto" placeholder="Foto" class="form-control">
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                    <label for="">Observación</label>
                    <textarea type="text" name="observacion" placeholder="observacion" class="form-control">{{$candidato->observaciones}}</textarea>
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

    function selectTipo(){
      let tipo = $('#tipo').val();
      console.log(tipo);
      if (tipo === 'Regional') {
        $('#div-provincia').css("display", 'none');
        $('#div-distrito').css("display", 'none');
      } else {
        if (tipo === 'Provincial') {
          $('#div-provincia').css("display", 'block');
        $('#div-distrito').css("display", 'none');
        } else {
          $('#div-provincia').css("display", 'block');
        $('#div-distrito').css("display", 'block');
        }
      } 
    }
  </script>
@endsection
