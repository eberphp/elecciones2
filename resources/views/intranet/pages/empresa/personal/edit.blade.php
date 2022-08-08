@extends('intranet.layouts.layout')
@section('style')
    <style>
        .c-p {
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('personalweb.update', $personal->id) }}" method="post">
                    @csrf
                    @method('put')
                    <h5>Crear personal</h5>
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Nombres</label>
                                <input type="hidden" name="id" class="form-control" id="id_ie">
                                <input type="text" name="nombres" class="form-control" id="nombres_ie">
                                <div class="invalid-feedback" id="invalidNombresCreate">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Nombre Corto</label>
                                <input type="text" name="nombre_corto" class="form-control" id="nombreCorto_ie">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Telefono</label>
                                <input type="text" name="telefono" class="form-control" id="telefono_ie">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Dni</label>
                                <input type="text" required name="dni" class="form-control" id="dni_ie">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Correo</label>
                                <input type="text" required name="correo" class="form-control" id="correo_ie">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Clave</label>
                                <input type="text" required name="clave" class="form-control" id="clave_ie">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Fecha ingreso</label>
                                <input type="date" name="fecha_ingreso" class="form-control" id="fecha_ingreso_ie">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Cargo</label>
                                <select name="cargo_id" class="form-control" id="cargo_id_ie">

                                    <option value=""> -- Seleccione -- </option>
                                    @foreach ($cargos as $cargo)
                                        <option value="{{ $cargo->id }}">{{ $cargo->nombre }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Vinculo</label>
                                <select name="vinculo_id" class="form-control" id="vinculo_id_ie">

                                    <option value=""> -- Seleccione -- </option>
                                    @foreach ($vinculos as $vinculo)
                                        <option value="{{ $vinculo->id }}">{{ $vinculo->nombre }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Tipo de usuario</label>
                                <select name="tipo_usuarios_id" class="form-control" id="tipo_usuarios_id_ie">
                                    <option value=""> -- Seleccione -- </option>
                                    @foreach ($tipoUsuarios as $tipoUsuario)
                                        <option value="{{ $tipoUsuario->id }}">
                                            {{ $tipoUsuario->nivel }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Tipo ubigeo</label>
                                <select name="tipo_ubigeo" class="form-control" id="tipo_ubigeo_ie">
                                    <option value=""> -- Seleccione -- </option>
                                    @foreach ($tipoUbigeos as $tipoUbigeo)
                                        <option value="{{ $tipoUbigeo->id }}">
                                            {{ $tipoUbigeo->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Puesto</label>
                                <select name="puesto_id" class="form-control" id="puesto_id_ie">
                                    <option value=""> -- Seleccione -- </option>
                                    @foreach ($puestos as $puesto)
                                        <option value="{{ $puesto->id }}">{{ $puesto->nombre }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Funcion</label>
                                <select name="funcion_id" class="form-control" id="funcion_id_ie">
                                    <option value=""> -- Seleccione -- </option>
                                    @foreach ($funciones as $funcion)
                                        <option value="{{ $funcion->id }}">
                                            {{ $funcion->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Estado</label>
                                <select name="estado" class="form-control" id="estado_ie">
                                    <option value=""> -- Seleccione -- </option>
                                    @foreach ($estadoEvaluaciones as $estado)
                                        <option value="{{ $estado->id }}">
                                            {{ $estado->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Departamento</label>
                                <select name="departamento" class="form-control" id="departamento_ie">
                                    <option value=""> -- Seleccione -- </option>
                                    @foreach ($departamentos as $departamento)
                                        <option value="{{ $departamento->id }}">
                                            {{ $departamento->departamento }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Provincia</label>
                                <select name="provincia" class="form-control" id="provincia_ie">
                                    <option value=""> -- Seleccione -- </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Distrito</label>
                                <select name="distrito" class="form-control" id="distrito_ie">
                                    <option value=""> -- Seleccione -- </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Url facebook</label>
                                <input type="text" name="url_facebook" class="form-control" id="url_facebook_ie">

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Url 1</label>
                                <input type="text" name="url_1" class="form-control" id="url_1_ie">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Url 2</label>
                                <input type="text" name="url_2" class="form-control" id="url_2_ie">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">PPD</label>
                                <input type="text" name="ppd" class="form-control" id="ppd_ie">

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">
                                    Referencias
                                </label>
                                <textarea class="form-control" name="referencias" id="referencias_ie"></textarea>


                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">
                                    Perfil
                                </label>
                                <textarea class="form-control ckeditor" name="perfil" id="perfil_ie"></textarea>


                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">
                                    Evaluacion
                                </label>
                                <textarea class="form-control ckeditor" name="evaluacion" id="evaluacion_ie"></textarea>


                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">
                                    Observaciones
                                </label>
                                <textarea class="form-control ckeditor" name="observaciones" id="observaciones_ie"></textarea>


                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">
                                    Sugerencias
                                </label>
                                <textarea class="form-control ckeditor" name="sugerencias" id="sugerencias_ie"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Guardar</button>
                    </div>
                </form>
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
                $("#newModal").modal("show");
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
            customtable = $("#datatable").DataTable({

                "serverSide": true,
                "ajax": {
                    "url": "/api/personal/pagination",
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
                        data: "id"
                    },
                    {
                        data: "nombres",
                        render: function(data) {
                            return data ? data : "";
                        }
                    },
                    {
                        data: "ppd",
                        render: function(data) {
                            return data ? data : "";
                        }
                    },
                    {
                        data: "perfil",
                        render: function(data, row, type) {
                            return `<span objectid="${type.id}"  onclick="handleViewProfile(this)" class="btn btn-primary btn-sm" >Perfil</span>`;
                        }

                    },
                    {
                        data: "foto",
                        render: function(data, row, type) {
                            return `<span objectid="${type.id}"  onclick="handleEditImagen(this)" class="btn btn-primary btn-sm" >Foto</span>`;
                        }
                    },
                    {
                        data: "cv",
                        render: function(data, row, type) {
                            return `<span objectid="${type.id}"  onclick="handleEditCv(this)" class="btn btn-primary btn-sm" >CV</span>`;
                        }
                    },
                    {
                        data: "evaluacion",
                        render: function(data, row, type) {
                            return `<span objectid="${type.id}"  onclick="handleViewEvaluacion(this)" class="btn btn-primary btn-sm" >Evaluacion</span>`;
                        }
                    },
                    {
                        data: "url_facebook",
                        render: function(data) {
                            return `<a href="${data}" target="_blank">${data}</a>`
                        }
                    },
                    {
                        data: "url_1",
                        render: function(data) {

                            return `<a href="${data}" target="_blank">${data}</a>`
                        }
                    },
                    {
                        data: "url_2",
                        render: function(data) {

                            return `<a href="${data}" target="_blank">${data}</a>`
                        }
                    },
                    {
                        data: "funcion.nombre",
                        render: function(data) {
                            return data ? data : "";
                        }
                    },
                    {
                        data: "nombreCorto",
                        render: function(data) {
                            return data ? data : "";
                        }
                    },
                    {
                        data: "telefono",
                        render: function(data) {
                            return data ? data : "";
                        }
                    },
                    {
                        data: "referencias",
                        render: function(data) {
                            if (data) {
                                let parser = new DOMParser();
                                let doc = parser.parseFromString(data, 'text/html');
                                let html = doc.body.firstChild.data;
                                return html;
                            }
                            return "";
                        }
                    },
                    {
                        data: "estado",
                        render: function(data) {
                            return data ? data : "";
                        }
                    },
                    {
                        data: "vinculo.nombre",
                        render: function(data) {
                            return data ? data : "";
                        }
                    },
                    {
                        data: "dni",
                        render: function(data) {
                            return data ? data : "";
                        }
                    },

                    {
                        data: "clave",
                        render: function(data) {
                            return data ? data : "";
                        }
                    },
                    {
                        data: "fecha_ingreso",
                        render: function(data) {

                            return data ? moment(data).format('DD/MM/YY') : moment().format(
                                'DD/MM/YY');
                        }
                    },
                    {
                        data: "correo",
                        render: function(data) {
                            return data ? data : "";
                        }
                    },
                    {
                        data: "sugerencias",
                        render: function(data) {
                            console.log(data);
                            let html = "";
                            if (data) {
                                let parser = new DOMParser();
                                let doc = parser.parseFromString(data, 'text/html');
                                html = doc.body.firstChild.data;
                            } else {
                                html = "";
                            }
                            console.log(html);
                            return `${html}`;
                        }
                    },
                    {
                        data: "tipo_usuario.nivel",
                        render: function(data) {
                            return data ? data : "";
                        }
                    },
                    {
                        data: "asignar_usuarios",
                        render: function(data) {
                            return data ? data : "";
                        }
                    },
                    {
                        data: "observaciones",
                        render: function(data) {
                            console.log(data);
                            let html = "";
                            if (data) {
                                let parser = new DOMParser();
                                let doc = parser.parseFromString(data, 'text/html');
                                html = doc.body.firstChild.data;
                            } else {
                                html = "";
                            }
                            console.log(html);
                            return `${html}`;
                        }
                    },
                    {
                        data: "tipos_ubigeo.nombre",
                        render: function(data) {
                            return data ? data : "";
                        }
                    },
                    {
                        data: "roles",
                        render: function(data, row, type) {
                            return ``;
                        }
                    },
                    {
                        data: "departamento.departamento",
                        render: function(data) {
                            return data ? data : "";
                        }
                    },
                    {
                        data: "provincia.provincia",
                        render: function(data) {
                            return data ? data : "";
                        }
                    },
                    {
                        data: "distrito.distrito",
                        render: function(data) {
                            return data ? data : "";
                        }
                    },

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
            const item = datos.find((item) => item.id == id);
            if (item) {
                $("#nombres_ie").val(item.nombres);
                $("#id_ie").val(item.id);
                $("#cargo_id").val(item.cargo_id);
                $("#ppd_ie").val(item.ppd);
                $("#tipo_ubigeo_ie").val(item.tipo_ubigeo);
                let html1 = "";
                let html2 = "";
                let html3 = "";
                let html4 = "";

                let parser = new DOMParser();
                if (item.perfil) {
                    let doc = parser.parseFromString(item.perfil, 'text/html');
                    html = doc.body.firstChild.data;
                    CKEDITOR.instances['perfil_ie'].setData(html);
                }
                if (item.evaluacion) {
                    let doc2 = parser.parseFromString(item.evaluacion, 'text/html');
                    html2 = doc2.body.firstChild.data;

                    CKEDITOR.instances['evaluacion_ie'].setData(html2);
                }
                if (item.observaciones && item.sugerencias) {
                    let doc3 = parser.parseFromString(item.observaciones, 'text/html');
                    let doc4 = parser.parseFromString(item.sugerencias, 'text/html');
                    html3 = doc3.body.firstChild.data;
                    html4 = doc4.body.firstChild.data;

                    CKEDITOR.instances['observaciones_ie'].setData(html3);

                    CKEDITOR.instances['sugerencias_ie'].setData(html4);
                }
                $("#url_facebook_ie").val(item.url_facebook);
                $("#url_1_ie").val(item.url_1);
                $("#funcion_id_ie").val(item.funcion_id);
                $("#url_2_ie").val(item.url_2);
                $("#puesto_id_ie").val(item.puesto_id);
                $("#nombreCorto_ie").val(item.nombreCorto);
                $("#telefono_ie").val(item.telefono);
                $("#referencias_ie").val(item.referencias);
                $("#estado_ie").val(item.estado);
                $("#vinculo_id_ie").val(item.vinculo_id);
                $("#dni_ie").val(item.dni);
                $("#clave_ie").val(item.clave);
                let fecha_ingreso = moment(item.fecha_ingreso).format('DD/MM/YY');
                $("#fecha_ingreso_ie").val(fecha_ingreso);
                $("#correo_ie").val(item.correo);
                $("#tipo_usuarios_id_ie").val(item.tipo_usuarios_id);
                $("#tipo_ubigeo_id_ie").val(item.tipo_ubigeo_id);
                $("#departamento_ie").val(item.departamento);
                $("#provincia_ie").val(item.provincia);
                $("#distrito_ie").val(item.distrito);
                $("#cargo_id_ie").val(item.cargo_id);
                $("#editModal").modal("show");
            }
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
