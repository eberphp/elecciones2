@extends('intranet.layouts.layout')
@section('content')
<?php $perfil = App\Models\Perfil::find(auth()->user()->perfil_id);
$usuario = Auth::user();
$personal = $usuario->personal;
$permisos = [];
if ($personal) {
    foreach ($personal->asignaciones as $asignacion) {
        if ($asignacion->permiso->grupo == 7) {
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
                            <div class="col-6 d-flex justify-content-end">
                                <button class="btn btn-success btn-sm" id="exportToExcel"> <i class="fa fa-file-pdf"></i>
                                    Exportar</button>
                            </div>

                        </div>
                        <p class="text-sm mb-0">
                        </p>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-flush" id="tbData">
                            <thead class="thead-light">
                                <tr style="text-transform: uppercase !important">
                                    <th style="font-size: .80rem;">Id</th>
                                    <th style="font-size: .80rem;">Elecciones</th>
                                    <th style="font-size: .80rem;">Partido</th>
                                    <th style="font-size: .80rem;">Local</th>

                                    <th style="font-size: .80rem;">Mesa</th>
                                    <th style="font-size: .80rem;">Departamento</th>
                                    <th style="font-size: .80rem;">Provincia</th>
                                    <th style="font-size: .80rem;">Distrito</th>
                                    <th style="font-size: .80rem;">Total votos</th>

                                    <th style="font-size: .80rem;">Fecha</th>
                                    <th style="font-size: .80rem;">Creado por</th>
                                    <th style="font-size: .80rem;">Actualizado por</th>
                                    <th style="font-size: .80rem;">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: .8em !important">

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
                <form action="{{ route('elecciones.store') }}" method="post" id="forms" enctype="multipart/form-data"
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

    @if (in_array('Locales de votación', $permisos))
        <input type="hidden" name="permiso_vergrafico" id="permiso_vergrafico" value="1234">
    @endif
@endsection

@section('script')
    <script src="{{ asset('admin/assets/js/plugins/xlsx.full.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/sweetalert.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/tableexport.min.js') }}"></script>
    <script>
        var customtable = null;
        var datos = [];
        $(document).ready(function() {

            customtable = $("#tbData").DataTable({

                "serverSide": true,
                "ajax": {
                    "url": "/api/votos_elecciones/pagination",
                    "type": "POST",
                    "dataSrc": function(data) {
                        console.log(data);
                        datos = data.data;
                        return data.data;
                    }
                },
                "columns": [{
                        data: "id",
                        name: "id",

                        className: 'dt-body-center'
                    },
                    {
                        data: "eleccion.nombre",
                        name: "eleccion.nombre",
                        render: function(data) {
                            return `${data}`;
                        }
                    }, {
                        data: "partido.partido",
                        name: "partido.partido",
                        render: function(data, type, row) {
                            return ` <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="/img/logotipos/${row.partido.logotipo}" class="avatar avatar-sm me-3"
                                                        alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">${data}</h6>
                                                    <p class="text-xs text-secondary mb-0">${row.partido.observacion?row.partido.observacion:"" }</p>
                                                </div>
                                            </div>  `;
                        }
                    },
                    {
                        data: "locales_votacion.nom_local",
                        name: "locales_votacion.nom_local",
                        render: function(data, type, row) {
                            return `${data}`;
                        },

                    },
                    {
                        data: "locales_votacion.num_mesa",
                        name: "locales_votacion.num_mesa",
                        render: function(data, type, row) {
                            return `${data}`;
                        },
                        className: 'dt-body-center dt-head-center'
                    }, {
                        data: "_departamento.departamento",
                        name: "_departamento.departamento",
                        render: function(data, type, row) {
                            return `${data} -  ${row.votos_departamento}`;
                        },
                        className: 'dt-head-center'

                    }, {
                        data: "_provincia.provincia",
                        name: "_provincia.provincia",
                        render: function(data, type, row) {
                            return `${data} -  ${row.votos_provincia} `;
                        },
                        className: 'dt-head-center'
                    },
                    {
                        data: "_distrito.distrito",
                        name: "_distrito.distrito",
                        render: function(data, type, row) {
                            return `${data} -  ${row.votos_distrito} `;
                        },
                        className: 'dt-head-center'
                    }, {
                        data: "votos",
                        name: "votos",
                        render: function(data) {
                            return `<span class="badge badge-md bg-gradient-success" style="min-width:140px">${data}</span>`;
                        },
                        className: 'dt-body-center'
                    },

                    {
                        data: "fecha",
                        name: "fecha",
                        render: function(data) {
                            return `${data}`;
                        },
                        className: 'dt-body-center'
                    },
                    {
                        data: "creador.email",
                        name: "creador.email",
                        render: function(data) {
                            return data ? data : '';
                        }
                    }, {
                        data: "editor.email",
                        name: "editor.email",
                        render: function(data) {
                            return data ? data : '';
                        }
                    },
                    {
                        data: "eleccion.id",
                        name: "eleccion.id",
                        render: function(data, type, row) {
                            let departamento = row.departamento;
                            let provincia = row.provincia;
                            let distrito = row.distrito;
                            let local = row.mesa_id;
                            let permiso = $("#permiso_vergrafico");
                            if (permiso) {
                                return `<div class="d-flex align-items-center"><a href="/elecciones_voto/${data}/Grafico?d=${departamento}&p=${provincia}&d=${distrito}&l=${local}" class="icon icon-shape icon-sm me-1 bg-gradient-primary shadow text-center"
                                        style="cursor:pointer;" data-item="${ data }" data-bs-toggle="tooltip" data-bs-placement="top" title="Grafico de Votos">
                                            <i class="fas fa-chart-bar text-white opacity-10 "
                                                style="cursor:pointer;"></i>
                                        </a>
                                    </div>`;
                            }
                            return "";
                        }
                    }
                ],
                "processing": true,
                "pagingType": "numbers",
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
                },
                "lengthMenu": [10, 50, 250, 500, 1000]
            });
            customtable.on('draw', function() {
                initTooltip();
            });
            const initTooltip = function() {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl)
                })
            }
            $("#exportToExcel").on("click", function() {
                if (typeof XLSX == 'undefined') XLSX = require('xlsx');
                var ws = XLSX.utils.table_to_sheet(document.getElementById('tbData'));
                var wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, "SheetJS");
                XLSX.writeFile(wb, "reporte.xlsx");
            });
            $('#tbData thead tr').clone(true).appendTo('#tbData thead');

            $('#tbData thead tr:eq(1) th').each(function(i) {
                if (i != 12 && i != 0 && i != 9) {
                    $(this).html(
                        '<input type="text" class="form-control form-control-sm mx-0" placeholder="buscar" />'
                    );

                    $('input', this).on('keyup change', function() {
                        if (customtable.column(i).search() !== this.value) {
                            customtable
                                .column(i)
                                .search(this.value)
                                .draw();
                        }
                    });
                } else if (i == 9) {
                    $(this).html(
                        '<input type="date" class="form-control form-control-sm mx-0" placeholder="buscar" />'
                    );

                    $('input', this).on('keyup change', function() {
                        if (customtable.column(i).search() !== this.value) {
                            customtable
                                .column(i)
                                .search(this.value)
                                .draw();
                        }
                    });
                } else {
                    $(this).html("");
                }
            });
        });
    </script>
@endsection
