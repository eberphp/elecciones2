@extends('intranet.layouts.layout')
@section('style')
    <style>
        .c-p {
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid py-4">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header my-2">
                                    <h5 class="modal-title" id="newModalLabel">Crear</h5>

                                    <span aria-hidden="true" class="close c-p close-modall" data-dismiss="modal"
                                        aria-label="Close">&times;</span>

                                </div>
                                <div class="modal-body">
                                    <form action="/api/area" id="createForm">
                                        <div class="form-group">
                                            <label class="form-label">Nombre</label>
                                            <input type="text" name="nombre" class="form-control" id="nombre_ic">
                                            <div class="invalid-feedback" id="invalidNombreCreate">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Color</label>
                                            <input type="color" name="color" id="color_ic">
                                            <div class="invalid-feedback" id="invalidColorCreate">
                                            </div>
                                        </div>
                                        <div class="w-100 d-flex justify-content-end">
                                            <button class="btn btn-primary" type="submit">Guardar</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="newModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="newModalLabel">Editar</h5>
                                    <span aria-hidden="true" class="close c-p close-modall" data-dismiss="modal"
                                        aria-label="Close">&times;</span>
                                </div>
                                <div class="modal-body">
                                    <form action="" id="editForm">
                                        <div class="form-group">
                                            <label class="form-label">Nombre</label>
                                            <input type="hidden" id="id_ie" name="id">
                                            <input type="text" name="nombre" class="form-control" id="nombre_ie">
                                            <div class="invalid-feedback" id="invalidNombreEdit">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Color</label>
                                            <input type="color" name="color" id="color_ie">
                                            <div class="invalid-feedback" id="invalidColorEdit">
                                            </div>
                                        </div>
                                        <div class="w-100 d-flex justify-content-end">
                                            <button class="btn btn-primary" type="submit">Guardar</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Locales de votación</h5>
                            </div>

                        </div>

                        <table class="table table-flush" id="datatable">
                            <thead>
                                <tr style="text-transform: uppercase !important">
                                    <th>Id</th>
                                    <th>Departamento</th>
                                    <th>Provincia</th>
                                    <th>Distrito</th>
                                    <th>Nombre local</th>
                                    <th>Numero de mesa</th>
                                    {{-- <th>Accion</th> --}}
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@section('script')
    <script src="{{ asset('admin/assets/js/plugins/xlsx.full.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/sweetalert.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/tableexport.min.js') }}"></script>
    <script>
        var customtable = null;
        var datos = [];
        $(document).ready(function() {



            //fin crear usuario
            customtable = $("#datatable").DataTable({

                "serverSide": true,
                "ajax": {
                    "url": "/api/locales_votacion/pagination",
                    "type": "POST",
                    "dataSrc": function(data) {
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
                        data: "departamento",
                        name: "departamento",
                        
                    },
                    {
                        data: "provincia",
                        name: "provincia",
                        
                    },
                    {
                        data: "distrito",
                        name: "distrito",
                        
                    },
                    {
                        data: "nom_local",
                        name: "nom_local",
                        
                    },
                    {
                        data: "num_mesa",
                        name: "num_mesa",
                        
                    }
                ],
                "processing": true,
                "pagingType": "numbers",
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
                }
            });
            $('#datatable thead tr').clone(true).appendTo('#datatable thead');

            $('#datatable thead tr:eq(1) th').each(function(i) {

                $(this).html('<input type="text" class="form-control form-control-sm mx-0" placeholder="buscar" />');

                $('input', this).on('keyup change', function() {
                    if (customtable.column(i).search() !== this.value) {
                        customtable
                            .column(i)
                            .search(this.value)
                            .draw();
                    }
                });
            });
            $("#exportToExcel").on("click", function() {
                if (typeof XLSX == 'undefined') XLSX = require('xlsx');
                var ws = XLSX.utils.table_to_sheet(document.getElementById('datatable'));
                var wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, "SheetJS");
                XLSX.writeFile(wb, "reporte.xlsx");
            });
        });

        const handleEdit = function(ev) {
            const id = $(ev).attr("objectid");
            const item = datos.find((item) => item.id == id);
            if (item) {
                $("#nombre_ie").val(item.nombre);
                $("#id_ie").val(item.id);
                $("#color_ie").val(item.color);
                $("#editModal").modal("show");
            }
        };
        const handleDelete = function(ev) {
            var confirmDelete = confirm("¿Esta seguro de eliminar?");
            if (confirmDelete) {
                $.ajax({
                    url: `/api/area/${$(ev).attr("objectid")}`,
                    type: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function(data) {
                        if (data.success) {
                            customtable.ajax.reload();
                            Swal.fire("", data.message, "success");

                        } else {
                            Swal.fire("", "No se a podido dar de baja", "error");
                        }
                    },
                    error: function(data) {
                        Swal.fire("", "Intentelo mas tarde", "error");
                    },
                });
            }
        };
    </script>
@endsection
