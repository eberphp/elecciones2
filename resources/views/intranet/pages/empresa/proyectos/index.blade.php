@extends('intranet.layouts.layout')
@section('style')
<style>    
    
    .bg-gradient-info {
        border-radius: inherit;
    }

    .bg-gradient-danger{
        border-radius: inherit;
    }

    .bg-gradient-warning{
        border-radius: inherit;
    }

    .bg-gradient-success{
        border-radius: inherit;
    }

    .bg-gradient-primary{
        border-radius: inherit;
    }

    .bg-gradient-secondary{
        border-radius: inherit;
    }
</style>
@endsection
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            {{-- ENCABEZADO --}}
            <div class="col-12">
                <div class="card shadow-lg mb-3">
                    <div class="card-body bg-gradient-info">
                        <div class="row">
                            <div class="col-12 col-md-10 mb-3 mb-md-0">
                                <h5 class="mb-0 text-white text-uppercase fw-bold text-center text-md-start">Ejecución de Proyectos</h5>
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
                        <div class="table-responsive">
                            <table class="table table-flush" id="tbData">
                                <thead class="thead-light">
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>% Avance</th>
                                        <th>D.V</th>
                                        <th>F. Inicio</th>
                                        <th>Dias</th>
                                        <th>AJ/P</th>
                                        <th>Encargado</th>
                                        <th>Responsable</th>
                                        <th>Costo</th>
                                        <th>Observaciones</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proyectos as $proyecto)
                                        <tr style="font-size: 14px;color:black;">
                                            <td>
                                                <div class="d-flex align-items-center">    
                                                    <div class="icon icon-shape icon-sm me-1 bg-gradient-info rounded-circle shadow text-center btnEditar"
                                                        style="cursor:pointer;" data-item="{{ $proyecto->idProyecto }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Editar">
                                                        <i class="fas fa-pencil-alt text-white opacity-10 "
                                                            style="cursor:pointer;"></i>
                                                    </div> 
                                                
                                                    <div class="icon icon-shape icon-sm me-1 bg-gradient-danger rounded-circle shadow text-center btnEliminar"
                                                        style="cursor:pointer;" data-item="{{ $proyecto->idProyecto }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar">
                                                        <i class="far fa-trash-alt text-white opacity-10 "
                                                            style="cursor:pointer;"></i>
                                                    </div>

                                                    <div class="icon icon-shape icon-sm me-1 bg-gradient-primary rounded-circle shadow text-center btnEntregables"
                                                        style="cursor:pointer;" data-item="{{ $proyecto->idProyecto }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Ver Entregables">
                                                        <i class="far fa-eye text-white opacity-10 "
                                                            style="cursor:pointer;"></i>
                                                    </div>

                                                    <div class="icon icon-shape icon-sm me-1 bg-gradient-success rounded-circle shadow text-center btnIniciar"
                                                        style="cursor:pointer;" data-item="{{ $proyecto->idProyecto }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Iniciar Proyecto">
                                                        <i class="fas fa-play-circle text-white opacity-10 "
                                                            style="cursor:pointer;"></i>
                                                    </div>
    
    
                                                    {{-- <a href="{{ route('Votos.grafico', ['encuesta' => $proyecto->idEncuesta]) }}"
                                                        class="icon icon-shape icon-sm me-1 bg-gradient-primary shadow text-center"
                                                        style="cursor:pointer;" data-item="{{ $proyecto->idEncuesta }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Grafico de Votos">
                                                        <i class="fas fa-chart-bar text-white opacity-10 "
                                                            style="cursor:pointer;"></i>
                                                    </a> --}}
                                                </div>
                                            </td>
                                            <td>{{ $proyecto->idProyecto}}</td>
                                            <td>{{ $proyecto->nombre }}</td>
                                            <td><span class="badge badge-md rounded bg-gradient-info">0 % E</span></td>
                                            <td><span class="badge badge-md rounded bg-gradient-success">5 Diás</span></td>
                                            <td><span class="badge badge-md rounded bg-gradient-success">{{ \Carbon\Carbon::parse($proyecto->fechaInicio)->format('d-m-Y H:i:s') }}</span></td>
                                            <td><span class="badge badge-md rounded bg-gradient-dark">{{ \Carbon\Carbon::parse($proyecto->plazo)->format('d-m-Y H:i:s')  ?? '---' }}</span></td>
                                            <td><span class="badge badge-md rounded bg-gradient-dark">0 E</span></td>
                                            <td><span class="badge badge-md rounded bg-gradient-secondary">{{ $proyecto->encargados->email }}</span></td>
                                            <td><span class="badge badge-md rounded bg-gradient-secondary">{{ $proyecto->responsables->email }}</span></td>
                                            <td><span class="badge badge-md rounded bg-gradient-dark">0.00</span></td>                                            
                                            <td>{{ $proyecto->observaciones }}</td>                                            
                                            <td>
                                                @if ($proyecto->estado == 'Activo')
                                                    <span
                                                        class="badge badge-md rounded bg-gradient-success">{{ $proyecto->estado }}</span>
                                                @else
                                                    <span
                                                        class="badge badge-md rounded bg-gradient-danger">{{ $proyecto->estado }}</span>
                                                @endif
                                            </td>
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal Crear-->
    <div class="modal fade" id="exampleModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Crear Proyecto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('Proyecto.store') }}" method="post" id="forms"
                    enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    <input type="hidden" name="idproyecto">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="">Nombre Proyecto</label>
                                <input type="text" name="nombre" required placeholder="Nombre Encuesta"
                                    class="form-control">
                                <div class="invalid-feedback">Campo requerido*</div>
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label for="">Fecha Inicio</label>
                                <input type="datetime-local" name="inicio" class="form-control datepicker">
                                <div class="invalid-feedback">Campo requerido*</div>
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label for="">Diás</label>
                                <input type="datetime-local" name="dias" required class="form-control">
                                <div class="invalid-feedback">Campo requerido*</div>
                            </div>

                            <div class="col-12 col-md-12 mb-3">
                                <label for="">Responsable</label>
                                <select name="responsable" class="form-control" required>
                                    <option value="" selected>-- Seleccione --</option>
                                    @foreach ($responsables as $responsable )
                                       <option value="{{ $responsable->id }}">{{ $responsable->email }}</option> 
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label for="">Costo</label>
                                <input type="number" any name="costo" class="form-control">
                                <div class="invalid-feedback">Campo requerido*</div>
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label for="">Estado</label>
                                <select name="estado" class="form-control" required>
                                    <option value="" selected>-- Seleccione --</option>
                                    @foreach ($estados as $estado )
                                        <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="">Observación</label>
                                <textarea type="text" name="observacion" placeholder="observacion" class="form-control"></textarea>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary rounded" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn bg-gradient-primary rounded" id="btnSubmit">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="position-fixed top-0 start-50 translate-middle-x z-index-2">

        @if (Session('success'))
            <div class="toast fade p-2 mt-2 bg-gradient-success rounded show" role="alert" aria-live="polite" id="infoToast"
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
            <div class="toast fade p-2 mt-2 bg-gradient-danger rouended show" role="alert" aria-live="polite" id="dangerToas"
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

        function copiarAlPortapapeles(id_elemento) {
            var aux = document.createElement("input");
            aux.setAttribute("value", document.getElementById(id_elemento).dataset.url);
            document.body.appendChild(aux);
            aux.select();
            document.execCommand("copy");
            document.body.removeChild(aux);
            Swal.fire({
                icon: 'success',
                title: 'Felicidades',
                text: 'Se copio Correctamente el enlace para poder publicarlo',
            })
        }

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn bg-gradient-success',
                cancelButton: 'btn bg-gradient-danger'
            },
            buttonsStyling: false
        })

        window.addEventListener('DOMContentLoaded', (event) => {
            dataTableSearch = new simpleDatatables.DataTable("#tbData", {
                searchable: true,
                fixedHeight: true,
                responsive: true,
            });

            (function() {
                'use strict'

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.querySelectorAll('.needs-validation')

                // Loop over them and prevent submission
                Array.prototype.slice.call(forms)
                    .forEach(function(form) {
                        form.addEventListener('submit', function(event) {
                            if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                            }

                            form.classList.add('was-validated')
                        }, false)
                    })
            })();

            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })

        });

        $(document).on('click', '.btnEditar', (e) => {
            const ids = e.currentTarget.dataset.item
            if (ids !== '') {
                fetch('/Proyecto/' + ids + '/show', {
                        credentials: 'include',
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then((response) => {
                        if (response.status) {

                            $("#exampleModalLabel")[0].parentNode.classList.remove('bg-success');
                            $("#exampleModalLabel")[0].parentNode.classList.add('bg-info');
                            $("#exampleModalLabel").text('Editar Proyecto');

                            $("#btnSubmit").text('Actualizar');

                            $("#forms")[0].attributes[0].value = '/Proyecto/' + response.data.idProyecto +
                                '/update';
                            $("#forms")[0].attributes[1].value = 'POST';

                            $("#forms input[name=idproyecto]").val(response.data.idProyecto);
                            $("#forms input[name=nombre]").val(response.data.nombre);
                            $("#forms input[name=inicio]").val(response.data.date);
                            $("#forms input[name=dias]").val(response.data.plazoDias);
                            $("#forms select[name=responsable]").val(response.data.responsable);
                            $("#forms input[name=costo]").val(response.data.costo);
                            $("#forms select[name=estado]").val(response.data.estadoActivida);
                            $("#forms textarea[name=observacion]").val(response.data.observaciones);

                            $("#exampleModal").modal('show');
                        } else {

                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    })
            }
        });

        $(document).on('click', '.btnEliminar', (e) => {

            swalWithBootstrapButtons.fire({
                title: 'Estas por Eliminar un Proyecto?',
                text: "Estas de acuerdo en borrar este Proyecto",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, Eliminar',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {

                    const ids = e.currentTarget.dataset.item
                    if (ids !== '') {
                        fetch('/Proyecto/' + ids + '/destroy', {
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
                                    location.reload();
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

        $('#exampleModal').on('hidden.bs.modal', function(e) {
            $("#exampleModalLabel")[0].parentNode.classList.remove('bg-info');
            $("#exampleModalLabel")[0].parentNode.classList.add('bg-success');
            $("#exampleModalLabel").text('Crear Proyecto');

            $("#btnSubmit").text('Crear');

            $("#forms")[0].classList.remove('was-validated');
            $("#forms")[0].reset();
            $('#forms').trigger("reset");

            $("#forms")[0].attributes[0].value = '/Proyecto';
            $("#forms")[0].attributes[1].value = 'POST';
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
