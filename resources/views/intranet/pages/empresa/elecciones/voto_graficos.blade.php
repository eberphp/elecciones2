@extends('intranet.layouts.layout')
@section('style')
    <style>
        @media only screen and (min-width: 768px) {

            /* For desktop: */
            .graf {
                height: 300px;
            }
        }
    </style>
@endsection
@section('content')
    <?php $perfil = App\Models\Perfil::find(auth()->user()->perfil_id);
    $usuario = Auth::user();
    $personal = $usuario->personal;
    $permisos = [];
    if ($personal) {
        foreach ($personal->asignaciones as $asignacion) {
            if ($asignacion->permiso->grupo == 4) {
                $permisos[] = $asignacion->permiso->nombre;
            }
        }
    }
    ?>
    <div class="container-fluid py-2">
        <div class="row mt-2">
            <div class="col-12">
                <div class="card shadow-lg">
                    <!-- Card header -->
                    <div class="card-header bg-gradient-info ">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="mb-0 text-white">{{ $eleccion->nombre }} - GRÁFICOS / Por Ubicación y
                                    Resultado Total</h5>
                            </div>
                            <div class="col-6" style="text-align: right">
                                @if (in_array('Encuestador', $permisos))
                                    <a href="{{ route('elecciones.encuestador') }}" class="btn btn-info"
                                        style="float: right">Volver</a>
                                @else
                                    <a href="{{ route('elecciones') }}" class="btn btn-info" style="float: right">Volver</a>
                                @endif

                            </div>
                        </div>
                        <p class="text-sm mb-0">
                        </p>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col 12 col-md-5">
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-center align-items-center">
                                        <span class="text-info fw-bold" style="font-size: 14px;">Vigencia: Del
                                            {{ $eleccion->fecha_inicio }} al {{ $eleccion->fecha_termino }}
                                            @if (in_array('Encuestador', $permisos))
                                            @else
                                                <a href="{{ route('elecciones_voto') }}" id="volveratras"
                                                    class="btn bg-gradient-info btn-sm d-none">Volver</a>
                                                <button id="publicacion"
                                                    class="btn btn-sm bg-gradient-{{ $eleccion->publicacion == 'Si' ? 'success' : 'danger' }} mx-1">{{ $eleccion->publicacion == 'Si' ? 'Quitar Publicacion' : 'Publicar' }}</button>
                                            @endif

                                        </span>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <select class="form-control" name="resultado" id="resultado">
                                            <option value="Total" selected>Resultado Total</option>
                                            <option value="Ubicacion">Por local de votacion</option>
                                        </select>
                                    </div>

                                    <div class="col-12 col-md-6 px-5 py-2">
                                        <div class="wrapper px-2">
                                            <div
                                                class="d-flex justify-content-center align-items-center text-center px-3 z-index-2">
                                                <span class="fw-bold mx-1" style="font-size: 12px;">Días<div
                                                        class="day btn btn-xs bg-gradient-secondary text-white"></div>
                                                </span>
                                                <span class="fw-bold mx-1" style="font-size: 12px;">Horas<div
                                                        class="hours btn btn-xs bg-gradient-secondary text-white"></div>
                                                </span>
                                                <span class="fw-bold mx-1" style="font-size: 12px;">Min<div
                                                        class="minutes btn btn-xs bg-gradient-secondary text-white"></div>
                                                </span>
                                                <span class="fw-bold mx-1" style="font-size: 12px;">Sec<div
                                                        class="seconds btn btn-xs bg-gradient-secondary text-white"></div>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-3 text-center">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        {{-- <button class="btn btn-sm bg-gradient-info mx-1 btnVotoDis">Votar</button> --}}

                                        <div class="dropdown mt-2 w-100">
                                            <button class="btn bg-gradient-info dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                Ingrese a Votar
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">


                                                @if ($eleccion->encuesta_manual == 'Si')
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('elecciones_voto.manual', ['eleccion' => $eleccion->id]) }}">
                                                            Voto Manual
                                                        </a></li>
                                                @endif


                                            </ul>

                                        </div>

                                        <span class="d-block fw-bold alertVotoDis d-none" style="font-size: 12px;">Usted ya
                                            participó, espera la proxima apertura.</span>
                                    </div>

                                    <div class="col-12 text-center">

                                        <div class="dropdown mt-2">
                                            <button class="btn bg-gradient-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                Elecciones Anteriores
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                @foreach ($elecciones as $publicado)
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('elecciones_voto.grafico', ['eleccion' => $publicado->id]) }}"><span
                                                                class="badge bg-gradient-primary">{{ $publicado->fecha_termino }}</span>
                                                            <span
                                                                class="badge bg-gradient-{{ $publicado->publicacion == 'Si' ? 'success' : 'info' }}">{{ $publicado->publicacion == 'Si' ? 'Publicado' : 'En Proceso' }}</span>
                                                        </a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                @if (in_array('Encuestador', $permisos))
                                @else
                                    <span class="d-block fw-bold text-info" style="font-size: 14px;">Sumatoria de
                                        Votos.</span>
                                    <div>

                                        <div class="form-check form-switch d-flex justify-content-between mb-1">
                                            <input class="form-check-input" type="checkbox" onclick="getSumaVotos()"
                                                id="vman" {{ $eleccion->manual == 'Si' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="vman">Por Registro Manual</label>
                                            <input type="number" readonly name="vman"
                                                value="{{ $porManual[0]['total'] }}"
                                                class="form-control form-control-sm mx-2 text-end" style="width: 100px;">
                                        </div>

                                        <div class="form-check form-switch d-flex justify-content-between mb-1">
                                            <label class="form-check-label" for="total">Total</label>
                                            <input type="number" readonly name="total" id="total"
                                                class="form-control form-control-sm mx-2 text-end" style="width: 100px;">

                                        </div>
                                        <button id="btnSumaVotos"
                                            class="btn btn-sm w-100 mt-1 bg-gradient-dark">Guardar</button>
                                        <div class="w-100 d-flex">
                                            <button class="btn btn-sm btn-danger mt-1 d-none" id="modaluploadfiles"> <i
                                                    class="fa fa-upload" data-backdrop="static"></i> Actas
                                            </button>
                                            <button class="btn btn-danger mx-2 d-none" id="modaluploadevidencias"> <i
                                                    class="fa fa-upload" data-backdrop="static"></i> Evidencias
                                            </button>
                                        </div>



                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>

                </div>
                <div class="card mt-3 shadow-lg">
                    <div class="card-header bg-gradient-success text-white">
                        <div class="row">
                            <div class="col-12 col-md-3 mb-3">
                                <label for="departamento" class="text-white">Departamento</label>
                                <select name="departamento" id="departamento" class="form-control" required
                                    onchange="getProvincias(departamento)">
                                    <option value="">-- Seleccione --</option>
                                    @foreach ($departamentos as $departamento)
                                        <option value="{{ $departamento->id }}">{{ $departamento->departamento }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Campo requerido*</div>
                            </div>

                            <div class="col-12 col-md-3 mb-3">
                                <label for="provincia" class="text-white">Provincia</label>
                                <select name="provincia" id="provincia" class="form-control" required
                                    onchange="getDistritos()">
                                    <option value="">-- Seleccione --</option>
                                </select>
                                <div class="invalid-feedback">Campo requerido*</div>
                            </div>

                            <div class="col-12 col-md-3 mb-3">
                                <label for="distrito" class="text-white">Distrito</label>
                                <select name="distrito" id="distrito" class="form-control" required
                                    onchange="getLocalesVotacion(0)">
                                    <option value="">-- Seleccione --</option>
                                </select>
                                <div class="invalid-feedback">Campo requerido*</div>
                            </div>

                            <div class="col-12 col-md-3 mb-3">
                                <label for="" class="text-white">Zona</label>
                                <select name="zona" id="zona" class="form-control" required disabled
                                    onchange="getVotosDepartamento()">
                                    <option value="" selected>-- TODOS --</option>
                                </select>
                                <div class="invalid-feedback">Campo requerido*</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div> <!-- End CArr -->

            <div class="row mb-3 mt-3" style="padding-right: 0;">
                <div class="col-12 col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="chart-departamento" class="chart-canvas graf" height="220px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="card mb-3">
                        <div class="card-body p-3">
                            <div class="chart">
                                <canvas id="chart-provincia" class="chart-canvas graf" height="220px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="card mb-3">
                        <div class="card-body p-3">
                            <div class="chart">
                                <canvas id="chart-distrito" class="chart-canvas graf" height="220px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="position-fixed top-0 start-50 translate-middle-x z-index-2">

        @if (Session('success'))
            <div class="toast fade p-2 mt-2 bg-gradient-success show" role="alert" aria-live="polite" id="infoToast"
                aria-atomic="true" data-bs-delay="10">
                <div class="toast-header bg-transparent border-0">
                    <i class="ni ni-bell-55 text-white me-2"></i>
                    <span class="me-auto text-white font-weight-bold">{{ config('app.name') }} - Encuestas</span>
                    <i class="fas fa-times text-md text-white ms-3 cursor-pointer" data-bs-dismiss="toast"
                        aria-label="Close" aria-hidden="true"></i>
                </div>
                <hr class="horizontal light m-0">
                <div class="toast-body text-white">{{ Session('success') }}</div>
            </div>
        @endif

        @if (Session('fail'))
            <div class="toast fade p-2 mt-2 bg-gradient-danger show" role="alert" aria-live="polite" id="dangerToas"
                aria-atomic="true" data-bs-delay="10">
                <div class="toast-header bg-transparent border-0">
                    <i class="ni ni-bell-55 text-white me-2"></i>
                    <span class="me-auto text-white font-weight-bold">{{ config('app.name') }} - Encuestas</span>
                    <i class="fas fa-times text-md text-white ms-3 cursor-pointer" data-bs-dismiss="toast"
                        aria-label="Close" aria-hidden="true"></i>
                </div>
                <hr class="horizontal light m-0">
                <div class="toast-body text-white">{{ Session('fail') }}</div>
            </div>
        @endif


    </div>
    <div class="modal fade" id="documentsModal" tabindex="-1" role="dialog" aria-labelledby="documentsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="documentsModalLabel">Archivos</h5>
                    <span aria-hidden="true" style="cursor: pointer" onclick="closeModal()"
                        class="close h4 close-modall" data-dismiss="modal" aria-label="Close">&times;</span>
                </div>
                <div class="modal-body">
                    <form id="cvForm">
                        <div class="row">

                            <div class="col-md-5">
                                <div class="w-100 table-responsive">
                                    <table class="table">

                                        <head>
                                            <tr>
                                                <td>Archivo</td>
                                                <td>Acción</td>
                                            </tr>
                                        </head>
                                        <tbody id="documentossubidos" style="font-size: .8em!important">

                                        </tbody>
                                    </table>

                                    <div class="progress d-none" id="progressupload">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                                            role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                            style="width: 75%"></div>
                                    </div>
                                </div>
                                <form action="">
                                    <div class="form-group my-4">
                                        <label class="btn btn-danger btn-sm" for="document_selected"> <i
                                                class="fa fa-upload"></i> Subir
                                            archivo</label>
                                        <input type="file" accept=".pdf,image/*" onchange="selectFileUpload(this)"
                                            name="documentoseleccionado" class="form-control d-none"
                                            id="document_selected">


                                    </div>

                                </form>
                            </div>
                            <div class="col-md-7">
                                <div id="document_preview"></div>

                            </div>


                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
    <input type="hidden" name="provinciaparam" id="provinciaparam">
    <input type="hidden" name="distritoparam" id="distritoparam">
    <input type="hidden" name="localparam" id="localparam">

    <input type="hidden" name="tipo_upload" id="tipo_upload">
@endsection

@section('script')
    <script src="{{ asset('admin/assets/js/plugins/multistep-form.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/datatables.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/sweetalert.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/chartjs.min.js') }}"></script>
    <script src="https://unpkg.com/chart.js-plugin-labels-dv@3.0.5/dist/chartjs-plugin-labels.min.js"></script>

    <script>
        function documentPreview(document) {
            console.log(document);
            let path = $(document).attr("path");
            let type = $(document).attr("type");
            $("#document_preview").empty();
            if (type == "pdf") {
                $("#document_preview").html(`<embed src="/storage/${path}"  alt="" width="100%" height="500px"
                                    type="application/pdf" />`);
            } else {
                $("#document_preview").html(`<img src="/storage/${path}"  alt="" width="100%" height="500px" />`);
            }
        }
        async function documentDelete(document) {
            let id = $(document).attr("id");
            let response = await fetch(`/locales_votacion/files/delete`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $("input[name='_token']").val(),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    id
                })
            });
            let data = await response.json();
            if (data.success) {
                Swal.fire("", "Eliminado correctamente", "success");
                let tipo = $("#tipo_upload").val();
                renderFiles(tipo).then(response => {});
            } else {
                Swal.fire("", "Error al eliminar!", "error");
            }
        }
        const renderFiles = async function(tipo = "actas") {
            $("#document_preview").empty();
            let local = $("#zona").val();
            let eleccion = '{{ $eleccion->id }}';
            let response = await fetch(`/locales_votacion/files/${local}/${eleccion}/${tipo}`, {
                method: 'GET'
            });
            let data = await response.json();
            if (data.success) {
                let html = "";
                data.files.forEach((element) => {
                    html +=
                        `<tr> <td>${element.file_name}</td> <td> <a href="/storage/${element.file_path}" download="${element.file_name}"> <i class="fa fa-download"></i>   </a> <i class="fa fa-eye mx-2" path="${element.file_path}" type="${element.file_type}" style="cursor: pointer;" onclick="documentPreview(this)"></i><i class="fa fa-trash text-danger" path="${element.file_path}" id="${element.id}" type="${element.file_type}" style="cursor: pointer;" onclick="documentDelete(this)"></i> </td></tr>`;
                })
                $("#documentossubidos").html(html);
                return true;
            }
            return false;
        }


        function selectFileUpload(ev) {

            let local = $("#zona").val();
            let eleccion = '{{ $eleccion->id }}';
            let mesa_desbloqueado = $("#resultado").val();
            let tipo_upload = $("#tipo_upload").val();
            if ($(ev)[0].files[0]) {
                const formData = new FormData();
                let documents = true;
                if ($(ev)[0].files[0]) {
                    formData.append('documento', $(ev)[0].files[0]);
                    formData.append('local', local);
                    formData.append('eleccion', eleccion);
                    formData.append('tipo', tipo_upload);
                }
                $("#progressupload").removeClass("d-none");
                $.ajax({
                    url: `/locales_votacion/files`,
                    type: "POST",
                    contentType: false,
                    processData: false,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").val(),
                    },
                    success: function(data) {
                        if (data.success) {
                            Swal.fire("", "Se a subido correctamente", "success");
                            renderFiles().then(response => {
                                $("#documentsModal").modal("hide");
                                console.log(data);
                            })
                        } else {
                            Swal.fire("", data.message, "error");
                        }
                        $("#progressupload").addClass("d-none");
                    },
                    error: function(data) {
                        Swal.fire("", data.message, "error");
                        $("#progressupload").addClass("d-none");
                    },
                });
            } else {
                alert("seleccione un archivo");
            }
        }

        $(document).ready(function() {

            $("#modaluploadfiles").on("click", async function(e) {
                let local = $("#zona").val();
                let eleccion = '{{ $eleccion->id }}';
                let mesa_desbloqueado = $("#resultado").val();
                if (local && eleccion && mesa_desbloqueado == "Ubicacion") {

                    $("#tipo_upload").val("actas");
                    renderFiles("actas").then(response => {
                        $("#documentsModal").modal("show");
                    });

                } else {
                    alert("Seleccione una mesa");
                }
            });
            $("#modaluploadevidencias").on("click", async function(e) {
                let local = $("#zona").val();
                let eleccion = '{{ $eleccion->id }}';
                if (local && eleccion) {
                    $("#tipo_upload").val("evidencias");
                    renderFiles("evidencias").then(response => {
                        $("#documentsModal").modal("show");
                    });
                } else {
                    alert("Seleccione una mesa");
                }

            })

        });

        function closeModal() {
            $("#documentsModal").modal("hide");
        }
        let dataTableSearch;
        let dataVotos = {
            votoReg: [],
            votoPro: [],
            votoDis: [],
        };

        let sumaVotos = {};

        $("#publicacion").click((e) => {
            const encid = '{{ $eleccion->id }}';
            if (encid === '') {
                Swal.fire({
                    icon: 'info',
                    title: 'Ooops...',
                    text: 'Recargue la pagina y intentente  Publicar.',
                })
                return false;
            }

            fetch('/elecciones/' + encid + '/Publicacion', {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").val(),
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
                        location.reload();
                    } else {
                        Swal.fire({
                            icon: 'danger',
                            title: 'Ooops...',
                            text: response.message,
                        })
                    }
                })
                .catch((error) => {
                    console.log(error);
                })
        })


        $("#btnSumaVotos").click((e) => {
            const encid = '{{ $eleccion->id }}';
            console.log(encid);
            if (encid === '') {
                Swal.fire({
                    icon: 'info',
                    title: 'Ooops...',
                    text: 'Recargue la pagina y intentente  Guardar.',
                })
                return false;
            }

            fetch('/elecciones/' + encid + '/Sumatoria', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $("input[name='_token']").val(),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(sumaVotos)
                })
                .then(response => response.json())
                .then((response) => {
                    if (response.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Felicidades',
                            text: response.message,
                        })
                        location.reload();
                    } else {
                        Swal.fire({
                            icon: 'danger',
                            title: 'Ooops...',
                            text: response.message,
                        })
                    }
                })
                .catch((error) => {
                    console.log(error);
                })
        })

        $("#resultado").change((e) => {

            if (e.currentTarget.value == 'Ubicacion') {
                $("#zona").attr('disabled', false);
                $("#zona option[value='']").attr("selected", true);
                $("#zona option[value='']").text("-- Selecciona --");
            } else {
                $("#zona").attr('disabled', true);
                $("#zona").html('<option value="">-- TODO --</option>')
            }

            getLocalesVotacion();
            getVotosDepartamento();
        })

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn bg-gradient-success',
                cancelButton: 'btn bg-gradient-danger'
            },
            buttonsStyling: false
        })



        const getSumaVotos = () => {
            let tvotos = 0,
                vtd = 0,
                vte = 0,
                vtm = 0;
            let vdis = $("#vdis").prop('checked');
            let venc = $("#venc").prop('checked');
            let vman = $("#vman").prop('checked');
            if (vdis) {
                vtd = parseInt($("input[name='vdis']").val());
                sumaVotos.dispositivo = 'Si';
            } else {
                sumaVotos.dispositivo = 'No';
            }

            if (venc) {
                vte = parseInt($("input[name='venc']").val());
                sumaVotos.encuestador = 'Si'
            } else {
                sumaVotos.encuestador = 'No'
            }

            if (vman) {
                vtm = parseInt($("input[name='vman']").val());
                sumaVotos.manual = 'Si'
            } else {
                sumaVotos.manual = 'No'
            }

            tvotos = vtd + vte + vtm;
            $("#total").val(tvotos)
        }
        $(document).ready(function() {
            let url = window.location.href;
            let params = url.split('?');
            console.log(params);
            if (params.length > 1) {
                let paramsarray = params[1].split('&');
                if (paramsarray.length == 4) {

                    let idDepartamento = paramsarray[0].split("=")[1];
                    let idProvincia = paramsarray[1].split("=")[1];
                    let idDistrito = paramsarray[2].split("=")[1];
                    let idLocal = paramsarray[3].split("=")[1];
                    $("#departamento").val(idDepartamento);
                    getSumaVotos();
                    getProvincias();
                    $("#departamento").attr("disabled", true);
                    $("#provincia").attr("disabled", true);
                    $("#distrito").attr("disabled", true);
                    $("#provinciaparam").val(idProvincia);
                    $("#distritoparam").val(idDistrito);
                    $("#localparam").val(idLocal);
                    $("#dropdownMenuButton").addClass("d-none");
                    $("#publicacion").addClass("d-none");
                    $("#volveratras").removeClass("d-none");
                } else {
                    getSumaVotos();
                    $("#departamento").val(1);
                    getProvincias();
                }
            } else {
                getSumaVotos();
                $("#departamento").val(1);
                getProvincias();
            }

        });

        $("#forms").submit((e) => {
            e.preventDefault();

            dataVotos.departamento = $("#departamento").val();
            dataVotos.provincia = $("#provincia").val();
            dataVotos.distrito = $("#distrito").val();
            dataVotos.zona = $("#zona").val();
            dataVotos.encuesta = $("input[name='idencuesta']").val();
            dataVotos.codigo = $("input[name='codigo']").val();

            if (dataVotos.votoReg.length <= 0 || dataVotos.votoPro <= 0 || dataVotos.votoDis.length <= 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No tienes ningun voto, por favor ingrese sus votos.',
                });
                return false;
            }

            swalWithBootstrapButtons.fire({
                title: 'Estas por ingresar votos a la  Encuesta?',
                text: "Estas de acuerdo en guardar tus votos, Recuerda Anotar TU CODIGO DE DOCUMENTO ANTES DE GUARDAR LOS VOTOS: " +
                    dataVotos.codigo,
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Si, Guardar',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {

                    fetch('/Votos/Manuales', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $("input[name='_token']").val(),
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(dataVotos),
                        })
                        .then(response => response.json())
                        .then((response) => {
                            if (response.status) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Felicidades',
                                    text: response.message,
                                })
                                location.reload();
                            } else {
                                Swal.fire({
                                    icon: 'danger',
                                    title: 'Ooops...',
                                    text: response.message,
                                })
                            }
                        })
                        .catch((error) => {
                            console.log(error);
                        })

                }
            })
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
        function getProvincias() {
            $("#modaluploadfiles").addClass("d-none");
            $("#modaluploadevidencias").addClass("d-none");
            let idDepartamento = $('#departamento').val();
            let ip = window.location.origin;
            $.ajax({
                url: ip + "/getProvincias/" + idDepartamento,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    var fila = "";
                    for (let i = 0; i < res.length; i++) {
                        fila += '<option value="' + res[i].id + '">' + res[i].provincia + '</option>';

                    }
                    $("#provincia option").remove();
                    $("#provincia").append(fila);

                    let idprovincia = res[0].id;
                    if ($("#provinciaparam").val()) {
                        idprovincia = $("#provinciaparam").val();
                        $("#provincia").val(idprovincia);
                    } else {
                        $("#provincia").val(idprovincia);
                    }

                    getDistritos(idprovincia);
                }
            })
        }

        function getDistritos(id) {
            let idProvincia = $('#provincia').val();
            let ip = window.location.origin;
            $.ajax({
                url: ip + "/getDistritos/" + idProvincia,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    var fila = "";
                    for (let i = 0; i < res.length; i++) {
                        fila += '<option value="' + res[i].id + '">' + res[i].distrito + '</option>';

                    }
                    $("#distrito option").remove();
                    $("#distrito").append(fila);
                    let idDistrito = res[0].id;
                    if ($("#distritoparam").val()) {
                        idDistrito = $("#distritoparam").val();
                        $("#distrito").val(idDistrito);
                    } else {
                        $("#distrito").val(idDistrito);
                    }

                    getLocalesVotacion(idDistrito);
                    getVotosDepartamento();
                }
            });
            $("#modaluploadfiles").addClass("d-none");

            $("#modaluploadevidencias").addClass("d-none");
        }

        const getLocalesVotacion = (id) => {
            let departamento = $('#departamento').val();
            let provincia = $('#provincia').val();
            let distrito = $('#distrito').val();

            $("#modaluploadevidencias").addClass("d-none");
            $.ajax({
                url: "/" + departamento + "/" + provincia + "/" + distrito + "/locales_votacion",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    var fila = "<option value='' selected>-- TODOS --</option>";
                    for (let i = 0; i < res.length; i++) {
                        fila += '<option value="' + res[i].id + '">' + res[i].nom_local + " - " + res[i]
                            .num_mesa + '</option>';

                    }
                    $("#zona option").remove();
                    $("#zona").append(fila);
                    if ($("#localparam").val()) {
                        $("#zona").val($("#localparam").val());
                    }

                    getVotosDepartamento();

                }
            });
        };
    </script>
    <script>
        function updateClock() {
            var today = new Date();
            today.setHours(today.getHours() - 5);
            const todaysDate = today.getTime();
            const futureDate = new Date('{{ $eleccion->fecha_termino }}').getTime();
            const timeInMilliSecs = futureDate - todaysDate;
            const nDays = Math.floor(timeInMilliSecs / 1000 / 60 / 60 / 24);
            const nHours = Math.floor(((timeInMilliSecs / 1000 / 60 / 60 / 24) - nDays) * 24);
            const nMins = Math.floor((((timeInMilliSecs / 1000 / 60 / 60 / 24) - nDays) * 24 - nHours) * 60);
            const nSecs = Math.floor(((((timeInMilliSecs / 1000 / 60 / 60 / 24) - nDays) * 24 - nHours) * 60 - nMins) * 60);
            document.querySelector(".day").innerHTML = nDays;
            document.querySelector(".hours").innerHTML = nHours;
            document.querySelector(".minutes").innerHTML = nMins;
            document.querySelector(".seconds").innerHTML = nSecs;
            setTimeout(updateClock, 1000);
        }
        updateClock();
    </script>
    <script>
        let chDep, chPro, chDis;
        let iDe, iPr, iDi;

        //Data maxima a Mostrarse en Graficos 9 = 10 datas;
        let dataView = 9;
        dataMax = 10;

        const getVotosDepartamento = () => {

            let departamento = $('#departamento').val();
            let provincia = $('#provincia').val();
            let distrito = $('#distrito').val();
            let zona = $('#zona').val();
            if (zona == '') {
                zona = 'Todos';
            }

            $.ajax({
                url: "/elecciones_voto/{{ $eleccion->id }}/" + departamento + "/" + provincia + "/" +
                    distrito +
                    "/" + zona +
                    "/Graficos/Total",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    setGraficos(res);
                    let zona = $('#zona').val();
                    let resultado_por = $("#resultado").val();
                    console.log("zona" + zona);
                    if (resultado_por == "Ubicacion" && zona != "") {
                        $("#modaluploadfiles").removeClass("d-none");
                        $("#modaluploadevidencias").removeClass("d-none");
                    }
                }
            });
        }

        const setGraficos = (res) => {
            let labDep = [],
                lebPro = [],
                labDis = [];
            let imgDep = [],
                imgPro = [],
                imgDis = [];
            let dataDep = [],
                dataPro = [],
                dataDis = [];
            let totalDep = 0,
                totalPro = 0,
                totalDis = 0;
            const urls =
                'https://images.pexels.com/photos/6266317/pexels-photo-6266317.jpeg?cs=srgb&dl=pexels-ann-h-6266317.jpg&fm=jpg';

            res.forEach(el => {
                let fd;

                if (el.cReg.length > 0) {

                    if (el.cReg[0].visualiza === 'Si') {
                        fd = (el.cReg[0].foto === "") ? urls : `{{ asset('storage/img/fotos/') }}/` + el.cReg[
                            0].foto;
                    } else {
                        fd = urls;
                    }

                    imgDep.push({
                        src: fd,
                        src1: (el.logotipo === "") ? urls : `{{ asset('storage/img/logotipos/') }}/` +
                            el
                            .logotipo,
                        width: 20,
                        height: 24,
                        value: el.Regional[0].total
                    });
                }

                if (el.cPro.length > 0) {

                    if (el.cPro[0].visualiza === 'Si') {
                        fd = (el.cPro[0].foto === "") ? urls : `{{ asset('storage/img/fotos/') }}/` + el.cPro[
                            0].foto;
                    } else {
                        fd = urls;
                    }

                    imgPro.push({
                        src: fd,
                        src1: (el.logotipo === "") ? urls : `{{ asset('storage/img/logotipos/') }}/` +
                            el
                            .logotipo,
                        width: 20,
                        height: 24,
                        value: el.Provincial[0].total
                    });
                }

                if (el.cDis.length > 0) {

                    if (el.cDis[0].visualiza === 'Si') {
                        fd = (el.cDis[0].foto === "") ? urls : `{{ asset('storage/img/fotos/') }}/` + el.cDis[
                            0].foto;
                    } else {
                        fd = urls;
                    }

                    imgDis.push({
                        src: fd,
                        src1: (el.logotipo === "") ? urls : `{{ asset('storage/img/logotipos/') }}/` +
                            el
                            .logotipo,
                        width: 20,
                        height: 24,
                        value: parseInt(el.Distrital[0].total)
                    });
                }


                dataDep.push(parseInt(el.Regional[0].total));
                dataPro.push(parseInt(el.Provincial[0].total));
                dataDis.push(parseInt(el.Distrital[0].total));

                totalDep += parseInt(el.Regional[0].total);
                totalPro += parseInt(el.Provincial[0].total);
                totalDis += parseInt(el.Distrital[0].total);
            });

            // ORDEN DEPARTAMENTO
            let dataDeps = dataDep.sort((a, b) => {
                if (a == b) {
                    return 0;
                }
                if (a > b) {
                    return -1;
                }
                return 1;
            })

            dataDeps.forEach((el, key) => {
                let porDep = ((el / totalDep) * 100).toFixed(2);
                if (isNaN(porDep)) {
                    porDep = 0;
                }
                labDep.push(porDep + '%');
            })

            // ORDEN PROVINCIAL
            let dataPros = dataPro.sort((a, b) => {
                if (a == b) {
                    return 0;
                }
                if (a > b) {
                    return -1;
                }
                return 1;
            })

            dataPros.forEach((el, key) => {
                let porPro = ((el / totalPro) * 100).toFixed(2);
                if (isNaN(porPro)) {
                    porPro = 0;
                }
                lebPro.push(porPro + '%');
            })

            // ORDEN DISTRITAL
            let dataDiss = dataDis.sort((a, b) => {
                if (a == b) {
                    return 0;
                }
                if (a > b) {
                    return -1;
                }
                return 1;
            })

            dataDiss.forEach((el, key) => {
                let porDis = ((el / totalDis) * 100).toFixed(2);
                if (isNaN(porDis)) {
                    porDis = 0;
                }
                labDis.push(porDis + '%');
            });


            setGraDep(labDep, dataDep, imgDep.sort((a, b) => {
                return b.value - a.value;
            }), totalDep);
            iDe = imgDep.sort((a, b) => {
                return b.value - a.value;
            });
            setGraPro(lebPro, dataPro, imgPro.sort((a, b) => {
                return b.value - a.value;
            }), totalPro);
            iPr = imgPro.sort((a, b) => {
                return b.value - a.value;
            });
            setGraDis(labDis, dataDis, imgDis.sort((a, b) => {
                return b.value - a.value;
            }), totalDis);
            iDi = imgDis.sort((a, b) => {
                return b.value - a.value;
            });

        }

        const moveChartDep = {
            id: "chart-departamento",
            beforeDraw(chart, args, options) {

            },
            afterEvent(chart, args) {
                const {
                    ctx,
                    canvas,
                    chartArea: {
                        left,
                        right,
                        top,
                        bottom,
                        width,
                        height
                    }
                } = chart;

                canvas.addEventListener('mousemove', (event) => {
                    const x = args.event.x;
                    const y = args.event.y;
                    if (x >= left - 15 && x <= left + 15 && y >= height / 2 + top - 15 && y <= height / 2 +
                        top + 15) {
                        canvas.style.cursor = 'pointer';
                    } else if (x >= right - 15 && x <= right + 15 && y >= height / 2 + top - 15 && y <= height /
                        2 + top + 15) {
                        canvas.style.cursor = 'pointer';
                    } else {
                        canvas.style.cursor = 'default';
                    }
                })
            },
            afterDraw(chart, args, pluginOptions) {
                const {
                    ctx,
                    chartArea: {
                        left,
                        right,
                        top,
                        bottom,
                        width,
                        height
                    },
                    scales: {
                        x,
                        y
                    }
                } = chart;

                ctx.save();
                let ims;
                iDe.forEach((el, index) => {
                    let img = new Image();
                    img.src = iDe[index].src1;
                    ctx.drawImage(img, x.getPixelForValue(index) + 1, y.getPixelForValue(parseInt(iDe[index]
                        .value)) - 16, 20, 20);
                });

                class CircleChevron {

                    draw(ctx, x1, pixel) {
                        const angle = Math.PI / 180;

                        ctx.beginPath();
                        ctx.lineWith = 3;
                        ctx.strokeStyle = 'rgba(102, 102, 102, 0.5)';
                        ctx.fillStyle = 'white';
                        ctx.arc(x1, height / 2 + top, 15, angle * 0, angle * 360, false);
                        ctx.stroke();
                        ctx.fill();
                        ctx.closePath();

                        // Flecha Izquierda
                        ctx.beginPath();
                        ctx.lineWith = 5;
                        ctx.strokeStyle = 'rgba(255, 26, 104, 1)';
                        ctx.moveTo(x1 + pixel, height / 2 + top - 7.5);
                        ctx.lineTo(x1 - pixel, height / 2 + top);
                        ctx.lineTo(x1 + pixel, height / 2 + top + 7.5);
                        ctx.stroke();
                        ctx.closePath();
                    }
                }

                let drawCiecleLeft = new CircleChevron();
                drawCiecleLeft.draw(ctx, left, 5);

                let drawCiecleRight = new CircleChevron();
                drawCiecleRight.draw(ctx, right, -5);
            }
        }

        const moveChartPro = {
            id: "chart-departamento",
            beforeDraw(chart, args, options) {

            },
            afterEvent(chart, args) {
                const {
                    ctx,
                    canvas,
                    chartArea: {
                        left,
                        right,
                        top,
                        bottom,
                        width,
                        height
                    }
                } = chart;

                canvas.addEventListener('mousemove', (event) => {
                    const x = args.event.x;
                    const y = args.event.y;
                    if (x >= left - 15 && x <= left + 15 && y >= height / 2 + top - 15 && y <= height / 2 +
                        top + 15) {
                        canvas.style.cursor = 'pointer';
                    } else if (x >= right - 15 && x <= right + 15 && y >= height / 2 + top - 15 && y <= height /
                        2 + top + 15) {
                        canvas.style.cursor = 'pointer';
                    } else {
                        canvas.style.cursor = 'default';
                    }
                })
            },
            afterDraw(chart, args, pluginOptions) {
                const {
                    ctx,
                    chartArea: {
                        left,
                        right,
                        top,
                        bottom,
                        width,
                        height
                    },
                    scales: {
                        x,
                        y
                    }
                } = chart;

                ctx.save();
                let ims;
                iPr.forEach((el, index) => {
                    let img = new Image();
                    img.src = iPr[index].src1;
                    ctx.drawImage(img, x.getPixelForValue(index) + 1, y.getPixelForValue(parseInt(iPr[index]
                        .value)) - 16, 20, 20);
                });

                class CircleChevron {

                    draw(ctx, x1, pixel) {
                        const angle = Math.PI / 180;

                        ctx.beginPath();
                        ctx.lineWith = 3;
                        ctx.strokeStyle = 'rgba(102, 102, 102, 0.5)';
                        ctx.fillStyle = 'white';
                        ctx.arc(x1, height / 2 + top, 15, angle * 0, angle * 360, false);
                        ctx.stroke();
                        ctx.fill();
                        ctx.closePath();

                        // Flecha Izquierda
                        ctx.beginPath();
                        ctx.lineWith = 5;
                        ctx.strokeStyle = 'rgba(255, 26, 104, 1)';
                        ctx.moveTo(x1 + pixel, height / 2 + top - 7.5);
                        ctx.lineTo(x1 - pixel, height / 2 + top);
                        ctx.lineTo(x1 + pixel, height / 2 + top + 7.5);
                        ctx.stroke();
                        ctx.closePath();
                    }
                }

                let drawCiecleLeft = new CircleChevron();
                drawCiecleLeft.draw(ctx, left, 5);

                let drawCiecleRight = new CircleChevron();
                drawCiecleRight.draw(ctx, right, -5);
            }
        }

        const moveChartDis = {
            id: "chart-departamento",
            beforeDraw(chart, args, options) {

            },
            afterEvent(chart, args) {
                const {
                    ctx,
                    canvas,
                    chartArea: {
                        left,
                        right,
                        top,
                        bottom,
                        width,
                        height
                    }
                } = chart;

                canvas.addEventListener('mousemove', (event) => {
                    const x = args.event.x;
                    const y = args.event.y;
                    if (x >= left - 15 && x <= left + 15 && y >= height / 2 + top - 15 && y <= height / 2 +
                        top + 15) {
                        canvas.style.cursor = 'pointer';
                    } else if (x >= right - 15 && x <= right + 15 && y >= height / 2 + top - 15 && y <= height /
                        2 + top + 15) {
                        canvas.style.cursor = 'pointer';
                    } else {
                        canvas.style.cursor = 'default';
                    }
                })
            },
            afterDraw(chart, args, pluginOptions) {
                const {
                    ctx,
                    chartArea: {
                        left,
                        right,
                        top,
                        bottom,
                        width,
                        height
                    },
                    scales: {
                        x,
                        y
                    }
                } = chart;

                ctx.save();
                let ims;
                iDi.forEach((el, index) => {
                    let img = new Image();
                    img.src = iDi[index].src1;
                    ctx.drawImage(img, x.getPixelForValue(index) + 1, y.getPixelForValue(parseInt(iDi[index]
                        .value)) - 16, 20, 20);
                });

                class CircleChevron {

                    draw(ctx, x1, pixel) {
                        const angle = Math.PI / 180;

                        ctx.beginPath();
                        ctx.lineWith = 3;
                        ctx.strokeStyle = 'rgba(102, 102, 102, 0.5)';
                        ctx.fillStyle = 'white';
                        ctx.arc(x1, height / 2 + top, 15, angle * 0, angle * 360, false);
                        ctx.stroke();
                        ctx.fill();
                        ctx.closePath();

                        // Flecha Izquierda
                        ctx.beginPath();
                        ctx.lineWith = 5;
                        ctx.strokeStyle = 'rgba(255, 26, 104, 1)';
                        ctx.moveTo(x1 + pixel, height / 2 + top - 7.5);
                        ctx.lineTo(x1 - pixel, height / 2 + top);
                        ctx.lineTo(x1 + pixel, height / 2 + top + 7.5);
                        ctx.stroke();
                        ctx.closePath();
                    }
                }

                let drawCiecleLeft = new CircleChevron();
                drawCiecleLeft.draw(ctx, left, 5);

                let drawCiecleRight = new CircleChevron();
                drawCiecleRight.draw(ctx, right, -5);
            }
        }

        const setGraDep = (labels, data, images, total) => {

            let dep = document.getElementById("chart-departamento").getContext("2d");

            if (chDep) {
                chDep.destroy();
            }

            chDep = new Chart(dep, {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Votos",
                        weight: 5,
                        borderWidth: 0,
                        borderRadius: 4,
                        backgroundColor: "#20c997",
                        data: data,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            right: 16,
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        labels: {
                            render: 'image',
                            images: images,
                            padding: {
                                top: 10
                            }
                        },
                        title: {
                            display: true,
                            padding: {
                                bottom: 50
                            },
                            color: 'black',
                            text: 'DEPARTAMENTO: ' + $("#departamento option:selected").text().trim() + ' ' +
                                total
                        },
                    },
                    scales: {
                        x: {
                            min: 0,
                            max: dataView,
                        }
                    }
                },
                plugins: [moveChartDep]
            });

            const moveScroll = () => {
                const {
                    ctx,
                    canvas,
                    chartArea: {
                        left,
                        right,
                        top,
                        bottom,
                        width,
                        height
                    }
                } = chDep;

                canvas.addEventListener('click', (event) => {
                    const rect = canvas.getBoundingClientRect();
                    const x = event.clientX - rect.left;
                    const y = event.clientY - rect.top;

                    if (x >= left - 15 && x <= left + 15 && y >= height / 2 + top - 15 && y <= height / 2 +
                        top + 15) {
                        chDep.options.scales.x.min = chDep.options.scales.x.min - dataMax;
                        chDep.options.scales.x.max = chDep.options.scales.x.max - dataMax;
                        if (chDep.options.scales.x.min <= 0) {
                            chDep.options.scales.x.min = 0;
                            chDep.options.scales.x.max = dataView;
                        }
                    }


                    if (x >= right - 15 && x <= right + 15 && y >= height / 2 + top - 15 && y <= height /
                        2 + top + 15) {
                        chDep.options.scales.x.min = chDep.options.scales.x.min + dataMax;
                        chDep.options.scales.x.max = chDep.options.scales.x.max + dataMax;
                        if (chDep.options.scales.x.max >= data.length) {
                            chDep.options.scales.x.min = data.length - dataMax;
                            chDep.options.scales.x.max = data.length;
                        }
                    }
                    chDep.update();

                });
            }

            chDep.ctx.onclick = moveScroll();

        }

        const setGraPro = (labels, data, images, total) => {

            let pro = document.getElementById("chart-provincia").getContext("2d");

            if (chPro) {
                chPro.destroy();
            }

            chPro = new Chart(pro, {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Votos",
                        weight: 5,
                        borderWidth: 0,
                        borderRadius: 4,
                        backgroundColor: "#20c997",
                        data: data,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            right: 16,
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        labels: {
                            render: 'image',
                            images: images,
                            padding: {
                                top: 10
                            }
                        },
                        title: {
                            display: true,
                            padding: {
                                bottom: 60
                            },
                            color: 'black',
                            text: 'PROVINCIA: ' + $("#provincia option:selected").text().trim() + ' ' + total
                        },
                    },
                    scales: {
                        x: {
                            min: 0,
                            max: dataView,
                        }
                    }
                },
                plugins: [moveChartPro]
            });

            const moveScroll = () => {
                const {
                    ctx,
                    canvas,
                    chartArea: {
                        left,
                        right,
                        top,
                        bottom,
                        width,
                        height
                    }
                } = chPro;

                canvas.addEventListener('click', (event) => {
                    const rect = canvas.getBoundingClientRect();
                    const x = event.clientX - rect.left;
                    const y = event.clientY - rect.top;

                    if (x >= left - 15 && x <= left + 15 && y >= height / 2 + top - 15 && y <= height / 2 +
                        top + 15) {
                        chPro.options.scales.x.min = chPro.options.scales.x.min - dataMax;
                        chPro.options.scales.x.max = chPro.options.scales.x.max - dataMax;
                        if (chPro.options.scales.x.min <= 0) {
                            chPro.options.scales.x.min = 0;
                            chPro.options.scales.x.max = dataView;
                        }
                    }


                    if (x >= right - 15 && x <= right + 15 && y >= height / 2 + top - 15 && y <= height /
                        2 + top + 15) {
                        chPro.options.scales.x.min = chPro.options.scales.x.min + dataMax;
                        chPro.options.scales.x.max = chPro.options.scales.x.max + dataMax;
                        if (chPro.options.scales.x.max >= data.length) {
                            chPro.options.scales.x.min = data.length - dataMax;
                            chPro.options.scales.x.max = data.length;
                        }
                    }
                    chPro.update();

                });
            }

            chPro.ctx.onclick = moveScroll();

        }

        const setGraDis = (labels, data, images, total) => {

            let dis = document.getElementById("chart-distrito").getContext("2d");

            if (chDis) {
                chDis.destroy();
            }

            chDis = new Chart(dis, {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Votos",
                        weight: 5,
                        borderWidth: 0,
                        borderRadius: 4,
                        backgroundColor: "#20c997",
                        data: data,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            right: 16,
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        labels: {
                            render: 'image',
                            images: images,
                            padding: {
                                top: 10
                            }
                        },
                        title: {
                            display: true,
                            padding: {
                                bottom: 60
                            },
                            color: 'black',
                            text: 'DISTRITO: ' + $("#distrito option:selected").text().trim() + ' ' + total
                        },
                    },
                    scales: {
                        x: {
                            min: 0,
                            max: dataView,
                        }
                    }
                },
                plugins: [moveChartDis]
            });

            const moveScroll = () => {
                const {
                    ctx,
                    canvas,
                    chartArea: {
                        left,
                        right,
                        top,
                        bottom,
                        width,
                        height
                    }
                } = chDis;

                canvas.addEventListener('click', (event) => {
                    const rect = canvas.getBoundingClientRect();
                    const x = event.clientX - rect.left;
                    const y = event.clientY - rect.top;

                    if (x >= left - 15 && x <= left + 15 && y >= height / 2 + top - 15 && y <= height / 2 +
                        top + 15) {
                        chDis.options.scales.x.min = chDis.options.scales.x.min - dataMax;
                        chDis.options.scales.x.max = chDis.options.scales.x.max - dataMax;
                        if (chDis.options.scales.x.min <= 0) {
                            chDis.options.scales.x.min = 0;
                            chDis.options.scales.x.max = dataView;
                        }
                    }


                    if (x >= right - 15 && x <= right + 15 && y >= height / 2 + top - 15 && y <= height /
                        2 + top + 15) {
                        chDis.options.scales.x.min = chDis.options.scales.x.min + dataMax;
                        chDis.options.scales.x.max = chDis.options.scales.x.max + dataMax;
                        if (chDis.options.scales.x.max >= data.length) {
                            chDis.options.scales.x.min = data.length - dataMax;
                            chDis.options.scales.x.max = data.length;
                        }
                    }
                    chDis.update();

                });
            }

            chDis.ctx.onclick = moveScroll();

        }
    </script>
@endsection
