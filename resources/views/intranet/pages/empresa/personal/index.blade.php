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
                    <!-- Roles: Ricardo Bejar -->
                    <div class="modal fade" id="evaluacionModal" tabindex="-1" role="dialog"
                        aria-labelledby="evaluacionModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="evaluacionModalLabel">evaluacion</h5>
                                    <span aria-hidden="true" class="close c-p close-modall" data-dismiss="modal"
                                        aria-label="Close">&times;</span>
                                </div>
                                <div class="modal-body" id="evaluacionvalue">

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="rolesModal" tabindex="-1" role="dialog" aria-labelledby="rolesModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="rolesModalLabel">Asignación de roles</h5>
                                    <span aria-hidden="true" class="close c-p close-modall" data-dismiss="modal"
                                        aria-label="Close">&times;</span>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="../api/personal/asignarRoles" role="form"
                                        id="frm-permisos">
                                        @csrf
                                        <input type="hidden" id="personal_id" value="{{ old('personal_id') }}">
                                        <div class="row">
                                            @inject('roles', 'App\Services\Permisos')
                                            @foreach ($roles->get() as $index => $rol)
                                                @if ($rol['nivel'] == 1)
                                                    @if ($rol['grupo'] > 1)
                                        </div>
                                        @endif
                                        <div class="col-md-4 chk-item chk-{{ $rol['grupo'] }}">
                                            <div class="col-md-12"><input type="checkbox" name="{{ $index }}"
                                                    id="chk-{{ $rol['grupo'] }}"
                                                    class="chk-all"><label>&nbsp;{{ $rol['nombre'] }}</label></div>
                                        @elseif ($rol['nivel'] == 2 && $rol['hijos'] == 0)
                                            <div class="col-md-12"><input type="checkbox" name="{{ $index }}"
                                                    id="chk-{{ $rol['grupo'] }}-{{ $rol['idx'] }}"
                                                    onclick="verifyChecks({{ $rol['grupo'] }})">&nbsp;&nbsp;{{ $rol['nombre'] }}
                                            </div>
                                        @elseif ($rol['nivel'] == 2 && $rol['hijos'] > 0)
                                            <div class="col-md-12"><input type="checkbox" name="{{ $index }}"
                                                    id="chk-{{ $rol['grupo'] }}-{{ $rol['idx'] }}"
                                                    onclick="verifyChecksAll({{ $rol['grupo'] }},{{ $rol['idx'] }},{{ $rol['hijos'] }})">&nbsp;&nbsp;{{ $rol['nombre'] }}
                                            </div>
                                        @else
                                            <div class="col-md-12"><input type="checkbox" name="{{ $index }}"
                                                    id="chk-{{ $rol['grupo'] }}-{{ $rol['idx'] }}-{{ $rol['sub'] }}"
                                                    onclick="verifyChecksItem({{ $rol['grupo'] }},{{ $rol['idx'] }})">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $rol['nombre'] }}
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                </div>
                                <hr>
                                <div class="w-100 d-flex justify-content-end">
                                    <button class="btn btn-primary" type="submit">Guardar</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Roles: Fin -->
                <div class="modal fade" id="imagenModal" tabindex="-1" role="dialog" aria-labelledby="imagenModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="imagenModalLabel">Imagen</h5>
                                <span aria-hidden="true" class="close c-p close-modall" data-dismiss="modal"
                                    aria-label="Close">&times;</span>
                            </div>
                            <div class="modal-body">
                                <form id="imagenForm">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form action="">
                                                <div class="form-group">
                                                    <label class="form-label">Imagen</label>
                                                    <input type="file" name="imagen" class="form-control"
                                                        id="imagen_ie">
                                                    <input type="hidden" name="id" id="id_ie">
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-primary btn-sm" type="submit">Guardar</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-6">
                                            <img src="" id="perfilImagen" style="width: 100px;height:100px"
                                                alt="">
                                        </div>

                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal fade" id="cvModal" tabindex="-1" role="dialog" aria-labelledby="cvModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="cvModalLabel">Cv</h5>
                                <span aria-hidden="true" class="close c-p close-modall" data-dismiss="modal"
                                    aria-label="Close">&times;</span>
                            </div>
                            <div class="modal-body">
                                <form id="cvForm">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form action="">
                                                <div class="form-group">
                                                    <label class="form-label">Cv</label>
                                                    <input type="file" name="cv" class="form-control"
                                                        id="cv_ie">
                                                    <input type="hidden" name="id" id="id_ie">
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-primary btn-sm" type="submit">Guardar</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-12">
                                            <embed src="" id="cvPdf" alt="" width="400px"
                                                height="500px" type="application/pdf" />
                                        </div>

                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal fade" id="PPDModal" tabindex="-1" role="dialog" aria-labelledby="PPDModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="PPDModalLabel">Cv</h5>
                                <span aria-hidden="true" class="close c-p close-modall" data-dismiss="modal"
                                    aria-label="Close">&times;</span>
                            </div>
                            <div class="modal-body" id="PPDvalue">

                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal fade" id="perfilModal" tabindex="-1" role="dialog"
                    aria-labelledby="perfilModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="perfilModalLabel">Perfil</h5>
                                <span aria-hidden="true" class="close c-p close-modall" data-dismiss="modal"
                                    aria-label="Close">&times;</span>
                            </div>
                            <div class="modal-body" id="perfilvalue">

                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal fade" id="evaluacionModal" tabindex="-1" role="dialog"
                    aria-labelledby="evaluacionModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="evaluacionModalLabel">evaluacion</h5>
                                <span aria-hidden="true" class="close c-p close-modall" data-dismiss="modal"
                                    aria-label="Close">&times;</span>
                            </div>
                            <div class="modal-body" id="evaluacionvalue">

                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Personal</h5>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end my-2">
                            <input type="hidden" name="route_create" id="route_create"
                                value="{{ route('personalweb.create') }}">

                            <button class="btn btn-primary btn-sm mx-2" id="crear"><i class="fa fa-plus-circle"></i>

                                Crear</button>
                            <button class="btn btn-success btn-sm" id="exportToExcel"><i class="fa fa-file-excel"></i>
                                Excel</button>
                        </div>
                    </div>

                    <form action="" class="d-flex">
                        <input type="text" name="buscador" class="form-control">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </form>

                    <table class="table table-flush" id="datatable">

                        <thead>
                            <tr>
                                <th>Accion</th>
                                <th> id</th>
                                <th> Nombres y Apellidos</th>
                                <th> PPD</th>
                                <th> Perfil</th>
                                <th> Foto</th>
                                <th> Cv</th>
                                <th>Evaluacion</th>
                                <th> URL_facebook</th>
                                <th> URL_1</th>
                                <th> URL_1</th>
                                <th>Función</th>
                                <th> Nombre Corto</th>
                                <th> Telefono</th>
                                <th> Referencias</th>
                                <th> Estado</th>
                                <th>Vinculo</th>
                                <th> Dni</th>
                                <th> Clave</th>
                                <th> Fec.Ingreso</th>
                                <th> Correo</th>
                                <th> Sugerencias</th>
                                <th>Tipo de Usuario</th>
                                <th> Asignar Usuarios</th>
                                <th> Observaciones</th>
                                <th> Tipo Ubigeo</th>
                                <th> Roles</th>
                                <th> Departamento</th>
                                <th> Provincia</th>
                                <th> Distrito</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($personal as $item)
                                <tr>
                                    <td><i class="fa fa-edit c-p" objectid="{{ $item->id }}"
                                            onclick="handleEdit(this)"></i><i class="fa fa-trash c-p text-danger mx-2"
                                            objectid="{{ $item->id }}" onclick="handleDelete(this)"></i>
                                    </td>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->nombres }} </td>
                                    <td>{{ $item->ppd }}</td>
                                    <td><span objectid="{{ $item->id }}" onclick="handleViewProfile(this)"
                                            class="btn btn-primary btn-sm">Perfil</span></td>
                                    <td><span objectid="{{ $item->id }}" onclick="handleEditImagen(this)"
                                            class="btn btn-primary btn-sm">Foto</span></td>
                                    <td><span objectid="{{ $item->id }}" onclick="handleEditCv(this)"
                                            class="btn btn-primary btn-sm">CV</span></td>
                                    <td><span objectid="{{ $item->id }}" onclick="handleViewEvaluacion(this)"
                                            class="btn btn-primary btn-sm">Evaluacion</span></td>
                                    <td>{{ $item->url_facebook }}</td>
                                    <td>{{ $item->url_1 }}</td>
                                    <td>{{ $item->url_2 }}</td>
                                    <td>{{ $item->funcion ? $item->funcion->nombre : '-' }}</td>
                                    <td>{{ $item->nombreCorto ? $item->nombreCorto : '-' }}</td>
                                    <td>{{ $item->telefono ? $item->telefono : '-' }}</td>
                                    <td>{{ $item->referencias ? $item->referencias : '-' }}</td>
                                    <td>{{ $item->estado ? $item->estado->name : '-' }}</td>
                                    <td>{{ $item->vinculo ? $item->vinculo->name : '-' }}</td>
                                    <td>{{ $item->dni ? $item->dni : '-' }}</td>
                                    <td>{{ $item->clave ? $item->clave : '-' }}</td>
                                    <td>{{ $item->fec_ingreso ? $item->fec_ingreso : '-' }}</td>
                                    <td>{{ $item->correo ? $item->correo : '-' }}</td>
                                    <td>{{ $item->sugerencias ? $item->sugerencias : '-' }}</td>
                                    <td>{{ $item->tipo_usuario ? $item->nivel : '-' }}</td>
                                    <td>{{ $item->asignar_usuarios }}</td>
                                    <td>{{ $item->observaciones ? $item->observaciones : '-' }}</td>
                                    <td>{{ $item->tipo_ubigeo ? $item->tipo_ubigeo->nombre : '-' }}</td>
                                    <td><span objectid="{{ $item->id }}" onclick="handleRoles(this)"
                                            class="btn btn-primary btn-sm">Asignar roles</span> </td>
                                    <td>{{ $item->departamentos ? $item->departamentos->departamento : '-' }}</td>
                                    <td>{{ $item->provincias ? $item->provincias->provincia : '-' }}</td>
                                    <td>{{ $item->distritos ? $item->distritos->distrito : '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex w-100 justify-content-end">

                        {{ $personal->onEachSide(5)->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
    <!-- Roles: Ricardo Bejar -->
    <link rel="stylesheet" href="{{ asset('permisos/permisos.css') }}">
    <script src="{{ asset('permisos/permisos.js') }}"></script>
    <!-- Roles: Fin -->
    <script src="//cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>
    <script src="{{ asset('admin/assets/js/plugins/xlsx.full.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/moment.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/sweetalert.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/tableexport.min.js') }}"></script>
    <script>
        var customtable = null;
        var datos = [];
        $(document).ready(function() {
            $("#crear").on("click", function() {
                window.location.href = "{{ route('personalweb.create') }}";
            })
            $(".close-modall").on("click", function() {
                $("#newModal").modal("hide");
                $("#editModal").modal("hide");
                $("#cvModal").modal("hide");
                $("#imagenModal").modal("hide");
                $("#evaluacionModal").modal("hide");
                $("#perfilModal").modal("hide");
                $("#rolesModal").modal("hide");
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
            $("#departamento").on("change", function(e) {
                let value = e.target.value;
                $("#distrito").empty();
                $("#provincia").empty();
                $("#provincia").append("<option value=''>--Seleccione--</option>");
                $("#distrito").append("<option value=''>--Seleccione--</option>");
                if (value) {
                    const getProvincias = async (departamento) => {
                        const res = await fetch(`/api/provincias/${departamento}`);
                        const data = await res.json();
                        if (data) {
                            $("#provincia").empty();
                            let content = "";
                            data.forEach((data) => {
                                content +=
                                    `<option value="${data.id}">${data.provincia}</option>`
                            })
                            $("#provincia").append("<option value=''>--Seleccione--</option>");
                            $("#provincia").append(content);
                        }
                    }
                    getProvincias(value);
                }
            })
            $("#provincia").on("change", function(e) {
                let value = e.target.value;
                $("#distrito").empty();
                $("#distrito").html("<option value=''>--Seleccione--</option>");
                if (value) {

                    const getDistritos = async (departamento, provincia) => {
                        const res = await fetch(`/api/distritos/${departamento}/${provincia}`);
                        const data = await res.json();
                        if (data) {
                            $("#distrito").empty();
                            let content = "";
                            data.forEach((data) => {
                                content +=
                                    `<option value="${data.id}">${data.distrito}</option>`
                            })
                            $("#distrito").append("<option value=''>--Seleccione--</option>");
                            $("#distrito").append(content);
                        }
                    }

                    getDistritos($("#departamento").val(), value);
                }
            })
            $("#departamento_ie").on("change", function(e) {
                let value = e.target.value;
                $("#distrito_ie").empty();
                $("#provincia_ie").empty();
                $("#provincia_ie").append("<option value=''>--Seleccione--</option>");
                $("#distrito_ie").append("<option value=''>--Seleccione--</option>");
                if (value) {
                    const getProvincias = async (departamento_ie) => {
                        const res = await fetch(`/api/provincias/${departamento_ie}`);
                        const data = await res.json();
                        if (data) {
                            $("#provincia_ie").empty();
                            let content = "";
                            data.forEach((data) => {
                                content +=
                                    `<option value="${data.id}">${data.provincia}</option>`
                            })
                            $("#provincia_ie").append("<option value=''>--Seleccione--</option>");
                            $("#provincia_ie").append(content);
                        }
                    }
                    getProvincias(value);
                }
            })
            $("#provincia_ie").on("change", function(e) {
                let value = e.target.value;
                $("#distrito_ie").empty();
                $("#distrito_ie").html("<option value=''>--Seleccione--</option>");
                if (value) {
                    const getDistritos = async (departamento_ie, provincia) => {
                        const res = await fetch(`/api/distritos/${departamento_ie}/${provincia}`);
                        const data = await res.json();
                        if (data) {
                            $("#distrito_ie").empty();
                            let content = "";
                            data.forEach((data) => {
                                content +=
                                    `<option value="${data.id}">${data.distrito}</option>`
                            })
                            $("#distrito_ie").append("<option value=''>--Seleccione--</option>");
                            $("#distrito_ie").append(content);
                        }
                    }

                    getDistritos($("#departamento_ie").val(), value);
                }
            })

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

                if (data.dni && data.clave && data.correo) {
                    return true;
                }
                return false;
            };
            const validateFormEdit = (data) => {

                console.log(data);
                if (data.dni && data.clave && data.correo) {
                    return true;
                }
                return false;

            };
            $("#imagenForm").on("submit", async function(e) {
                e.preventDefault();
                const formData = new FormData()
                formData.append('image', $('#imagen_ie')[0].files[0]);
                formData.append('id', $("#id_ie").val());
                const resp = await fetch(`/api/personal/image`, {
                    method: 'post',
                    body: formData
                })
                const data = await resp.json()
                if (data.success) {
                    $("#imagenModal").modal("hide");
                    customtable.ajax.reload();
                    return true;
                }
                return false;
            })
            $("#cvForm").on("submit", async function(e) {
                e.preventDefault();
                const formData = new FormData()
                formData.append('cv', $("#cv_ie")[0].files[0]);
                formData.append('id', $("#id_ie").val());
                const resp = await fetch(`/api/personal/cv`, {
                    method: 'post',
                    body: formData
                })
                const data = await resp.json()
                if (data.success) {
                    $("#cvModal").modal("hide");
                    customtable.ajax.reload();
                    return true;
                }
                return false;
            })
            //crear usuario
            $("#createForm").on("submit", function(e) {
                objtValues = {};
                e.preventDefault();
                let data = $(this).serializeArray();
                console.log(data);
                data.forEach(function(item) {

                    objtValues[item.name] = item.value;

                });
                const formData = new FormData();
                let documents = true;
                if ($("#foto_ic")[0].files[0]) {
                    formData.append('foto', $("#foto_ic")[0].files[0]);
                }
                if ($("#cv_ic")[0].files[0]) {
                    formData.append('cv', $("#cv_ic")[0].files[0]);
                }
                if (validateFormNew(objtValues)) {
                    Object.keys(objtValues).forEach(function(key) {
                        formData.append(key, objtValues[key]);
                    });
                    formData.append('perfil', CKEDITOR.instances['perfil_ic'].getData());
                    formData.append('evaluacion', CKEDITOR.instances['evaluacion_ic'].getData());
                    formData.append('observaciones', CKEDITOR.instances['observaciones_ic'].getData());
                    formData.append('sugerencias', CKEDITOR.instances['sugerencias_ic'].getData());
                    $.ajax({
                        url: $("#createForm").attr("action"),
                        type: "POST",
                        contentType: false,
                        processData: false,
                        data: formData,
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
                                Swal.fire("", data.message, "error");
                            }
                        },
                        error: function(data) {
                            Swal.fire("", data.message, "error");
                        },
                    });
                } else {
                    Swal.fire("", "Complete correctamente el formulario?", "info");
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
                    objtValues['perfil'] = CKEDITOR.instances['perfil_ie'].getData();
                    objtValues['evaluacion'] = CKEDITOR.instances['evaluacion_ie'].getData();
                    objtValues['observaciones'] = CKEDITOR.instances['observaciones_ie'].getData();
                    objtValues['sugerencias'] = CKEDITOR.instances['sugerencias_ie'].getData();
                    console.log(objtValues);
                    $.ajax({
                        url: `/api/personal/${objtValues.id}`,
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
                                Swal.fire("", data.message, "error");
                            }
                        },
                        error: function(data) {
                            Swal.fire("", data.message, "error");
                        },
                    });
                }
            });
            //fin crear usuario

            $("#exportToExcel").on("click", function() {
                if (typeof XLSX == 'undefined') XLSX = require('xlsx');
                var ws = XLSX.utils.table_to_sheet(document.getElementById('datatable'));
                var wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, "SheetJS");
                XLSX.writeFile(wb, "reporte.xlsx");
            });
        });
        const handleEditCv = function(e) {
            let id = $(e).attr("objectid");
            let object = datos.find(x => x.id == id);
            $("#id_ie").val(id);
            $("#cvPdf").attr("src", `/storage/${object.cv}`);
            $("#cvModal").modal("show");
        }
        const handleEditImagen = function(e) {
            let id = $(e).attr("objectid");
            console.log(id);
            let object = datos.find(x => x.id == id);
            $("#id_ie").val(id);
            $("#perfilImagen").attr("src", `/storage/${object.foto}`);
            $("#imagenModal").modal("show");
        }
        const handleViewProfile = function(e) {
            let id = $(e).attr("objectid");
            let object = datos.find(x => x.id == id);
            if (object.perfil) {
                let parser = new DOMParser();
                let doc = parser.parseFromString(object.perfil, 'text/html');
                let html = doc.body.firstChild.data;
                $("#perfilvalue").html(html);
            } else {
                $("#perfilvalue").html("");
            }
            $("#perfilModal").modal("show");

        }
        const handleViewEvaluacion = function(e) {
            let id = $(e).attr("objectid");
            let object = datos.find(x => x.id == id);
            console.log(object);
            $("#id_ie").val(id);
            if (object.evaluacion) {
                let parser = new DOMParser();
                let doc = parser.parseFromString(object.evaluacion, 'text/html');
                let html = doc.body.firstChild.data;
                $("#evaluacionvalue").html(html);
            } else {
                $("#evaluacionvalue").html("");
            }
            $("#evaluacionModal").modal("show");
        }
        const handleEdit = function(ev) {
            const id = $(ev).attr("objectid");
            console.log(id);
            location.href = "/personal/" + id + "/edit"
        };
        const handleDelete = function(ev) {
            var confirmDelete = confirm("¿Esta seguro de eliminar?");
            if (confirmDelete) {
                $.ajax({
                    url: `/api/personal/${$(ev).attr("objectid")}`,
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
