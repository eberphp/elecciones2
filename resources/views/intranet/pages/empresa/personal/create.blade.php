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
                <h5>Crear personal</h5>
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
                <form action="{{ route('personalweb.store') }}" id="createForm" method="post" enctype="multipart/form-data"
                    role="form">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Nombres</label>
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <input type="text" name="nombres" class="form-control" id="nombres_ic">
                                <div class="invalid-feedback" id="invalidNombresCreate">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Nombre Corto</label>
                                <input type="text" name="nombre_corto" class="form-control" id="nombre_corto_ic">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Telefono</label>
                                <input type="text" name="telefono" class="form-control" id="telefono_corto_ic">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Dni</label>
                                <input type="text" required name="dni" class="form-control" id="dni_ic">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Correo</label>
                                <input type="text" required name="correo" class="form-control" id="correo_ic">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Clave</label>
                                <input type="text" required name="clave" class="form-control" id="clave_ic">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Fecha ingreso</label>
                                <input type="date" name="fecha_ingreso" class="form-control" id="fecha_ingreso_ic">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Cargo</label>
                                <select name="cargo_id" class="form-control" id="cargo_id_ic">
                                    <option value="">---Seleccione---</option>
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
                                <select name="vinculo_id" class="form-control" id="vinculo_id_ic">

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
                                <select name="tipo_usuarios_id" class="form-control" id="tipo_usuarios_id_ic">
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
                                <select name="tipo_ubigeo" class="form-control" id="tipo_ubigeo_ic">
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
                                <label class="form-label">Funcion</label>
                                <select name="funcion_id" class="form-control" id="funcion_id_ic">
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
                                <label class="form-label">Puesto</label>
                                <select name="puesto_id" class="form-control" id="puesto_id_ic">
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
                                <label class="form-label">Estado</label>
                                <select name="estado" class="form-control" id="estado_ic">
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
                                <select name="departamento" class="form-control" id="departamento">
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
                                <select name="provincia" class="form-control" id="provincia">
                                    <option value=""> -- Seleccione -- </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Distrito</label>
                                <select name="distrito" class="form-control" id="distrito">
                                    <option value=""> -- Seleccione -- </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Foto</label>
                                <input type="file" name="foto" class="form-control" id="foto_ic">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Cv</label>
                                <input type="file" name="cv" class="form-control" id="cv_ic">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Url facebook</label>
                                <input type="text" name="url_facebook" class="form-control" id="url_facebook_ic">

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Url 1</label>
                                <input type="text" name="url_1" class="form-control" id="url_1_ic">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Url 2</label>
                                <input type="text" name="url_2" class="form-control" id="url_2_ic">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">PPD</label>
                                <input type="text" name="ppd" class="form-control" id="ppd_ic">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">
                                    Referencias
                                </label>
                                <textarea class="form-control ckeditor" name="referencias" id="referencias_ic"></textarea>


                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">
                                    Perfil
                                </label>
                                <textarea class="form-control ckeditor" name="perfil" id="perfil_ic"></textarea>


                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">
                                    Evaluacion
                                </label>
                                <textarea class="form-control ckeditor" name="evaluacion" id="evaluacion_ic"></textarea>


                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">
                                    Observaciones
                                </label>
                                <textarea class="form-control ckeditor" name="observaciones" id="observaciones_ic"></textarea>


                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">
                                    Sugerencias
                                </label>
                                <textarea class="form-control ckeditor" name="sugerencias" id="sugerencias_ic"></textarea>
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
        });
    </script>
@endsection
