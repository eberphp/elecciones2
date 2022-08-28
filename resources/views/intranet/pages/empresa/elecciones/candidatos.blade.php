@extends('intranet.layouts.layout')
@section('style')
    <style>
        .bg-gradient-info {
            border-radius: inherit;
        }

        .bg-gradient-danger {
            border-radius: inherit;
        }

        .bg-gradient-warning {
            border-radius: inherit;
        }

        .bg-gradient-success {
            border-radius: inherit;
        }

        .bg-gradient-primary {
            border-radius: inherit;
        }

        .bg-gradient-secondary {
            border-radius: inherit;
        }

        ul.pagination li {
            margin-left: 4px !important;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid py-4">
        <div class="row">

            <div class="col-12">
                <div class="card shadow-lg mb-3">
                    <div class="card-body bg-gradient-info">
                        <div class="row">
                            <div class="col-12 col-md-10 mb-3 mb-md-0">
                                <h5 class="mb-0 text-white text-uppercase fw-bold text-center text-md-start">Candidatos</h5>
                            </div>
                            <div class="col-12 col-md-2  text-md-end">
                                <button type="button" class="btn btn-info w-100" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">Nuevo</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <form action="">
                            <div class="row p-3">
                                <div class="col-md-10">

                                    <input type="text" placeholder="Buscar por Nombre | Apellido | Nombre Corto" name="buscador" class="form-control">
                                </div>
                                <div class="col-md-2">

                                    <button type="submit" class="btn btn-primary">Buscar</button>
                                    <a type="submit" href="{{ route('candidatos.index') }}" class="btn btn-warning">Limpiar</a>

                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-flush" id="tbData">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Acciones</th>
                                        <th>Vis.en Gráfico</th>
                                        <th>Nombre Corto</th>
                                        <th>Tipo</th>
                                        <th>Departamento</th>
                                        <th>Provincia</th>
                                        <th>Distrito</th>
                                        <th>Partido</th>
                                        <th>Nombres y Apellidos</th>
                                        <th>Foto</th>
                                        <th>Observador</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($candidatos as $key => $candidato)
                                        <tr style="font-size: 14px;color:black;">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="icon icon-shape icon-sm me-1 bg-gradient-info rounded-circle shadow text-center btnEditar"
                                                        style="cursor:pointer;" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModalEdit{{ $key }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" onclick="selectTipoUpdate({{ $key }})">
                                                        <i class="fas fa-pencil-alt text-white opacity-10 "
                                                            style="cursor:pointer;"></i>
                                                    </div>

                                                    <div class="icon icon-shape icon-sm me-1 bg-gradient-danger rounded-circle shadow text-center btnEliminar"
                                                        style="cursor:pointer;" data-item="{{ $candidato->id }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar">
                                                        <i class="far fa-trash-alt text-white opacity-10 "
                                                            style="cursor:pointer;"></i>
                                                    </div>

                                            </td>
                                            <td class="text-sm font-weight-normal">
                                                <span class="btn btn-info btn-sm"> {{ $candidato->visualiza }} </span>
                                            </td>
                                            <td class="text-sm font-weight-normal">
                                                @if ($candidato->nombreCorto)
                                                    {{ $candidato->nombreCorto }}
                                                @else
                                                    {{ $candidato->id }}
                                                @endif
                                            </td>
                                            <td class="text-sm font-weight-normal">{{ $candidato->tipo }}</td>
                                            <td class="text-sm font-weight-normal">
                                                @if ($candidato->departamento)
                                                    {{ $candidato->departamento->departamento }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-sm font-weight-normal">
                                                @if ($candidato->provincia)
                                                    {{ $candidato->provincia->provincia }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-sm font-weight-normal">
                                                @if ($candidato->distrito)
                                                    {{ $candidato->distrito->distrito }}
                                                @else
                                                    -
                                                @endif
                                            </td>

                                            <td class="text-sm font-weight-normal">
                                                @if ($candidato->partido)
                                                    {{ $candidato->partido->partido }}
                                                @else
                                                    -
                                                @endif
                                            </td>

                                            <td class="text-sm font-weight-normal">
                                                @if ($candidato->nombresApellidos)
                                                    {{ $candidato->nombresApellidos }}
                                                @else
                                                    {{ $candidato->id }}
                                                @endif
                                            </td>

                                            <td class="text-sm font-weight-normal">
                                                <img style="height: 50px"
                                                    src="{{ asset('img/fotos/' . $candidato->foto) }}" alt="">
                                            </td>
                                            <td class="text-sm font-weight-normal">{{ $candidato->observaciones }}</td>


                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex w-100 justify-content-center">
                            {{ $candidatos->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- Modal Crear-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Candidato</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('candidatos.store') }}" method="post" enctype="multipart/form-data">
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
                                <select name="idDepartamento" id="idDepartamento" class="form-control"
                                    onchange="getProvincias(idDepartamento)">
                                    <option value=""></option>
                                    @foreach ($departamentos as $departamento)
                                        <option value="{{ $departamento->id }}">{{ $departamento->departamento }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row" id="div-provincia" style="display: none;">
                            <div class="col-12">
                                <label for="">Provincia</label>
                                <select name="idProvincia" id="idProvincia" class="form-control"
                                    onchange="getDistritos()">
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
                                <select name="idPartido" id="idPartido" class="form-control">

                                    @foreach ($partidos as $partido)
                                        <option value="{{ $partido->id }}">{{ $partido->partido }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Nombres y Apellidos</label>
                                <input type="text" name="nombresApellidos" placeholder="Nombres y Apellidos"
                                    class="form-control">
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
        <div class="modal fade" id="exampleModalEdit{{ $key }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Candidato</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('candidatos.update', $candidato->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Nombre Corto</label>
                                    @if ($candidato->nombreCorto)
                                        <input type="text" name="nombreCorto" placeholder="Nombre Corto" class="form-control" value="{{ $candidato->nombreCorto }}">
                                    @else
                                        <input type="text" name="nombreCorto" placeholder="Nombre Corto" class="form-control" value="{{ $candidato->id }}">
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Tipo</label>
                                    <select name="tipo" id="tipo" class="form-control edit-tipo" onchange="selectTipo()">
                                        <option value="{{ $candidato->tipo }}">{{ $candidato->tipo }}</option>
                                        <option value="Regional">Regional</option>
                                        <option value="Provincial">Provincial</option>
                                        <option value="Distrital">Distrital</option>

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Departamento</label>
                                    <select name="idDepartamento" id="idDepartamento" class="form-control"
                                        onchange="getProvincias(idDepartamento)">
                                        <?php $departamentoAux = App\Models\Departamento::find($candidato->idDepartamento); ?>
                                        <option value="{{ $candidato->idDepartamento }}">
                                            {{ $departamentoAux->departamento }}</option>
                                        @foreach ($departamentos as $departamento)
                                            <option value="{{ $departamento->id }}">{{ $departamento->departamento }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row" id="div-provincia" data-provincia="{{ $candidato->idProvincia }}" style="display: none;">
                                <div class="col-12">
                                    <label for="">Provincia</label>
                                    <select name="idProvincia" id="idProvincia" class="form-control"
                                        onchange="getDistritos()">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="row" id="div-distrito" data-distrito="{{ $candidato->idDistrito }}" style="display: none;">
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
                                    <select name="idPartido" id="idPartido" class="form-control">

                                        @foreach ($partidos as $partido)
                                            <option value="{{ $partido->id }}" {{ ($partido->id == $candidato->idPartido) ? 'selected' : '' }}>{{ $partido->partido }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <label for="">Nombres y Apellidos</label>
                                    @if ($candidato->nombresApellidos)
                                        <input type="text" name="nombresApellidos" placeholder="Nombres y Apellidos" class="form-control" value="{{ $candidato->nombresApellidos }}">
                                    @else
                                        <input type="text" name="nombresApellidos" placeholder="Nombres y Apellidos" class="form-control" value="{{ $candidato->id }}">
                                    @endif
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
                                    <textarea type="text" name="observacion" placeholder="observacion" class="form-control">{{ $candidato->observaciones }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary"
                                data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn bg-gradient-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('script')
    <script src="{{ asset('admin/assets/js/plugins/multistep-form.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/sweetalert.min.js') }}"></script>

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
        function getProvincias(id, select) {
            let idDepartamento = $('#idDepartamento').val();
            if(id > 0){
                idDepartamento = id;
            }
            let ip = window.location.origin;
            console.log('la ip es : ' + ip);
            console.log('la id del departamento es: ' + idDepartamento);
            $.ajax({
                url: ip + "/getProvincias/" + idDepartamento,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    var fila = "";
                    for (let i = 0; i < res.length; i++) {
                        fila += '<option value="' + res[i].id + '">' + res[i].provincia + '</option>';

                    }
                    if(id > 0){
                        $(select).append(fila);
                    }else{
                        $("#idProvincia option").remove();
                        $("#idProvincia").append(fila);
                        getDistritos(res[0].id);
                    }
                    
                    //console.log(res[0]);
                    //alert(res);
                }
            })
        }

        function getDistritos(id = 0, select) {
            let idProvincia = $('#idProvincia').val();
            if(id > 0){
                idProvincia = id;
            }
            let ip = window.location.origin;
            console.log('la ip es : ' + ip);
            console.log('la id del provincia es: ' + idProvincia);
            $.ajax({
                url: ip + "/getDistritos/" + idProvincia,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    var fila = "";
                    for (let i = 0; i < res.length; i++) {
                        fila += '<option value="' + res[i].id + '">' + res[i].distrito + '</option>';

                    }
                    if(id > 0){
                        console.log(select);
                        $(select).append(fila);
                    }else{
                        $("#idDistrito option").remove();
                        $("#idDistrito").append(fila);
                    }
                    
                    //console.log(res[0]);
                    //alert(res);
                }
            })
        }

        function selectTipo() {
            let tipo = $('#tipo').val();
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

        function selectTipoUpdate(key) {
            let form = $("#exampleModalEdit"+key)[0];
            let tipoUpdate = $("#exampleModalEdit"+key+" #tipo").val();         

            if (tipoUpdate === 'Regional') {
                $("#exampleModalEdit"+key+" #div-provincia").css('display','none');
                $("#exampleModalEdit"+key+" #div-distrito").css('display','none');
            } else {
                if (tipoUpdate === 'Provincial') {
                    $("#exampleModalEdit"+key+" #div-provincia").css('display','block');
                    $("#exampleModalEdit"+key+" #div-distrito").css('display','none');
                    getProvincias($("#exampleModalEdit"+key+" #idDepartamento").val(), $("#exampleModalEdit"+key+" #idProvincia"));
                    setTimeout(() => {
                        $("#exampleModalEdit"+key+" #idProvincia").val($("#exampleModalEdit"+key+" #div-provincia").data('provincia'));                        
                    }, 1000);
                } else {
                    $("#exampleModalEdit"+key+" #div-provincia").css('display','block');
                    $("#exampleModalEdit"+key+" #div-distrito").css('display','block');
                    getProvincias($("#exampleModalEdit"+key+" #idDepartamento").val(), $("#exampleModalEdit"+key+" #idProvincia"));
                    getDistritos($("#exampleModalEdit"+key+" #div-provincia").data('provincia'), $("#exampleModalEdit"+key+" #idDistrito"));
                    setTimeout(() => {
                        $("#exampleModalEdit"+key+" #idProvincia").val($("#exampleModalEdit"+key+" #div-provincia").data('provincia'));  
                        $("#exampleModalEdit"+key+" #idDistrito").val($("#exampleModalEdit"+key+" #div-distrito").data('distrito'));  
                    }, 1000);
                    
                }
            }
        }

        $(document).on('click', '.btnEliminar', (e) => {

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn bg-gradient-success',
                    cancelButton: 'btn bg-gradient-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Estas por Eliminar el Candidato?',
                text: "Estas de acuerdo en borrar este Candidato",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, Eliminar',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {

                    const ids = e.currentTarget.dataset.item

                    if (ids !== '') {
                        fetch("candidato/eliminar/" + ids, {
                                credentials: 'include',
                                method: 'GET',
                                headers: {
                                    'Content-Type': 'application/json'
                                }
                            })
                            .then(response => response.json())
                            .then((response) => {
                                if (response.status) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Felicidades',
                                        text: response.message,
                                    })
                                    window.setTimeout(location.reload(), 2000);
                                } else {
                                    Swal.fire({
                                        icon: 'info',
                                        title: 'Ooops...',
                                        text: response.message,
                                    })
                                }
                            })
                            .catch((error) => {
                                console.log(error);
                            })
                    }
                }
            })

        });
    </script>
@endsection
