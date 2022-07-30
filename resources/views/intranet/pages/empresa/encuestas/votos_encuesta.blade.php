@extends('intranet.layouts.layout')
@section('content')
    <div class="container-fluid py-4">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="mb-0">Listado de Votos </h5>
                                @if (Session('success'))
                                    <div class="alert alert-success  alert-dismissible fade show text-white"
                                        style="font-size: 14px;padding:8px;" role="alert">
                                        <b>{{ Session('success') }}</b>
                                        <button type="button" class="btn-close text-white" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (Session('fail'))
                                    <div class="alert alert-danger  alert-dismissible fade show text-white"
                                        style="font-size: 14px;padding:8px;" role="alert">
                                        <b>{{ Session('fail') }}</b>
                                        <button type="button" class="btn-close btn-sm text-white" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                            </div>
                            <div class="col-6" style="text-align: right">
                                <button type="button" class="btn btn-success" style="float: right" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">Nuevo</button>
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
                                    <th style="font-size: .65rem;">Encuesta</th>
                                    <th style="font-size: .65rem;">Partdido</th>
                                    <th style="font-size: .65rem;">Candidato</th>
                                    <th style="font-size: .65rem;">Región</th>
                                    <th style="font-size: .65rem;">Voto</th>
                                    <th style="font-size: .65rem;">Tipo de Encuesta</th>
                                    <th style="font-size: .65rem;">Fecha</th>
                                    <th style="font-size: .65rem;">Estado</th>
                                    <th style="font-size: .65rem;">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($votos as $voto)
                                    <tr style="font-size: 14px;color:black;">
                                        <td>{{ $voto->encuesta->idEncuesta }}</td>
                                        <td><span
                                                class="badge badge-md bg-gradient-success">{{ $voto->encuesta->nombreEncuesta }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ asset('img/logotipos/'.$voto->partido->logotipo)}}" class="avatar avatar-sm me-3"
                                                        alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $voto->partido->partido }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $voto->partido->observacion }}</p>
                                                </div>
                                            </div>                                            
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ asset('img/fotos/'.$voto->candidato->foto)}}" class="avatar avatar-sm me-3"
                                                        alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $voto->candidato->nombresApellidos }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $voto->candidato->observaciones }}</p>
                                                </div>
                                            </div>   
                                        </td>
                                        <td><span
                                            class="badge badge-md bg-gradient-secondary">{{ $voto->region }}</span></td>
                                        <td><span
                                            class="badge badge-md bg-gradient-dark">{{ $voto->votos }}</span></td>
                                        <td><span
                                            class="badge badge-md bg-gradient-primary">{{ $voto->tipoEncuesta }}</span></td>
                                        <td><span
                                            class="badge badge-md bg-gradient-info">{{ $voto->fecha }}</span></td>
                                        <td>
                                            @if ($voto->estado == 'Activo')
                                            <span
                                            class="badge badge-md bg-gradient-success">{{ $voto->estado }}</span>
                                            @else
                                            <span
                                            class="badge badge-md bg-gradient-danger">{{ $voto->estado }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center"> 

                                                <a href="#"
                                                    class="icon icon-shape icon-sm me-1 bg-gradient-primary shadow text-center"
                                                    style="cursor:pointer;" data-item="{{ $voto->encuesta->idEncuesta }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Grafico de Votos">
                                                    <i class="fas fa-chart-bar text-white opacity-10 "
                                                        style="cursor:pointer;"></i>
                                                </a>
                                            </div>
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
                <form action="{{ route('Encuesta.store') }}" method="post" id="forms" enctype="multipart/form-data"
                    class="needs-validation" novalidate>
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
@endsection

@section('script')
    <script src="{{ asset('admin/assets/js/plugins/multistep-form.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/datatables.js') }}"></script>

    <script>
        let dataTableSearch;
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
                            location.reload();
                        } else {
                            location.reload();
                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    })
            }
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
