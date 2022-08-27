@extends('layouts.appweb')

@section('content')
    

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card container mx-auto px-4">
                    <div class="card-body">
                        <form action="" class="card-body p-4" id="editForm">
                            <h1>Perfil</h1>
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">N° mesa</label>
                                        <input type="text" name="id" class="form-control" id="id_ie"
                                            value="{{ $personal->nro_mesa }}" readonly>
                                        <div class="invalid-feedback" id="invalidNombresCreate">
                                        </div>
                                    </div>
                                </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Nombres</label>
                                            <input type="hidden" name="id" class="form-control" id="id_ie"
                                                value="{{ $personal->id }}">
                                            <input type="text" value="{{ $personal->nombres }}" name="nombres"
                                                class="form-control" id="nombres_ie">
                                            <div class="invalid-feedback" id="invalidNombresCreate">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Nombre Corto</label>
                                            <input type="text" value="{{ $personal->nombreCorto }}" name="nombre_corto"
                                                class="form-control" id="nombreCorto_ie">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Telefono</label>
                                            <input type="text" name="telefono" value="{{ $personal->telefono }}"
                                                class="form-control" id="telefono_ie">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Dni</label>
                                            <input type="text" required name="dni" class="form-control"
                                                value="{{ $personal->dni }}" id="dni_ie">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Correo</label>
                                            <input type="text" name="correo" class="form-control" id="correo_ie"
                                                value="{{ $personal->correo }}">

                                        </div>
                                    </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Clave</label>
                                        <input type="text" required name="clave" class="form-control" id="clave_ie"
                                            value="{{ $personal->clave }}">
                                    </div>
                                </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Fecha ingreso</label>
                                            <input type="date" name="fecha_ingreso" class="form-control"
                                                value="{{ $personal->fecha_ingreso }}" id="fecha_ingreso_ie">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Departamento</label>
                                            <select name="departamento" class="form-control" id="departamento_ie"
                                                value="{{ $personal->departamento }}">
                                                <option value=""> -- Seleccione -- </option>
                                                @foreach ($departamentos as $departamento)
                                                    <option value="{{ $departamento->id }}" @if($departamento->id==$personal->departamento) selected="selected" @endif>
                                                        {{ $departamento->departamento }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Provincia</label>
                                            <select name="provincia" class="form-control" id="provincia_ie"
                                                value="{{ $personal->provincia }}">
                                                <option value=""> -- Seleccione -- </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Distrito</label>
                                            <select name="distrito" class="form-control" id="distrito_ie"
                                                value="{{ $personal->distrito }}">
                                                <option value=""> -- Seleccione -- </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Foto</label>
                                            <input type="file" name="foto" class="form-control" id="foto_ie">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Cv</label>
                                            <input type="file" name="cv" class="form-control" id="cv_ie">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Url facebook</label>
                                            <input type="text" name="url_facebook" class="form-control"
                                                id="url_facebook_ie" value="{{ $personal->url_facebook }}">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Url 1</label>
                                            <input type="text" name="url_1" class="form-control" id="url_1_ie"
                                                value="{{ $personal->url_1 }}">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Url 2</label>
                                            <input type="text" name="url_2" class="form-control" id="url_2_ie"
                                                value="{{ $personal->url_2 }}">

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">PPD</label>
                                            <input type="text" name="ppd" class="form-control" id="ppd_ie"
                                                value="{{ $personal->ppd }}">

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">
                                                Referencias
                                            </label>
                                            <textarea class="form-control ckeditor" name="referencias" id="referencias_ie">{{ $personal->referencias }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <label class="form-label">
                                                Perfil
                                            </label>
                                            <textarea class="form-control ckeditor" name="perfil" id="perfil_ie">{{ $personal->perfil }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">
                                                Evaluacion
                                            </label>
                                            <textarea class="form-control ckeditor" name="evaluacion" id="evaluacion_ie">{{ $personal->evaluacion }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">
                                                Observaciones
                                            </label>
                                            <textarea class="form-control ckeditor" name="observaciones" id="observaciones_ie">{{ $personal->observaciones }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">
                                                Sugerencias
                                            </label>
                                            <textarea class="form-control ckeditor" name="sugerencias" id="sugerencias_ie">{{ $personal->sugerencias }}</textarea>
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
        </div>
    </div>
    <input type="hidden" name="" id="departamentohidden" value="{{$personal->departamento}}">
    <input type="hidden" name="" id="provinciahidden" value="{{$personal->provincia}}"><input type="hidden" name="" id="distritohidden" value="{{$personal->distrito}}">
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
           let valordepartamento=$("#departamentohidden").val();
           console.log(valordepartamento);
            if (valordepartamento) {
                $("#distrito_ie").empty();
                $("#provincia_ie").empty();
                $("#provincia_ie").append("<option value=''>--Seleccione--</option>");
                $("#distrito_ie").append("<option value=''>--Seleccione--</option>");
                if (valordepartamento) {
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
                            if ($("#provinciahidden").val()) {

                                $("#provincia_ie").val($("#provinciahidden").val());
                            }
                        }
                    }
                    getProvincias(valordepartamento);
                }
            }
            let valorprovincia=$("#provinciahidden").val();
            if (valorprovincia) {
                $("#distrito_ie").empty();
                $("#distrito_ie").html("<option value=''>--Seleccione--</option>");
                if (valorprovincia) {
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
                            if ($("#distritohidden").val()) {
                                $("#distrito_ie").val($("#distritohidden").val());
                            }
                        }
                    }

                    getDistritos(valordepartamento, valorprovincia);
                }
            }
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
                    if ($("#perfil_ie")) {
                        objtValues['perfil'] = CKEDITOR.instances['perfil_ie'].getData();
                    }
                    if ($("#evaluacion_ie")) {
                        objtValues['evaluacion'] = CKEDITOR.instances['evaluacion_ie'].getData();
                    }
                    if ($("#observaciones_ie")) {
                        objtValues['observaciones'] = CKEDITOR.instances['observaciones_ie'].getData();
                    }
                    if ($("#referencias_ie")) {
                        objtValues['referencias'] = CKEDITOR.instances['referencias_ie'].getData();
                    }

                    console.log(objtValues);
                    const formData = new FormData();
                    let documents = true;
                    if ($("#foto_ie")) {
                        if ($("#foto_ie")[0].files[0]) {
                            formData.append('foto', $("#foto_ie")[0].files[0]);
                        }
                    }
                    if ($("#cv_ie")) {
                        if ($("#cv_ie")[0].files[0]) {
                            formData.append('cv', $("#cv_ie")[0].files[0]);
                        }
                    }
                    Object.keys(objtValues).forEach((e) => {
                        formData.append(e, objtValues[e]);
                    });
                    $.ajax({
                        url: `/auth/profile/${objtValues.id}`,
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        success: function(data) {
                            if (data.success) {
                                $("#editModal").modal("hide");
                                Swal.fire("", "Tus datos fueron actualizados correctamente",
                                    "success");
                                setTimeout(() => {
                                    location.reload();
                                }, 100);
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
