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
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="newModalLabel">Crear</h5>

                                    <span aria-hidden="true" class="close c-p close-modall" data-dismiss="modal"
                                        aria-label="Close">&times;</span>

                                </div>

                                <div class="modal-body">
                                    <form action="/api/personal" id="createForm">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Nombres</label>
                                                    <input type="text" required name="nombres" class="form-control"
                                                        id="nombres_ic">
                                                    <div class="invalid-feedback" id="invalidNombresCreate">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Nombre Corto</label>
                                                    <input type="text" required name="nombre_corto" class="form-control"
                                                        id="nombre_corto_ic">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Telefono</label>
                                                    <input type="text" required name="telefono" class="form-control"
                                                        id="telefono_corto_ic">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Dni</label>
                                                    <input type="text" required name="dni" class="form-control"
                                                        id="dni_ic">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Correo</label>
                                                    <input type="text" required name="correo" class="form-control"
                                                        id="correo_ic">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Clave</label>
                                                    <input type="text" required name="clave" class="form-control"
                                                        id="clave_ic">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Fecha ingreso</label>
                                                    <input type="date" required name="fecha_ingreso" class="form-control"
                                                        id="fecha_ingreso_ic">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Cargo</label>
                                                    <select name="cargo_id" required class="form-control" id="cargo_id_ic">
                                                        @foreach ($cargos as $cargo)
                                                            <option value="{{ $cargo->id }}">{{ $cargo->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Puesto</label>
                                                    <select name="puesto_id" required class="form-control"
                                                        id="puesto_id_ic">
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
                                                    <label class="form-label">Vinculo</label>
                                                    <select name="vinculo_id" required class="form-control"
                                                        id="vinculo_id_ic">

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
                                                    <select name="tipo_usuarios_id" required class="form-control"
                                                        id="tipo_usuarios_id_ic">
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
                                                    <select name="tipo_ubigeo" required class="form-control"
                                                        id="tipo_ubigeo_ic">
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
                                                    <label class="form-label">Estado</label>
                                                    <select name="estado" required class="form-control" id="estado_ic">
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
                                                    <select name="departamento" required class="form-control"
                                                        id="departamento">
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
                                                    <select name="provincia" required class="form-control"
                                                        id="provincia">
                                                        <option value=""> -- Seleccione -- </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Distrito</label>
                                                    <select name="distrito" required class="form-control" id="distrito">
                                                        <option value=""> -- Seleccione -- </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Url facebook</label>
                                                    <input type="text" required name="url_facebook"
                                                        class="form-control" id="url_facebook_ic">

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Url 1</label>
                                                    <input type="text" required name="url_1" class="form-control"
                                                        id="url_1_ic">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Url 2</label>
                                                    <input type="text" required name="url_2" class="form-control"
                                                        id="url_2_ic">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">PPD</label>
                                                    <input type="text" required name="ppd" class="form-control"
                                                        id="ppd_ic">

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">
                                                        Referencias
                                                    </label>
                                                    <textarea class="form-control" required name="referencias" id="referencias_ic"></textarea>


                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">
                                                        Perfil
                                                    </label>
                                                    <textarea class="form-control" required name="perfil" id="perfil_ic"></textarea>


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
                    </div>
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                        aria-labelledby="newModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="newModalLabel">Editar</h5>
                                    <span aria-hidden="true" class="close c-p close-modall" data-dismiss="modal"
                                        aria-label="Close">&times;</span>
                                </div>
                                <div class="modal-body">
                                    <form action="" id="editForm">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Nombres</label>
                                                    <input type="hidden" name="id" class="form-control"
                                                        id="id_ie">
                                                    <input type="text" required name="nombres" class="form-control"
                                                        id="nombres_ie">
                                                    <div class="invalid-feedback" id="invalidNombresCreate">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Nombre Corto</label>
                                                    <input type="text" required name="nombre_corto"
                                                        class="form-control" id="nombreCorto_ie">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Telefono</label>
                                                    <input type="text" required name="telefono" class="form-control"
                                                        id="telefono_ie">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Dni</label>
                                                    <input type="text" required name="dni" class="form-control"
                                                        id="dni_ie">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Correo</label>
                                                    <input type="text" required name="correo" class="form-control"
                                                        id="correo_ie">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Clave</label>
                                                    <input type="text" required name="clave" class="form-control"
                                                        id="clave_ie">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Fecha ingreso</label>
                                                    <input type="date" required name="fecha_ingreso"
                                                        class="form-control" id="fecha_ingreso_ie">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Cargo</label>
                                                    <select name="cargo_id" required class="form-control"
                                                        id="cargo_id_ie">
                                                        @foreach ($cargos as $cargo)
                                                            <option value="{{ $cargo->id }}">{{ $cargo->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Puesto</label>
                                                    <select name="puesto_id" required class="form-control"
                                                        id="puesto_id_ie">
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
                                                    <label class="form-label">Vinculo</label>
                                                    <select name="vinculo_id" required class="form-control"
                                                        id="vinculo_id_ie">

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
                                                    <select name="tipo_usuarios_id" required class="form-control"
                                                        id="tipo_usuarios_id_ie">
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
                                                    <select name="tipo_ubigeo" required class="form-control"
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
                                                    <label class="form-label">Estado</label>
                                                    <select name="estado" required class="form-control" id="estado_ie">
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
                                                    <select name="departamento" required class="form-control"
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
                                                    <select name="provincia" required class="form-control"
                                                        id="provincia_ie">
                                                        <option value=""> -- Seleccione -- </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Distrito</label>
                                                    <select name="distrito" required class="form-control"
                                                        id="distrito_ie">
                                                        <option value=""> -- Seleccione -- </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Url facebook</label>
                                                    <input type="text" required name="url_facebook"
                                                        class="form-control" id="url_facebook_ie">

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Url 1</label>
                                                    <input type="text" required name="url_1" class="form-control"
                                                        id="url_1_ie">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Url 2</label>
                                                    <input type="text" required name="url_2" class="form-control"
                                                        id="url_2_ie">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">PPD</label>
                                                    <input type="text" required name="ppd" class="form-control"
                                                        id="ppd_ie">

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">
                                                        Referencias
                                                    </label>
                                                    <textarea class="form-control" required name="referencias" id="referencias_ie"></textarea>


                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">
                                                        Perfil
                                                    </label>
                                                    <textarea class="form-control" required name="perfil" id="perfil_ie"></textarea>


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
                    </div>
                    <div class="modal fade" id="imagenModal" tabindex="-1" role="dialog"
                        aria-labelledby="imagenModalLabel" aria-hidden="true">
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
                                                        <button class="btn btn-primary btn-sm"
                                                            type="submit">Guardar</button>
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
                                                        <button class="btn btn-primary btn-sm"
                                                            type="submit">Guardar</button>
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
                    <div class="card-body table-responsive">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Personal</h5>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end my-2">
                                <button class="btn btn-primary btn-sm mx-2" id="crear"><i
                                        class="fa fa-plus-circle"></i>
                                    Crear</button>
                                <button class="btn btn-success btn-sm" id="exportToExcel"><i
                                        class="fa fa-file-excel"></i>
                                    Excel</button>
                            </div>
                        </div>
                        <table class="table table-flush" id="datatable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th> id</th>
                                    <th> nombres</th>
                                    <th> ppd</th>
                                    <th> perfil</th>
                                    <th> foto</th>
                                    <th> cv</th>
                                    <th> url_facebook</th>
                                    <th> url_1</th>
                                    <th> url_2</th>
                                    <th> nombreCorto</th>
                                    <th> telefono</th>
                                    <th> referencias</th>
                                    <th> estado</th>
                                    <th> dni</th>
                                    <th> clave</th>
                                    <th> fecha ingreso</th>
                                    <th> correo</th>
                                    <th> sugerencias</th>
                                    <th> asignar_usuarios</th>
                                    <th> observaciones</th>
                                    <th> tipo ubigeo</th>
                                    <th> departamento</th>
                                    <th> provincia</th>
                                    <th> distrito</th>
                                    <th> created_at</th>
                                    <th> updated_at</th>
                                    <th> cargo</th>
                                    <th> vinculo</th>
                                    <th> Tipo usuario</th> {{-- <th>Accion</th> --}}
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
                return true;
            };
            const validateFormEdit = (data) => {

                return true;

            };
            $("#imagenForm").on("submit",async function(e) {
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
                Swal.fire("", "Complete correctamente el formulario?", "info");
            }
        }); $("#editForm").on("submit", function(e) {
            e.preventDefault();
            let data = $(this).serializeArray();
            var objtValues = {};
            data.forEach(function(item) {
                objtValues[item.name] = item.value;
            });
            if (validateFormEdit(objtValues)) {
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
                    data: "nombres"
                },
                {
                    data: "ppd"
                },
                {
                    data: "perfil"
                },
                {
                    data: "foto",
                    render: function(data, row, type) {
                        return `<img src="" objectid="${type.id}" onclick="handleEditImagen(this)" class="img-fluid"  style="width:20px;height:20px" title="imgen"/>`
                    }

                },
                {
                    data: "cv",
                    render: function(data, row, type) {
                        return `<span objectid="${type.id}"  onclick="handleEditCv(this)" class="btn btn-primary btn-sm" >CV</span>`;
                    }
                },
                {
                    data: "url_facebook"
                },
                {
                    data: "url_1"
                },
                {
                    data: "url_2"
                },
                {
                    data: "nombreCorto"
                },
                {
                    data: "telefono"
                },
                {
                    data: "referencias"
                },
                {
                    data: "estado"
                },
                {
                    data: "dni"
                },
                {
                    data: "clave"
                },
                {
                    data: "fecha_ingreso",
                    render: function(data) {
                        return moment(data).format('DD/MM/YY');
                    }
                },
                {
                    data: "correo"
                },
                {
                    data: "sugerencias"
                },
                {
                    data: "asignar_usuarios"
                },
                {
                    data: "observaciones"
                },
                {
                    data: "tipos_ubigeo.nombre"
                },
                {
                    data: "departamento.departamento"
                },
                {
                    data: "provincia.provincia"
                },
                {
                    data: "distrito.distrito"
                },
                {
                    data: "created_at",
                    render: function(data) {
                        return moment(data).format('DD/MM/YY');
                    }
                },
                {
                    data: "updated_at",
                    render: function(data) {
                        return moment(data).format('DD/MM/YY');
                    }
                },
                {
                    data: "cargo.nombre"
                },
                {
                    data: "vinculo.nombre"
                },
                {
                    data: "tipo_usuario.nivel"
                }
            ]
        }); $("#exportToExcel").on("click", function() {
            if (typeof XLSX == 'undefined') XLSX = require('xlsx');
            var ws = XLSX.utils.table_to_sheet(document.getElementById('datatable'));
            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "SheetJS");
            XLSX.writeFile(wb, "reporte.xlsx");
        });
        });
        const handleEditCv = function(e) {
            let id = $(e).attr("objectid");
            let object=datos.find(x=>x.id==id);
            $("#id_ie").val(id);
            $("#cvPdf").attr("src", `/storage/${object.cv}`);
            $("#cvModal").modal("show");
        }
        const handleEditImagen = function(e) {
            let id = $(e).attr("objectid");
            console.log(id);
            let object=datos.find(x=>x.id==id);
            $("#id_ie").val(id);
            $("#perfilImagen").attr("src", `/storage/${object.foto}`);
            $("#imagenModal").modal("show");
        }
        const handleEdit = function(ev) {
            const id = $(ev).attr("objectid");
            const item = datos.find((item) => item.id == id);
            if (item) {
                $("#nombres_ie").val(item.nombres);
                $("#id_ie").val(item.id);
                $("#cargo_id").val(item.cargo_id);
                $("#ppd_ie").val(item.ppd);
                $("#perfil_ie").val(item.perfil);
                $("#url_facebook_ie").val(item.url_facebook);
                $("#url_1_ie").val(item.url_1);
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
