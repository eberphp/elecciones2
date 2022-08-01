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
                                                    <select required name="cargo_id" class="form-control" id="cargo_id_ic">
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
                                                    <label class="form-label">Puesto</label>
                                                    <select required name="puesto_id" class="form-control"
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
                                                    <select required name="vinculo_id" class="form-control"
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
                                                    <select required name="tipo_usuarios_id" class="form-control"
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
                                                    <select required name="tipo_ubigeo" class="form-control"
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
                                                    <label class="form-label">Funcion</label>
                                                    <select required name="funcion_id" class="form-control"
                                                        id="funcion_id_ic">
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
                                                    <select required name="estado" class="form-control" id="estado_ic">
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
                                                    <select required name="departamento" class="form-control"
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
                                                    <select required name="provincia" class="form-control"
                                                        id="provincia">
                                                        <option value=""> -- Seleccione -- </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Distrito</label>
                                                    <select required name="distrito" class="form-control" id="distrito">
                                                        <option value=""> -- Seleccione -- </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Foto</label>
                                                    <input type="file" required name="foto" class="form-control"
                                                        id="foto_ic">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Cv</label>
                                                    <input type="file" required name="cv" class="form-control"
                                                        id="cv_ic">

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
                                                    <textarea class="form-control ckeditor" required name="perfil" id="perfil_ic"></textarea>


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
                                                    <input type="text" name="nombres" class="form-control"
                                                        id="nombres_ie">
                                                    <div class="invalid-feedback" id="invalidNombresCreate">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Nombre Corto</label>
                                                    <input type="text" name="nombre_corto" class="form-control"
                                                        id="nombreCorto_ie">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Telefono</label>
                                                    <input type="text" name="telefono" class="form-control"
                                                        id="telefono_ie">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Dni</label>
                                                    <input type="text" name="dni" class="form-control"
                                                        id="dni_ie">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Correo</label>
                                                    <input type="text" name="correo" class="form-control"
                                                        id="correo_ie">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Clave</label>
                                                    <input type="text" name="clave" class="form-control"
                                                        id="clave_ie">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Fecha ingreso</label>
                                                    <input type="date" name="fecha_ingreso" class="form-control"
                                                        id="fecha_ingreso_ie">
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
                                                    <select name="tipo_usuarios_id" class="form-control"
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
                                                    <select name="departamento" class="form-control"
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
                                                    <input type="text" name="url_facebook" class="form-control"
                                                        id="url_facebook_ie">

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Url 1</label>
                                                    <input type="text" name="url_1" class="form-control"
                                                        id="url_1_ie">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Url 2</label>
                                                    <input type="text" name="url_2" class="form-control"
                                                        id="url_2_ie">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">PPD</label>
                                                    <input type="text" name="ppd" class="form-control"
                                                        id="ppd_ie">

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
                                        <!--Funcionalidades: Ricardo Bejar-->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    Roles: Configuración de permisos
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 chk-3">
                                                <div class="row">
                                                    <div class="col-md-12"><input type="checkbox" name="chk-3"
                                                            id="chk-3" class="chk-all"><label>&nbsp;Web</label></div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-3')" name="chk-3-1"
                                                            id="chk-3-1">&nbsp;&nbsp;Datos de la empresa</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-3')" name="chk-3-2"
                                                            id="chk-3-2">&nbsp;&nbsp;Slider</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-3')" name="chk-3-3"
                                                            id="chk-3-3">&nbsp;&nbsp;Publicaciones</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-3')" name="chk-3-4"
                                                            id="chk-3-4">&nbsp;&nbsp;Productos</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-3')" name="chk-3-5"
                                                            id="chk-3-5">&nbsp;&nbsp;Servicios</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-3')" name="chk-3-6"
                                                            id="chk-3-6">&nbsp;&nbsp;Redes sociales</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-3')" name="chk-3-7"
                                                            id="chk-3-7">&nbsp;&nbsp;Nosotros</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-3')" name="chk-3-8"
                                                            id="chk-3-8">&nbsp;&nbsp;Testimonios</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-3')" name="chk-3-9"
                                                            id="chk-3-9">&nbsp;&nbsp;Pie de página</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-3')" name="chk-3-10"
                                                            id="chk-3-10">&nbsp;&nbsp;Términos y condiciones</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 chk-1">
                                                <div class="row">
                                                    <div class="col-md-12"><input type="checkbox" name="chk-1"
                                                            id="chk-1"
                                                            class="chk-all"><label>&nbsp;Configuración</label></div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-1')" name="chk-1-1"
                                                            id="chk-1-1">&nbsp;&nbsp;Cargo</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-1')" name="chk-1-2"
                                                            id="chk-1-2">&nbsp;&nbsp;Función</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-1')" name="chk-1-3"
                                                            id="chk-1-3">&nbsp;&nbsp;Estado Evaluación</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-1')" name="chk-1-4"
                                                            id="chk-1-4">&nbsp;&nbsp;Vínculo</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-1')" name="chk-1-5"
                                                            id="chk-1-5">&nbsp;&nbsp;Tipo de Usuario</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-1')" name="chk-1-6"
                                                            id="chk-1-6">&nbsp;&nbsp;Tipo de Ubigeo</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-1')" name="chk-1-7"
                                                            id="chk-1-7">&nbsp;&nbsp;Tipo de Actividad</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-1')" name="chk-1-8"
                                                            id="chk-1-8">&nbsp;&nbsp;Área</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-1')" name="chk-1-9"
                                                            id="chk-1-9">&nbsp;&nbsp;Prioridad</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-1')" name="chk-1-10"
                                                            id="chk-1-10">&nbsp;&nbsp;Estado Gestión</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-1')" name="chk-1-11"
                                                            id="chk-1-11">&nbsp;&nbsp;Usuario Resp.</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-1')" name="chk-1-12"
                                                            id="chk-1-12">&nbsp;&nbsp;Estado Actividad</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 chk-6">
                                                <div class="row">
                                                    <div class="col-md-12"><input type="checkbox" name="chk-6"
                                                            id="chk-6" class="chk-all"><label>&nbsp;Personal</label>
                                                    </div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-6')" name="chk-6-1"
                                                            id="chk-6-1">&nbsp;&nbsp;Id</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-6')" name="chk-6-2"
                                                            id="chk-6-2">&nbsp;&nbsp;Nombres y apellidos</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-6')" name="chk-6-3"
                                                            id="chk-6-3">&nbsp;&nbsp;Cargo 1</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-6')" name="chk-6-4"
                                                            id="chk-6-4">&nbsp;&nbsp;PPD</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-6')" name="chk-6-5"
                                                            id="chk-6-5">&nbsp;&nbsp;Perfil</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-6')" name="chk-6-6"
                                                            id="chk-6-6">&nbsp;&nbsp;Foto</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-6')" name="chk-6-7"
                                                            id="chk-6-7">&nbsp;&nbsp;CV</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-6')" name="chk-6-8"
                                                            id="chk-6-8">&nbsp;&nbsp;Evaluación</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-6')" name="chk-6-9"
                                                            id="chk-6-9">&nbsp;&nbsp;Facebook</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-6')" name="chk-6-10"
                                                            id="chk-6-10">&nbsp;&nbsp;Whatsapp</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-6')" name="chk-6-11"
                                                            id="chk-6-11">&nbsp;&nbsp;Instagram</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-6')" name="chk-6-12"
                                                            id="chk-6-12">&nbsp;&nbsp;Cargo 2</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-6')" name="chk-6-13"
                                                            id="chk-6-13">&nbsp;&nbsp;Nombre corto</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-6')" name="chk-6-14"
                                                            id="chk-6-14">&nbsp;&nbsp;Teléfono</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-6')" name="chk-6-15"
                                                            id="chk-6-15">&nbsp;&nbsp;Referencias</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-6')" name="chk-6-16"
                                                            id="chk-6-16">&nbsp;&nbsp;Estado</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-6')" name="chk-6-17"
                                                            id="chk-6-17">&nbsp;&nbsp;Vínculo</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-6')" name="chk-6-18"
                                                            id="chk-6-18">&nbsp;&nbsp;DNI</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-6')" name="chk-6-19"
                                                            id="chk-6-19">&nbsp;&nbsp;Fecha de ingreso</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-6')" name="chk-6-20"
                                                            id="chk-6-20">&nbsp;&nbsp;Correo</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-6')" name="chk-6-21"
                                                            id="chk-6-21">&nbsp;&nbsp;Observaciones</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-6')" name="chk-6-22"
                                                            id="chk-6-22">&nbsp;&nbsp;Departamento</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-6')" name="chk-6-23"
                                                            id="chk-6-23">&nbsp;&nbsp;Provincia</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-6')" name="chk-6-24"
                                                            id="chk-6-24">&nbsp;&nbsp;Distrito</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 chk-2">
                                                <div class="row">
                                                    <div class="col-md-12"><input type="checkbox" name="chk-2"
                                                            id="chk-2" class="chk-all"><label>&nbsp;Encuestas</label>
                                                    </div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-2')" name="chk-2-1"
                                                            id="chk-2-1">&nbsp;&nbsp;Ubigeo</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-2')" name="chk-2-2"
                                                            id="chk-2-2">&nbsp;&nbsp;Partidos</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-2')" name="chk-2-3"
                                                            id="chk-2-3">&nbsp;&nbsp;Candidatos</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-2')" name="chk-2-4"
                                                            id="chk-2-4">&nbsp;&nbsp;Crear encuestas</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-2')" name="chk-2-5"
                                                            id="chk-2-5">&nbsp;&nbsp;Encuestador</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks2_6_all('chk-2')" name="chk-2-6"
                                                            id="chk-2-6">&nbsp;&nbsp;Registrar encuestas</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks2_6_itm('chk-2')" name="chk-2-6-1"
                                                            id="chk-2-6-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nuevo</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks2_6_itm('chk-2')" name="chk-2-6-2"
                                                            id="chk-2-6-2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Editar</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks2_6_itm('chk-2')" name="chk-2-6-3"
                                                            id="chk-2-6-3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Eliminar
                                                    </div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-2')" name="chk-2-7"
                                                            id="chk-2-7">&nbsp;&nbsp;Validar resultados</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-2')" name="chk-2-8"
                                                            id="chk-2-8">&nbsp;&nbsp;Resultados</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks2_9_all('chk-2')" name="chk-2-9"
                                                            id="chk-2-9">&nbsp;&nbsp;Tipo Ubigeo</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks2_9_itm('chk-2')" name="chk-2-9-1"
                                                            id="chk-2-9-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Departamento
                                                    </div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks2_9_itm('chk-2')" name="chk-2-9-2"
                                                            id="chk-2-9-2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Provincia
                                                    </div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks2_9_itm('chk-2')" name="chk-2-9-3"
                                                            id="chk-2-9-3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Distrito
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 chk-4">
                                                <div class="row">
                                                    <div class="col-md-12"><input type="checkbox" name="chk-4"
                                                            id="chk-4" class="chk-all"><label>&nbsp;Calendario</label>
                                                    </div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-4')" name="chk-4-1"
                                                            id="chk-4-1">&nbsp;&nbsp;Usuario Nivel 1</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-4')" name="chk-4-2"
                                                            id="chk-4-2">&nbsp;&nbsp;Usuario Nivel 2</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks4_3_all('chk-4')" name="chk-4-3"
                                                            id="chk-4-3">&nbsp;&nbsp;Tabla de Gestiones</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks4_3_itm('chk-4')" name="chk-4-3-1"
                                                            id="chk-4-3-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nuevo</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks4_3_itm('chk-4')" name="chk-4-3-2"
                                                            id="chk-4-3-2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Editar</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks4_3_itm('chk-4')" name="chk-4-3-3"
                                                            id="chk-4-3-3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Eliminar
                                                    </div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks4_4_all('chk-4')" name="chk-4-4"
                                                            id="chk-4-4">&nbsp;&nbsp;Historial de Gestiones</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks4_4_itm('chk-4')" name="chk-4-4-1"
                                                            id="chk-4-4-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nuevo</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks4_4_itm('chk-4')" name="chk-4-4-2"
                                                            id="chk-4-4-2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Editar</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks4_4_itm('chk-4')" name="chk-4-4-3"
                                                            id="chk-4-4-3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Eliminar
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 chk-5">
                                                <div class="row">
                                                    <div class="col-md-12"><input type="checkbox" name="chk-5"
                                                            id="chk-5" class="chk-all"><label>&nbsp;Proyectos</label>
                                                    </div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-5')" name="chk-5-1"
                                                            id="chk-5-1">&nbsp;&nbsp;Nuevo</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-5')" name="chk-5-2"
                                                            id="chk-5-2">&nbsp;&nbsp;Editar</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-5')" name="chk-5-3"
                                                            id="chk-5-3">&nbsp;&nbsp;Eliminar</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-5')" name="chk-5-4"
                                                            id="chk-5-4">&nbsp;&nbsp;Ver</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks('chk-5')" name="chk-5-5"
                                                            id="chk-5-5">&nbsp;&nbsp;Iniciar</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks5_6_all('chk-5')" name="chk-5-6"
                                                            id="chk-5-6">&nbsp;&nbsp;Entregables</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks5_6_itm('chk-5')" name="chk-5-6-1"
                                                            id="chk-5-6-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nuevo</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks5_6_itm('chk-5')" name="chk-5-6-2"
                                                            id="chk-5-6-2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Editar</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks5_6_itm('chk-5')" name="chk-5-6-3"
                                                            id="chk-5-6-3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Eliminar
                                                    </div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks5_6_itm('chk-5')" name="chk-5-6-4"
                                                            id="chk-5-6-4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ver</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks5_6_itm('chk-5')" name="chk-5-6-5"
                                                            id="chk-5-6-5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Iniciar
                                                    </div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks5_7_all('chk-5')" name="chk-5-7"
                                                            id="chk-5-7">&nbsp;&nbsp;Ajustes</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks5_7_itm('chk-5')" name="chk-5-7-1"
                                                            id="chk-5-7-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nuevo</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks5_7_itm('chk-5')" name="chk-5-7-2"
                                                            id="chk-5-7-2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Editar</div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks5_7_itm('chk-5')" name="chk-5-7-3"
                                                            id="chk-5-7-3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Eliminar
                                                    </div>
                                                </div>
                                                <div class="row chk-itm">
                                                    <div class="col-md-12"><input type="checkbox"
                                                            onclick="verifyChecks5_7_itm('chk-5')" name="chk-5-7-4"
                                                            id="chk-5-7-4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ver</div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Fin: Funcionalidades-->
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
                                                <img src="" id="perfilImagen"
                                                    style="width: 100px;height:100px" alt="">
                                            </div>

                                        </div>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="cvModal" tabindex="-1" role="dialog"
                        aria-labelledby="cvModalLabel" aria-hidden="true">
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
                    <div class="modal fade" id="PPDModal" tabindex="-1" role="dialog"
                        aria-labelledby="PPDModalLabel" aria-hidden="true">
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

                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@section('script')
    <!--Funcionalidades: Ricardo Bejar-->
    <style>
        .row .chk-itm {
            font-size: 12.5px;
            font-weight: 400
        }
    </style>
    <script>
        $('.chk-all').change(function() {
            var clase = $(this).prop('name');
            var chk = $(this).prop('checked');
            $('.' + clase + ' .chk-itm input[type=checkbox]').each(function() {
                $(this).prop('checked', chk);
            });
        });

        function verifyChecks(clase) {
            var res = true;
            $('.' + clase + ' .chk-itm input[type=checkbox]').each(function() {
                res |= $(this).prop('checked');
            });
            $('.' + clase + ' .chk-all').prop('checked', res);
        }

        function verifyChecks2_6_all(clase) {
            var chk = $('#chk-2-6').prop('checked');
            $('#chk-2-6-1').prop('checked', chk);
            $('#chk-2-6-2').prop('checked', chk);
            $('#chk-2-6-3').prop('checked', chk);
            verifyChecks(clase);
        }

        function verifyChecks2_9_all(clase) {
            var chk = $('#chk-2-9').prop('checked');
            $('#chk-2-9-1').prop('checked', chk);
            $('#chk-2-9-2').prop('checked', chk);
            $('#chk-2-9-3').prop('checked', chk);
            verifyChecks(clase);
        }

        function verifyChecks4_3_all(clase) {
            var chk = $('#chk-4-3').prop('checked');
            $('#chk-4-3-1').prop('checked', chk);
            $('#chk-4-3-2').prop('checked', chk);
            $('#chk-4-3-3').prop('checked', chk);
            verifyChecks(clase);
        }

        function verifyChecks4_4_all(clase) {
            var chk = $('#chk-4-4').prop('checked');
            $('#chk-4-4-1').prop('checked', chk);
            $('#chk-4-4-2').prop('checked', chk);
            $('#chk-4-4-3').prop('checked', chk);
            verifyChecks(clase);
        }

        function verifyChecks5_6_all(clase) {
            var chk = $('#chk-5-6').prop('checked');
            $('#chk-5-6-1').prop('checked', chk);
            $('#chk-5-6-2').prop('checked', chk);
            $('#chk-5-6-3').prop('checked', chk);
            $('#chk-5-6-4').prop('checked', chk);
            $('#chk-5-6-5').prop('checked', chk);
            verifyChecks(clase);
        }

        function verifyChecks5_7_all(clase) {
            var chk = $('#chk-5-7').prop('checked');
            $('#chk-5-7-1').prop('checked', chk);
            $('#chk-5-7-2').prop('checked', chk);
            $('#chk-5-7-3').prop('checked', chk);
            $('#chk-5-7-4').prop('checked', chk);
            verifyChecks(clase);
        }

        function verifyChecks2_6_itm(clase) {
            var chk1 = $('#chk-2-6-1').prop('checked');
            var chk2 = $('#chk-2-6-2').prop('checked');
            var chk3 = $('#chk-2-6-3').prop('checked');
            $('#chk-2-6').prop('checked', chk1 || chk2 || chk3);
            verifyChecks(clase);
        }

        function verifyChecks2_9_itm(clase) {
            var chk1 = $('#chk-2-9-1').prop('checked');
            var chk2 = $('#chk-2-9-2').prop('checked');
            var chk3 = $('#chk-2-9-3').prop('checked');
            $('#chk-2-9').prop('checked', chk1 || chk2 || chk3);
            verifyChecks(clase);
        }

        function verifyChecks4_3_itm(clase) {
            var chk1 = $('#chk-4-3-1').prop('checked');
            var chk2 = $('#chk-4-3-2').prop('checked');
            var chk3 = $('#chk-4-3-3').prop('checked');
            $('#chk-4-3').prop('checked', chk1 || chk2 || chk3);
            verifyChecks(clase);
        }

        function verifyChecks4_4_itm(clase) {
            var chk1 = $('#chk-4-4-1').prop('checked');
            var chk2 = $('#chk-4-4-2').prop('checked');
            var chk3 = $('#chk-4-4-3').prop('checked');
            $('#chk-4-4').prop('checked', chk1 || chk2 || chk3);
            verifyChecks(clase);
        }

        function verifyChecks5_6_itm(clase) {
            var chk1 = $('#chk-5-6-1').prop('checked');
            var chk2 = $('#chk-5-6-2').prop('checked');
            var chk3 = $('#chk-5-6-3').prop('checked');
            var chk4 = $('#chk-5-6-4').prop('checked');
            var chk5 = $('#chk-5-6-5').prop('checked');
            $('#chk-5-6').prop('checked', chk1 || chk2 || chk3 || chk4 || chk5);
            verifyChecks(clase);
        }

        function verifyChecks5_7_itm(clase) {
            var chk1 = $('#chk-5-7-1').prop('checked');
            var chk2 = $('#chk-5-7-2').prop('checked');
            var chk3 = $('#chk-5-7-3').prop('checked');
            var chk3 = $('#chk-5-7-4').prop('checked');
            $('#chk-5-7').prop('checked', chk1 || chk2 || chk3 || chk4);
            verifyChecks(clase);
        }
    </script>

    <script src="//cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>
    <!--Fin: Funcionalidades-->
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

                if (data.nombres && data.nombre_corto && data.departamento && data.provincia && data.distrito) {
                    return true;
                }
                return false;
            };
            const validateFormEdit = (data) => {

                console.log(data);
                if (data.nombres && data.nombre_corto && data.departamento && data.provincia && data.distrito) {
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
                data.forEach(function(item) {
                    objtValues[item.name] = item.value;
                });
                const formData = new FormData();
                let documents = true;
                if ($("#foto_ic")[0].files[0]) {
                    formData.append('foto', $("#foto_ic")[0].files[0]);
                } else {
                    documents = false;
                }
                if ($("#cv_ic")[0].files[0]) {
                    formData.append('cv', $("#cv_ic")[0].files[0]);
                } else {
                    documents = false;
                }
                if (validateFormNew(objtValues)) {
                    Object.keys(objtValues).forEach(function(key) {
                        formData.append(key, objtValues[key]);
                    });
                    formData.append('personal', objtValues);
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
                        data: "perfil",
                        render: function(data, row, type) {
                            return `<span objectid="${type.id}"  onclick="handleViewProfile(this)" class="btn btn-primary btn-sm" >Perfil</span>`;
                        }

                    },
                    {
                        data: "foto",
                        render: function(data, row, type) {
                            return `<span objectid="${type.id}"  onclick="handleEditImagen(this)" class="btn btn-primary btn-sm" >Perfil</span>`;
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
                        data: "url_facebook"
                    },
                    {
                        data: "url_1"
                    },
                    {
                        data: "url_2"
                    },
                    {
                        data: "funcion.nombre"
                    },
                    {
                        data: "nombreCorto"
                    },
                    {
                        data: "telefono"
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
                        data: "estado"
                    },
                    {
                        data: "vinculo.nombre",
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
                        data: "tipo_usuario.nivel"
                    },
                    {
                        data: "asignar_usuarios"
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
                        data: "rol_id",
                        render: function(data) {
                            return `<span class="btn btn-primary">Asignar roles</span>`;
                        }
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
            let parser = new DOMParser();
            let doc = parser.parseFromString(object.perfil, 'text/html');
            let html = doc.body.firstChild.data;
            $("#perfilvalue").html(html);
            $("#perfilModal").modal("show");

        }
        const handleViewEvaluacion = function(e) {
            let id = $(e).attr("objectid");
            let object = datos.find(x => x.id == id);
            console.log(object);
            $("#id_ie").val(id);
            let parser = new DOMParser();
            let doc = parser.parseFromString(object.evaluacion, 'text/html');
            let html = doc.body.firstChild.data;
            $("#evaluacionvalue").html(html);
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
