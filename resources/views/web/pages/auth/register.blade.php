@extends('layouts.appweb')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Registrarse</h1>
            </div>
            <div class="card-body">
                @if (Session::has('errors'))
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br />
                        @endforeach
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        <strong>Registro completado!</strong>
                        {{ Session::get('success') }}
                        <a href="/auth/login">Iniciar Sesión </a>
                    </div>
                @endif
                <form action="{{ route('web.register.post') }}" class="card-body p-4" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Nombres <span class="text-danger">*</span> </label>
                                <input type="hidden" name="id" class="form-control" id="id_ie">
                                <input type="text" required name="nombres" value="{{ old('nombres') }}"
                                    class="form-control" id="nombres_ie">
                                <div class="invalid-feedback" id="invalidNombresCreate">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Nombre Corto</label>
                                <input type="text" name="nombre_corto" value="{{ old('nombre_corto') }}"
                                    class="form-control" id="nombreCorto_ie">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Telefono</label>
                                <input type="text" name="telefono" value="{{ old('telefono') }}" class="form-control"
                                    id="telefono_ie">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Dni <span class="text-danger">*</span></label>
                                <input type="text" required name="dni" value="{{ old('dni') }}"
                                    class="form-control" id="dni_ie">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Correo <span class="text-danger">*</span> </label>
                                <input type="text" name="correo" required value="{{ old('correo') }}"
                                    class="form-control" id="correo_ie">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Clave <span class="text-danger">*</span></label>
                                <input type="text" required name="clave" value="{{ old('clave') }}"
                                    class="form-control" id="clave_ie">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Fecha ingreso</label>
                                <input type="date" name="fecha_ingreso" value="{{ old('fecha_ingreso') }}"
                                    class="form-control" id="fecha_ingreso_ie">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Tipo ubigeo</label>
                                <select name="tipo_ubigeo" value="{{ old('tipo_ubigeo') }}" class="form-control"
                                    id="tipo_ubigeo_ie">
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
                                <label class="form-label">Departamento</label>
                                <select name="departamento" value="{{ old('departamento') }}" class="form-control"
                                    id="departamento_ie">
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
                                <select name="provincia" value="{{ old('provincia') }}" class="form-control"
                                    id="provincia_ie">
                                    <option value=""> -- Seleccione -- </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Distrito</label>
                                <select name="distrito" value="{{ old('distrito') }}" class="form-control"
                                    id="distrito_ie">
                                    <option value=""> -- Seleccione -- </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Url facebook</label>
                                <input type="text" name="url_facebook" value="{{ old('url_facebook') }}"
                                    class="form-control" id="url_facebook_ie">

                            </div>
                        </div>



                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">
                                    Referencias
                                </label>
                                <textarea class="form-control" name="referencias" id="referencias_ie">{{ old('referencias') }}</textarea>


                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">
                                    Perfil
                                </label>
                                <textarea class="form-control ckeditor" name="perfil" id="perfil_ie">
@if (old('perfil'))
{{ old('perfil') }}
@else
<p>&nbsp;<strong>Nombre dos personas cercanas a nuestro partido politico que den referencia de usted (Incluir números de celular):</strong></p>

<ol>
	<li><strong>&nbsp;</strong></li>
	<li>&nbsp;</li>
</ol>
@endif
</textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">
                                    Observaciones
                                </label>
                                <textarea class="form-control ckeditor" name="observaciones" id="observaciones_ie">{{ old('observaciones') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">
                                    Sugerencias
                                </label>
                                <textarea class="form-control ckeditor" name="sugerencias" id="sugerencias_ie">{{ old('sugerencias') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 d-flex justify-content-end my-4">
                        <button class="btn btn-primary" type="submit">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="//cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>
    <script src="{{ asset('admin/assets/js/plugins/xlsx.full.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/moment.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/sweetalert.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/tableexport.min.js') }}"></script>
    <script>
        var customtable = null;
        var datos = [];
        $(document).ready(function() {
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
            const validateFormEdit = (data) => {

                console.log(data);
                if (data.dni && data.clave) {
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
                                Swal.fire("", "Error al crear", "error");
                            }
                        },
                        error: function(data) {
                            Swal.fire("", "Intentelo mas tarde", "error");
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


        });
    </script>
@endsection
