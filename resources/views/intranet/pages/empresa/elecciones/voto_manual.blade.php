@extends('intranet.layouts.layout')
@section('style')
    <style>
        .table td,
        .table th {
            white-space: inherit !important;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid py-2">
        <div class="row mt-2">
            <div class="col-12">
                <div class="card shadow-lg">
                    <!-- Card header -->
                    <div class="card-header bg-gradient-info ">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="mb-0 text-white">Ingresar votos de manera Manual</h5>
                            </div>
                            <div class="col-6" style="text-align: right">
                                <a href="{{ route('elecciones_voto.grafico', ['eleccion' => $eleccion->id]) }}"
                                    class="btn bg-gradient-secondary mx-2" style="float: right">Ver Grafico</a>
                                <a href="{{ route('elecciones') }}" class="btn btn-info" style="float: right">Volver</a>
                                <button class="btn btn-danger mx-2 d-none" id="modaluploadfiles"> <i class="fa fa-upload"
                                        data-backdrop="static"></i> Subir actas</button>
                                <button class="btn btn-danger mx-2 d-none" id="modaluploadevidencias"> <i
                                        class="fa fa-upload" data-backdrop="static"></i> Subir evidencias</button>
                            </div>
                        </div>
                        <p class="text-sm mb-0">
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-1 text-center">
                                <span class="text-danger text-center text-white bg-gradient-primary p-2"
                                    style="border-radius: 25px;">CODIGO DE DOCUMENTO</span>
                                <input type="text" class="form-control text-center text-md fw-bold" readonly
                                    name="codigo" value="{{ Str::upper(Str::random(8)) }}">
                            </div>
                            <div class="col-12 col-md-3 mb-3">
                                <label for="">Departamento</label>
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
                                <label for="">Provincia</label>
                                <select name="provincia" id="provincia" class="form-control" required
                                    onchange="getDistritos()">
                                    <option value="">-- Seleccione --</option>
                                </select>
                                <div class="invalid-feedback">Campo requerido*</div>
                            </div>

                            <div class="col-12 col-md-3 mb-3">
                                <label for="">Distrito</label>
                                <select name="distrito" id="distrito" class="form-control" required
                                    onchange="getLocalesVotacion(0)">
                                    <option value="">-- Seleccione --</option>
                                </select>
                                <div class="invalid-feedback">Campo requerido*</div>
                            </div>

                            <div class="col-12 col-md-3 mb-3">
                                <label for="">Mesa</label>
                                <select name="num_mesa" id="num_mesa" class="form-control" required
                                    onchange="getCandidatos(this)">
                                    <option value="">-- Seleccione --</option>
                                </select>
                                <div class="invalid-feedback">Campo requerido*</div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card mt-3 shadow-lg">
                    <div class="card-header bg-gradient-success text-white">
                        <h6 class="text-white">Listado de Partidos Politicos</h6>
                    </div>
                    <form action="{{ route('elecciones_voto.store') }}" method="post" id="forms"
                        class="needs-validation" novalidate>
                        @csrf
                        <input type="hidden" name="ideleccion" id="ideleccion" value="{{ $eleccion->id }}">
                        <div class="row">

                            <div class="col-12 mb-3">
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0" id="tbDataVoto">
                                        <thead class="thead-light">
                                            <tr class="text-center">
                                                <th style="font-size: .85rem;">Partidos</th>
                                                <th style="font-size: .85rem;">Logo Tipo</th>
                                                <th style="font-size: .85rem;">Región</th>
                                                <th style="font-size: .85rem;">Provincia</th>
                                                <th style="font-size: .85rem;">Distrito</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbDataCandidatos"></tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn bg-gradient-success" id="btnSubmit">Guardar Votos</button>
                        </div>
                    </form>
                </div>
            </div> <!-- End CArr -->
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
    <input type="hidden" name="typeaction" id="typeaction">
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
    <input type="hidden" name="tipo_upload" id="tipo_upload">
@endsection

@section('script')
    <script src="{{ asset('admin/assets/js/plugins/multistep-form.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/datatables.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/sweetalert.min.js') }}"></script>

    <script>
        let dataTableSearch;
        let dataVotos = {
            votoReg: [],
            votoPro: [],
            votoDis: [],
        };

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn bg-gradient-success',
                cancelButton: 'btn bg-gradient-danger'
            },
            buttonsStyling: false
        });

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
                renderFiles().then(response => {});
            } else {
                Swal.fire("", "Error al eliminar!", "error");
            }
        }
        const renderFiles = async function(tipo = "actas") {
            let local = $("#num_mesa").val();
            let eleccion = $("#ideleccion").val();
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

            let local = $("#num_mesa").val();
            let eleccion = $("#ideleccion").val();
            let tipo_file = $("#tipo_upload").val();
            if ($(ev)[0].files[0]) {
                const formData = new FormData();
                let documents = true;
                if ($(ev)[0].files[0]) {
                    formData.append('documento', $(ev)[0].files[0]);
                    formData.append('local', local);
                    formData.append('eleccion', eleccion);
                    formData.append('tipo', tipo_file);
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
                            let tipo = $("#tipo_upload").val();
                            renderFiles(tipo).then(response => {
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
                let local = $("#num_mesa").val();
                let eleccion = $("#ideleccion").val();
                if (local && eleccion) {
                    $("#tipo_upload").val("actas");
                    renderFiles("actas").then(response => {
                        $("#documentsModal").modal("show");
                    });
                } else {
                    alert("Seleccione una mesa");
                }
            });
            $("#modaluploadevidencias").on("click", async function(e) {
                let local = $("#num_mesa").val();
                let eleccion = $("#ideleccion").val();
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

        $(document).on('change', '.allRegional', (e) => {
            getDataVotos();
        });

        $(document).on('change', '.allProvincial', (e) => {
            getDataVotos();
        });

        $(document).on('change', '.allDistrital', (e) => {
            getDataVotos();
        });

        const getDataVotos = () => {

            dataVotos.votoReg = [];
            dataVotos.votoPro = [];
            dataVotos.votoDis = [];

            $(".allPartidos").each((key, el) => {
                if (el.parentNode.parentNode.children[2].children[0]) {
                    const voto = parseInt(el.parentNode.parentNode.children[2].children[0].children[0].children[
                        0].value)
                    dataVotos.votoReg.push([el.value, voto]);
                } else {
                    dataVotos.votoReg.push([el.value, 0]);
                }

                if (el.parentNode.parentNode.children[3].children[0]) {
                    const voto = parseInt(el.parentNode.parentNode.children[3].children[0].children[0].children[
                        0].value)
                    dataVotos.votoPro.push([el.value, voto]);
                } else {
                    dataVotos.votoPro.push([el.value, 0]);
                }

                if (el.parentNode.parentNode.children[4].children[0]) {
                    const voto = parseInt(el.parentNode.parentNode.children[4].children[0].children[0].children[
                        0].value)
                    dataVotos.votoDis.push([el.value, voto]);
                } else {
                    dataVotos.votoDis.push([el.value, 0]);
                }
            });
        }

        $("#forms").submit((e) => {
            e.preventDefault();

            dataVotos.departamento = $("#departamento").val();
            dataVotos.provincia = $("#provincia").val();
            dataVotos.distrito = $("#distrito").val();
            dataVotos.num_mesa = $("#num_mesa").val();
            dataVotos.eleccion = $("input[name='ideleccion']").val();
            dataVotos.codigo = $("input[name='codigo']").val();
            dataVotos.editar = $("#typeaction").val();
            console.log(dataVotos);
            if (dataVotos.votoReg.length <= 0 || dataVotos.votoPro <= 0 || dataVotos.votoDis.length <= 0) {

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No tienes ningun voto, por favor ingrese sus votos.',
                });
                console.log(dataVotos);
                return false;
            }
            let join_data = [];
            dataVotos.votoReg.forEach((element, index) => {
                let valuedep = dataVotos.votoReg[index][0];
                let valuepro = dataVotos.votoPro[index][0];
                let valuedis = dataVotos.votoDis[index][0];

                let totalvotos = 0;
                if (valuedep == valuepro && valuedep == valuedis) {

                    totalvotos += dataVotos.votoDis[index][1];
                    totalvotos += dataVotos.votoPro[index][1];
                    totalvotos += dataVotos.votoReg[index][1];
                    join_data.push({
                        partido_id: valuedep,
                        votos_distrito: dataVotos.votoDis[index][1],
                        votos_departamento: dataVotos.votoReg[index][1],
                        votos_provincia: dataVotos.votoPro[index][1],
                        totalvotos: totalvotos
                    });
                }
            });
            dataVotos.votos = join_data;
            console.log(join_data);

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
                    fetch('/elecciones_voto/Manuales', {
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

            console.log(dataVotos);

            console.log('Enviado Votos');
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
            let idDepartamento = $('#departamento').val();

            $("#modaluploadfiles").addClass("d-none");
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
                    getDistritos(res[0].id);
                }
            })
        }

        function getDistritos(id) {
            let idProvincia = $('#provincia').val();

            $("#modaluploadfiles").addClass("d-none");
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
                    getLocalesVotacion(res[0].id);
                    $("#tbDataCandidatos").html('')
                }
            });
        }

        const getLocalesVotacion = (id) => {
            let departamento = $('#departamento').val();
            let provincia = $('#provincia').val();
            let distrito = $('#distrito').val();
            $.ajax({
                url: "/" + departamento + "/" + provincia + "/" + distrito + "/locales_votacion",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    var fila = "<option value='' >-- Seleccione --</option>";
                    for (let i = 0; i < res.length; i++) {
                        fila += '<option value="' + res[i].id + '">' + res[i].nom_local + " - " + res[i]
                            .num_mesa + '</option>';
                    }
                    $("#num_mesa option").remove();
                    $("#num_mesa").append(fila);
                    $("#tbDataCandidatos").html('')
                }
            });
        };

        const getCandidatos = (ev) => {

            if ($('#num_mesa').val() === '') {
                $("#tbDataCandidatos").html('');
                $("#modaluploadfiles").addClass("d-none");
                return false;
            }

            $("#modaluploadfiles").addClass("d-none");

            $("#modaluploadevidencias").addClass("d-none");
            let departamento = $('#departamento').val();
            let provincia = $('#provincia').val();
            let distrito = $('#distrito').val();
            let local_votacion = $(ev).val();
            let ideleccion = $("#ideleccion").val();
            $.ajax({
                url: "/" + departamento + "/" + provincia + "/" + distrito + "/" + local_votacion + "/" +
                    ideleccion + "/candidatos_elecciones",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(data_server) {
                    var fila = "";
                    $("#typeaction").val(data_server.editar);
                    let res = data_server.partidos;
                    const url = "{{ asset('storage/img/logotipos/') }}";
                    const urlCandidato = "{{ asset('storage/img/fotos/') }}";
                    for (let i = 0; i < res.length; i++) {
                        fila += `
                            <tr style="font-size:14px;">
                                <td class="text-center">
                                    <input type="hidden" class="allPartidos" name="partido[]" value="${res[i].id}">
                                    ${res[i].partido}</td>
                                <td>
                                    <div class="px-2 py-1 text-center">
                                        <div>
                                            <img src="${url +'/'+ res[i].logotipo}" class="avatar avatar-sm me-3"
                                                alt="${res[i].partido}">
                                        </div>
                                    </div> 
                                </td>
                                <td>`;
                        if (res[i].Regional.length > 0) {
                            fila += ` 
                                    <div class="px-2 py-1 mt-1 text-center">
                                        <div class="cc-selector p-2 text-center">
                                            <input class="allRegional form-control" id="r${res[i].Regional[0].id}" type="number" name="regional[]" value="${res[i].Regional[0].votos_departamento}" min="0" required />
                                        </div>
                                        <div class="d-flex flex-column justify-content-center mt-1" >
                                            <label for="r${res[i].Regional[0].id}"><h6 class="mb-0" style="font-size:10px;cursor:pointer;">${res[i].Regional[0].nombreCorto}</h6></label>
                                        </div>
                                    </div>                                    
                                    `;
                        }
                        fila += `</td>
                                <td>`;

                        if (res[i].Provincial.length > 0) {
                            fila += `
                                <div class="px-2 py-1 mt-1 text-center">
                                    <div class="cc-selector p-2 text-center">
                                        <input class="allProvincial form-control" id="p${res[i].Provincial[0].id}" type="number" name="provincial[]" value="${res[i].Provincial[0].votos_provincia}" min="0" required />
                                    </div>
                                    <div class="d-flex flex-column justify-content-center mt-1" >
                                        <label for="p${res[i].Provincial[0].id}"><h6 class="mb-0" style="font-size:10px;cursor:pointer;">${res[i].Provincial[0].nombreCorto}</h6></label>
                                    </div>
                                </div>`;
                        }

                        fila += `</td>
                                <td>`;
                        if (res[i].Distrital.length > 0) {
                            fila += `
                                <div class="px-2 py-1 mt-1 text-center">
                                    <div class="cc-selector p-2 text-center">
                                        <input class="allDistrital form-control" id="d${res[i].Distrital[0].id}" type="number" name="distrital[]" value="${res[i].Distrital[0].votos_distrito}" min="0" required />
                                    </div>
                                    <div class="d-flex flex-column justify-content-center mt-1" >
                                        <label for="d${res[i].Distrital[0].id}"><h6 class="mb-0" style="font-size:10px;cursor:pointer;">${res[i].Distrital[0].nombreCorto}</h6></label>
                                    </div>
                                </div>`;
                        }
                        fila += `</td>
                            </tr>
                        `;

                    }
                    $("#tbDataCandidatos").html(fila);
                    $("#modaluploadfiles").removeClass("d-none");

                    $("#modaluploadevidencias").removeClass("d-none");
                }
            });
        };
    </script>
@endsection
