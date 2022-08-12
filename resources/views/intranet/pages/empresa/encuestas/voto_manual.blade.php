@extends('intranet.layouts.layout')
@section('style')
    <style>
        .table td, .table th {
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
                                <h5 class="mb-0 text-white">Voto Manual</h5>
                            </div>
                            <div class="col-6" style="text-align: right">
                                <a href="{{ route('Votos.grafico',['encuesta'=>$encuesta->idEncuesta]) }}" class="btn bg-gradient-secondary mx-2" style="float: right">Ver Grafico</a>
                                <a href="{{ route('Encuesta') }}" class="btn btn-info" style="float: right">Volver</a>
                            </div>
                        </div>
                        <p class="text-sm mb-0">
                        </p>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-1 text-center">
                                <span class="text-danger text-center text-white bg-gradient-primary p-2" style="border-radius: 25px;">CODIGO DE DOCUMENTO</span>
                                <input type="text" class="form-control text-center text-md fw-bold" readonly name="codigo" value="{{ Str::upper(Str::random(8)); }}"></div>
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
                                <select name="distrito" id="distrito" class="form-control" required onchange="getZonas(0)">
                                    <option value="">-- Seleccione --</option>
                                </select>
                                <div class="invalid-feedback">Campo requerido*</div>
                            </div>

                            <div class="col-12 col-md-3 mb-3">
                                <label for="">Zona</label>
                                <select name="zona" id="zona" class="form-control" required
                                    onchange="getCandidatos()">
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
                    <form action="{{ route('Votos.store') }}" method="post" id="forms" class="needs-validation"
                        novalidate>
                        @csrf
                        <input type="hidden" name="idencuesta" value="{{ $encuesta->idEncuesta }}">                        
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
        })

        window.addEventListener('DOMContentLoaded', (event) => {
            // dataTableSearch = new simpleDatatables.DataTable("#tbData", {
            //     searchable: false,
            //     sortable: false,
            //     fixedHeight: true,
            //     responsive: true,
            // });

        });
        

        $(document).on('change', '.allRegional', (e) => {
            getDataVotos();
        });

        $(document).on('change', '.allProvincial', (e) => {
            getDataVotos();
        });

        $(document).on('change', '.allDistrital', (e) => {            
            getDataVotos();
        });

        const getDataVotos = () =>{

            dataVotos.votoReg = [];
            dataVotos.votoPro = [];
            dataVotos.votoDis = [];

            $(".allPartidos").each((key, el)=>{
                if(el.parentNode.parentNode.children[2].children[0]){  
                    const voto = parseInt(el.parentNode.parentNode.children[2].children[0].children[0].children[0].value)
                    dataVotos.votoReg.push( [el.value, voto]);           
                }else{
                    dataVotos.votoReg.push( [el.value, 0]);
                }

                if(el.parentNode.parentNode.children[3].children[0]){  
                    const voto = parseInt(el.parentNode.parentNode.children[3].children[0].children[0].children[0].value)
                    dataVotos.votoPro.push( [el.value, voto]);           
                }else{
                    dataVotos.votoPro.push( [el.value, 0]);
                }

                if(el.parentNode.parentNode.children[4].children[0]){  
                    const voto = parseInt(el.parentNode.parentNode.children[4].children[0].children[0].children[0].value)
                    dataVotos.votoDis.push( [el.value, voto]);           
                }else{
                    dataVotos.votoDis.push( [el.value, 0]);
                }
            });
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
                console.log(dataVotos);
                return false;
            }

            swalWithBootstrapButtons.fire({
                title: 'Estas por ingresar votos a la  Encuesta?',
                text: "Estas de acuerdo en guardar tus votos, Recuerda Anotar TU CODIGO DE DOCUMENTO ANTES DE GUARDAR LOS VOTOS: "+dataVotos.codigo,
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
                    $("#tbDataCandidatos").html('')
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
                    var fila = "<option value='' >-- Seleccione --</option>";
                    for (let i = 0; i < res.length; i++) {
                        fila += '<option value="' + res[i].id + '">' + res[i].zona + '</option>';

                    }
                    $("#zona option").remove();
                    $("#zona").append(fila);
                    $("#tbDataCandidatos").html('')
                }
            });
        };

        const getCandidatos = () => {

            if ($('#zona').val() === '') {
                $("#tbDataCandidatos").html('');
                return false;
            }

            let departamento = $('#departamento').val();
            let provincia = $('#provincia').val();
            let distrito = $('#distrito').val();
            $.ajax({
                url: "/" + departamento + "/" + provincia + "/" + distrito + "/Candidatos",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    var fila = "";
                    const url = "{{ asset('img/logotipos/') }}";
                    const urlCandidato = "{{ asset('img/fotos/') }}";
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
                                            <input class="allRegional form-control" id="r${res[i].Regional[0].id}" type="number" name="regional[]" value="0" min="0" required />
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
                                        <input class="allProvincial form-control" id="p${res[i].Provincial[0].id}" type="number" name="provincial[]" value="0" min="0" required />
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
                                        <input class="allDistrital form-control" id="d${res[i].Distrital[0].id}" type="number" name="distrital[]" value="0" min="0" required />
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
                }
            });
        };
    </script>
@endsection
