@extends('intranet.layouts.layout')
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
    <div class="container-fluid py-4">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <!-- Card header -->

                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="mb-0">Listado de  Encuestas</h5>
                            </div>
                            <div class="col-6" style="text-align: right">
                            </div>
                        </div>
                        <p class="text-sm mb-0">
                        </p>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-flush" id="tbData">
                            <thead class="thead-light">
                                <tr>
                                    <th style="font-size: .65rem;">IdEncuesta</th>
                                    <th style="font-size: .65rem;">Nombre Encuesta</th>
                                    <th style="font-size: .65rem;">Fecha Inicio</th>
                                    <th style="font-size: .65rem;">Fecha Termino</th>
                                    <th style="font-size: .65rem;">Observador</th>
                                    <th style="font-size: .65rem;">Encuesta Manual</th>
                                    <th style="font-size: .65rem;">Estado</th>
                                    <th style="font-size: .65rem;">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($encuestas as $encuesta)
                                    <tr style="font-size: 14px;color:black;">
                                        <td>{{ $encuesta->idEncuesta }}</td>
                                        <td>{{ $encuesta->nombreEncuesta }}</td>
                                        <td><span
                                                class="badge badge-md bg-gradient-success">{{ $encuesta->fechaInicio }}</span>
                                        </td>
                                        <td><span
                                                class="badge badge-md bg-gradient-dark">{{ $encuesta->fechaTermino }}</span>
                                        </td>
                                        <td>{{ $encuesta->observaciones }}</td>
                                        <td>
                                            @if ($encuesta->encuestaManual == 'Si')
                                                <span
                                                    class="badge badge-md bg-gradient-success">{{ $encuesta->encuestaManual }}</span>
                                            @else
                                                <span
                                                    class="badge badge-md bg-gradient-danger">{{ $encuesta->encuestaManual }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($encuesta->estado == 'Activo')
                                                <span
                                                    class="badge badge-md bg-gradient-success">{{ $encuesta->estado }}</span>
                                            @else
                                                <span
                                                    class="badge badge-md bg-gradient-danger">{{ $encuesta->estado }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">


                                                @if (date('Y-m-d') <= $encuesta->fechaTermino)
                                                    <a href="{{ route('Votos.encuestador', ['encuesta' => $encuesta->idEncuesta]) }}"
                                                        class="icon icon-shape icon-sm me-1 bg-gradient-dark shadow text-center"
                                                        style="cursor:pointer;" data-item="{{ $encuesta->idEncuesta }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Votos Encuestador">
                                                        <i class="fas fa-vote-yea text-white opacity-10 "
                                                            style="cursor:pointer;"></i>
                                                    </a>
                                                @endif
                                                @if (in_array('Grafico', $permisos))
                                                <a href="{{ route('Votos.grafico', ['encuesta' => $encuesta->idEncuesta]) }}"
                                                    class="icon icon-shape icon-sm me-1 bg-gradient-primary shadow text-center"
                                                    style="cursor:pointer;" data-item="{{ $encuesta->idEncuesta }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Grafico de Votos">
                                                    <i class="fas fa-chart-bar text-white opacity-10 "
                                                        style="cursor:pointer;"></i>
                                                </a>
                                                @endif

                                            </div>
                                        </td>
                                        <td>

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
    <!-- Modal Crear-->
    <div class="modal fade" id="exampleModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Crear Encuesta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('Encuesta.store') }}" method="post" id="forms"
                    enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    <input type="hidden" name="idencuesta">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="">Nombre Encuesta</label>
                                <input type="text" name="nombre" required placeholder="Nombre Encuesta"
                                    class="form-control">
                                <div class="invalid-feedback">Campo requerido*</div>
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label for="">Fecha Inicio</label>
                                <input type="date" name="inicio" required class="form-control datepicker">
                                <div class="invalid-feedback">Campo requerido*</div>
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label for="">Fecha Termino</label>
                                <input type="date" name="termino" required class="form-control">
                                <div class="invalid-feedback">Campo requerido*</div>
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label for="">Encuesta Manual</label>
                                <select name="encuesta" class="form-control" required>
                                    <option value="No" selected>No</option>
                                    <option value="Si">Si</option>
                                </select>
                            </div>

                            <div class="col-12 col-md-6 mb-3">
                                <label for="">Estado</label>
                                <select name="estado" class="form-control" required>
                                    <option value="Activo" selected>Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="">Observación</label>
                                <textarea type="text" name="observacion" placeholder="observacion" class="form-control"></textarea>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn bg-gradient-primary" id="btnSubmit">Crear</button>
                    </div>
                </form>
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
                fetch('/Encuesta/' + ids + '/show', {
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
                            $("#exampleModalLabel").text('Editar Encuesta');

                            $("#btnSubmit").text('Actualizar');

                            $("#forms")[0].attributes[0].value = '/Encuesta/' + response.data.idEncuesta +
                                '/update';
                            $("#forms")[0].attributes[1].value = 'POST';

                            $("#forms input[name=idencuesta]").val(response.data.idEncuesta);
                            $("#forms input[name=nombre]").val(response.data.nombreEncuesta);
                            $("#forms input[name=inicio]").val(response.data.fechaInicio);
                            $("#forms input[name=termino]").val(response.data.fechaTermino);
                            $("#forms select[name=encuesta]").val(response.data.encuestaManual);
                            $("#forms select[name=estado]").val(response.data.estado);
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
                title: 'Estas por Eliminar una Encuesta?',
                text: "Estas de acuerdo en borrar esta Encuesta",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, Eliminar',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {

                    const ids = e.currentTarget.dataset.item
                    if (ids !== '') {
                        fetch('/Encuesta/' + ids + '/destroy', {
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
            $("#exampleModalLabel").text('Crear Encuesta');

            $("#btnSubmit").text('Crear');

            $("#forms")[0].classList.remove('was-validated');
            $("#forms")[0].reset();
            $('#forms').trigger("reset");

            $("#forms")[0].attributes[0].value = '/Encuesta';
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
