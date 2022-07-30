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
                                <div class="modal-header">
                                    <h5 class="modal-title" id="newModalLabel">Crear</h5>

                                    <span aria-hidden="true" class="close c-p close-modall" data-dismiss="modal"
                                        aria-label="Close">&times;</span>

                                </div>
                                <div class="modal-body">
                                    <form action="/api/usuarioResponsable" id="createForm">
                                        <div class="form-group">
                                            <label class="form-label">Nombre</label>
                                            <input type="text" name="nombre" class="form-control" id="nombre_ic">
                                            <div class="invalid-feedback" id="invalidNombreCreate">
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
                                <h5>Usuario responsable</h5>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end my-2">
                                <button class="btn btn-primary btn-sm mx-2" id="crear"><i class="fa fa-plus-circle"></i>
                                    Crear</button>
                                <button class="btn btn-success btn-sm" id="exportToExcel"><i class="fa fa-file-excel"></i>
                                    Excel</button>
                            </div>
                        </div>
                        <table class="table table-flush" id="datatable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Id</th>
                                    <th>Nombre</th>
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
            $("#crear").on("click", function() {
                $("#newModal").modal("show");
            })
            $(".close-modall").on("click", function() {
                $("#newModal").modal("hide");
                $("#editModal").modal("hide");
            })
            //validaciones
            $("#nombre_ic").on("keyup", function(e) {
                let value = e.target.value;
                if (!value) {
                    $("#nombre_ic").addClass("is-invalid");
                    $("#invalidNombreCreate").html("El tipo es requerido");
                } else {
                    $("#nombre_ic").removeClass("is-invalid");
                    $("#invalidNombreCreate").html("");
                }
            });
            $("#nombre_ie").on("keyup", function(e) {
                let value = e.target.value;
                if (!value) {
                    $("#nombre_ie").addClass("is-invalid");
                    $("#invalidNombreEdit").html("El tipo es requerido");
                } else {
                    $("#nombre_ie").removeClass("is-invalid");
                    $("#invalidNombreEdit").html("");
                }
            });
           
            const validateFormNew = (data) => {

                if (data.nombre) {
                    return true;
                }
                return false;
            };
            const validateFormEdit = (data) => {
                if (data.nombre) {
                    return true;
                }
                return false;
            };
            //crear usuario
            $("#createForm").on("submit", function(e) {
                objtValues = {};
                e.preventDefault();
                let data = $(this).serializeArray();
                data.forEach(function(item) {
                    objtValues[item.name] = item.value;
                });
                if (validateFormNew(objtValues)) {
                    $.ajax({
                        url: $("#createForm").attr("action"),
                        type: "POST",
                        data: objtValues,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        success: function(data) {
                            if (data.success) {
                                Swal.fire("", "Se a creado correctamente", "success");
                                $("#createForm")[0].reset();
                                customtable.ajax.reload();
                                $("#newModal").modal("hide");
                            } else {
                                Swal.fire("", "Error al crear", "error");
                            }
                        },
                        error: function(data) {
                            Swal.fire("", "Intentelo mas tarde", "error");
                        },
                    });
                } else {
                    Swal.fire("", "Complete correctamente el formulario?", "success");
                }
            });
            $("#editForm").on("submit", function(e) {
                e.preventDefault();
                let data = $(this).serializeArray();
                var objtValues = {};
                data.forEach(function(item) {
                    objtValues[item.name] = item.value;
                });
                if (validateFormEdit(objtValues)) {
                    $.ajax({
                        url: `/api/usuarioResponsable/${objtValues.id}`,
                        type: "PUT",
                        data: objtValues,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        success: function(data) {
                            if (data.success) {
                                customtable.ajax.reload();
                                $("#editModal").modal("hide");
                                Swal.fire("", data.message, "success");
                            } else {
                                Swal.fire("", "No se a podido actualizar", "error");
                            }
                        },
                        error: function(data) {
                            Swal.fire("", "Intentelo mas tarde", "error");
                        },
                    });
                }
            });
            //fin crear usuario
            customtable = $("#datatable").DataTable({
                
                "serverSide": true,
                "ajax": {
                    "url": "/api/usuarioResponsable/pagination",
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
                        render: function(data) {
                            return ` <i class="fa fa-edit c-p" objectid="${data}" onclick="handleEdit(this)"></i><i class="fa fa-trash c-p text-danger mx-2" onclick="handleDelete(this)" objectid="${data}"></i>`
                        }
                    },
                    {
                        data: "id",
                        name: "id",
                    },
                    {
                        data: "nombre",
                        name: "nombre",
                    }
                ]
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
                $("#editModal").modal("show");
            }
        };
        const handleDelete = function(ev) {
            var confirmDelete = confirm("¿Esta seguro de eliminar?");
            if (confirmDelete) {
                $.ajax({
                    url: `/api/usuarioResponsable/${$(ev).attr("objectid")}`,
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
