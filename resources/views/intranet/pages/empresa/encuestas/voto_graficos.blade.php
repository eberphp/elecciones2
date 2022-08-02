@extends('intranet.layouts.layout')
@section('style')
    <style>
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
                                <h5 class="mb-0 text-white">{{ $encuesta->nombreEncuesta }} - GRÁFICOS / Por Ubicación y
                                    Resultado Total</h5>
                            </div>
                            <div class="col-6" style="text-align: right">
                                <a href="{{ route('Encuesta') }}" class="btn btn-info" style="float: right">Volver</a>
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
                                            {{ $encuesta->fechaInicio }} al {{ $encuesta->fechaTermino }}
                                            <button id="publicacion"
                                                class="btn btn-sm bg-gradient-{{ $encuesta->publicacion == 'Si' ? 'success' : 'danger' }} mx-1">{{ $encuesta->publicacion == 'Si' ? 'Quitar Publicacion' : 'Publicar' }}</button>
                                        </span>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <select class="form-control" name="resultado" id="resultado">
                                            <option value="Total" selected>Resultado Total</option>
                                            <option value="Ubicacion">Por Ubicación</option>
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
                                                <li><a class="dropdown-item"
                                                        href="{{ route('Votos.encuestador', ['encuesta' => $encuesta->idEncuesta]) }}">
                                                        Voto Encuestador
                                                    </a></li>
                                                <li><a class="dropdown-item"
                                                        href="{{ route('Votos.manual', ['encuesta' => $encuesta->idEncuesta]) }}">
                                                        Voto Manual
                                                    </a></li>
                                            </ul>
                                        </div>

                                        <span class="d-block fw-bold alertVotoDis d-none" style="font-size: 12px;">Usted ya
                                            participó, espera la proxima apertura.</span>
                                    </div>

                                    <div class="col-12 text-center">

                                        <div class="dropdown mt-2">
                                            <button class="btn bg-gradient-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                Encuestas Anteriores
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                @foreach ($encuestas as $publicado)
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('Votos.grafico', ['encuesta' => $publicado->idEncuesta]) }}"><span
                                                                class="badge bg-gradient-primary">{{ $publicado->fechaTermino }}</span>
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
                                <span class="d-block fw-bold text-info" style="font-size: 14px;">Sumatoria por Tipo de
                                    Votos.</span>
                                <div>
                                    <div class="form-check form-switch d-flex justify-content-between mb-1">
                                        <input class="form-check-input" type="checkbox" onclick="getSumaVotos()"
                                            id="vdis" {{ $encuesta->dispositivo == 'Si' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="vdis">Por Dispositivo</label>
                                        <input type="number" readonly name="vdis"
                                            value="{{ $porDispositivo[0]['total'] }}"
                                            class="form-control form-control-sm mx-2 text-end" style="width: 100px;">
                                    </div>

                                    <div class="form-check form-switch d-flex justify-content-between mb-1">
                                        <input class="form-check-input" type="checkbox" onclick="getSumaVotos()"
                                            id="venc" {{ $encuesta->encuestador == 'Si' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="venc">Por Encuestador</label>
                                        <input type="number" readonly name="venc"
                                            value="{{ $porEncuestador[0]['total'] }}"
                                            class="form-control form-control-sm mx-2 text-end" style="width: 100px;">
                                    </div>

                                    <div class="form-check form-switch d-flex justify-content-between mb-1">
                                        <input class="form-check-input" type="checkbox" onclick="getSumaVotos()"
                                            id="vman" {{ $encuesta->manual == 'Si' ? 'checked' : '' }}>
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

                                </div>
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
                                    onchange="getZonas(0)">
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

            <div class="row mb-3 mt-3">
                <div class="col-12 col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="chart-departamento" class="chart-canvas" height="300px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="card mb-3">
                        <div class="card-body p-3">
                            <div class="chart">
                                <canvas id="chart-provincia" class="chart-canvas" height="300px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="card mb-3">
                        <div class="card-body p-3">
                            <div class="chart">
                                <canvas id="chart-distrito" class="chart-canvas" height="300px"></canvas>
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
@endsection

@section('script')
    <script src="{{ asset('admin/assets/js/plugins/multistep-form.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/datatables.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/sweetalert.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/chartjs.min.js') }}"></script>
    <script src="https://unpkg.com/chart.js-plugin-labels-dv@3.0.5/dist/chartjs-plugin-labels.min.js"></script>

    <script>
        let dataTableSearch;
        let dataVotos = {
            votoReg: [],
            votoPro: [],
            votoDis: [],
        };

        let sumaVotos = {};

        $("#publicacion").click((e) => {
            const encid = '{{ $encuesta->idEncuesta }}';
            if (encid === '') {
                Swal.fire({
                    icon: 'info',
                    title: 'Ooops...',
                    text: 'Recargue la pagina y intentente  Publicar.',
                })
                return false;
            }

            fetch('/Encuesta/' + encid + '/Publicacion', {
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
            const encid = '{{ $encuesta->idEncuesta }}';
            console.log(encid);
            if (encid === '') {
                Swal.fire({
                    icon: 'info',
                    title: 'Ooops...',
                    text: 'Recargue la pagina y intentente  Guardar.',
                })
                return false;
            }

            fetch('/Encuesta/' + encid + '/Sumatoria', {
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

            getZonas();
            getVotosDepartamento();
        })

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn bg-gradient-success',
                cancelButton: 'btn bg-gradient-danger'
            },
            buttonsStyling: false
        })

        window.addEventListener('DOMContentLoaded', (event) => {
            // dataTableSearch = new simpleDatatables.DataTable("#tbData", {
            //     searchable: false,
            //     sortable: false,
            //     fixedHeight: true,
            //     responsive: true,
            // });
            getSumaVotos();

            $("#departamento").val(1);
            getProvincias();

        });

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
                    getDistritos(res[0].id);
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
                    getZonas(res[0].id);
                    getVotosDepartamento();
                }
            });
        }

        const getZonas = (id) => {
            let departamento = $('#departamento').val();
            let provincia = $('#provincia').val();
            let distrito = $('#distrito').val();
            $.ajax({
                url: "/" + departamento + "/" + provincia + "/" + distrito + "/Zonas",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    var fila = "<option value='' selected>-- TODOS --</option>";
                    for (let i = 0; i < res.length; i++) {
                        fila += '<option value="' + res[i].id + '">' + res[i].zona + '</option>';

                    }
                    $("#zona option").remove();
                    $("#zona").append(fila);

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
            const futureDate = new Date('{{ $encuesta->fechaTermino }}').getTime();
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

        const getVotosDepartamento = () => {
            // if ($('#zona').val() === '') {
            //     $("#tbDataCandidatos").html('');
            //     return false;
            // }

            let departamento = $('#departamento').val();
            let provincia = $('#provincia').val();
            let distrito = $('#distrito').val();
            let zona = $('#zona').val();
            if (zona == '') {
                zona = 'Todos';
            }

            $.ajax({
                url: "/Votos/{{ $encuesta->idEncuesta }}/" + departamento + "/" + provincia + "/" + distrito +
                    "/" + zona +
                    "/Graficos/Total",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    setGraficos(res);
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

            res.forEach(el => {
                
                if (el.cReg.length > 0) {
                    let fd = (el.cReg[0].visualiza === 'Si') ? `{{ asset('img/fotos/') }}/`+el.cReg[0].foto : 'https://flyclipart.com/businessman-officeworker-user-icon-with-png-and-vector-format-user-icon-png-133444'
                    imgDep.push({
                        src: fd,
                        width: 16,
                        height: 16,
                        value: el.Regional[0].total
                    });
                }

                if (el.cPro.length > 0) {
                    let fd = (el.cPro[0].visualiza === 'Si') ? `{{ asset('img/fotos/') }}/`+el.cPro[0].foto : 'https://flyclipart.com/businessman-officeworker-user-icon-with-png-and-vector-format-user-icon-png-133444'
                    imgPro.push({
                        src: fd,
                        width: 16,
                        height: 16,
                        value: el.Provincial[0].total
                    });
                }

                if (el.cDis.length > 0) {
                    let fd = (el.cDis[0].visualiza === 'Si') ? `{{ asset('img/fotos/') }}/`+el.cDis[0].foto : 'https://flyclipart.com/businessman-officeworker-user-icon-with-png-and-vector-format-user-icon-png-133444'
                    imgDis.push({
                        src: fd,
                        width: 16,
                        height: 16,
                        value: el.Distrital[0].total
                    });
                }


                dataDep.push(parseInt(el.Regional[0].total));
                dataPro.push(parseInt(el.Provincial[0].total));
                dataDis.push(parseInt(el.Distrital[0].total));

                totalDep += parseInt(el.Regional[0].total);
                totalPro += parseInt(el.Provincial[0].total);
                totalDis += parseInt(el.Distrital[0].total);
            });

            res.forEach(el => {
                let porDep = ((parseInt(el.Regional[0].total) / totalDep) * 100).toFixed(2);
                if (isNaN(porDep)) {
                    porDep = 0;
                }
                labDep.push(porDep + '%');

                let porPro = ((parseInt(el.Provincial[0].total) / totalPro) * 100).toFixed(2);
                if (isNaN(porPro)) {
                    porPro = 0;
                }
                lebPro.push(porPro + '%');

                let porDis = ((parseInt(el.Distrital[0].total) / totalDis) * 100).toFixed(2);
                if (isNaN(porDis)) {
                    porDis = 0;
                }
                labDis.push(porDis + '%');
            });

            setGraDep(labDep.sort((a, b) => { if(a == b) { return 0; }  if(a > b) {  return -1;  }  return 1; }), dataDep.sort((a, b) => { if(a == b) { return 0; }  if(a > b) {  return -1;  }  return 1; }), imgDep.sort((a, b) => { return b.value - a.value; }), totalDep);
            setGraPro(lebPro.sort((a, b) => { if(a == b) { return 0; }  if(a > b) {  return -1;  }  return 1; }), dataPro.sort((a, b) => { if(a == b) { return 0; }  if(a > b) {  return -1;  }  return 1; }), imgPro.sort((a, b) => { return b.value - a.value; }), totalPro);
            setGraDis(labDis.sort((a, b) => { if(a == b) { return 0; }  if(a > b) {  return -1;  }  return 1; }), dataDis.sort((a, b) => { if(a == b) { return 0; }  if(a > b) {  return -1;  }  return 1; }), imgDis.sort((a, b) => { return b.value - a.value; }), totalDis);

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
                        fill: true,
                        maxBarThickness: 35,
                        display: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        labels: {
                            render: 'image',
                            images: images,
                        },
                        title: {
                            display: true,
                            padding: 20,
                            color: 'black',
                            text: 'Total de Votos Departamento: ' + total
                        },
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                padding: 10,
                                color: "#9ca2b7"
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: true,
                                drawTicks: true
                            },
                            ticks: {
                                display: true,
                                color: "#9ca2b7",
                                padding: 10
                            }
                        }
                    }
                }
            });

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
                        fill: true,
                        maxBarThickness: 35,
                        display: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        labels: {
                            render: 'image',
                            images: images,
                        },
                        title: {
                            display: true,
                            padding: 20,
                            color: 'black',
                            text: 'Total de Votos Provincia: ' + total
                        },
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                padding: 10,
                                color: "#9ca2b7"
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: true,
                                drawTicks: true
                            },
                            ticks: {
                                display: true,
                                color: "#9ca2b7",
                                padding: 10
                            }
                        }
                    }
                }
            });

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
                        fill: true,
                        maxBarThickness: 35,
                        display: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        labels: {
                            render: 'image',
                            images: images,
                        },
                        title: {
                            display: true,
                            padding: 20,
                            color: 'black',
                            text: 'Total de Votos Distrito: ' + total
                        },
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                padding: 10,
                                color: "#9ca2b7"
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: true,
                                drawTicks: true
                            },
                            ticks: {
                                display: true,
                                color: "#9ca2b7",
                                padding: 10
                            }
                        }
                    }
                }
            });

        }
    </script>
@endsection
