@extends('intranet.layouts.layout')
@section('style')
    <style>
        .c-p {
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <?php $perfil = App\Models\Perfil::find(auth()->user()->perfil_id);
    
    $usuario = Auth::user();
    $personal = $usuario->personal;
    
    ?>

    <div class="container-fluid py-4">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="newModalLabel">Crear</h5>

                                    <span aria-hidden="true" class="close c-p close-modall" data-dismiss="modal"
                                        aria-label="Close">&times;</span>

                                </div>

                                <div class="modal-body">
                                    <form action="/api/personal_web" id="createForm">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Nombres y Apellidos</label>
                                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                    <input type="text" name="nombres" class="form-control"
                                                        id="nombres_ic">
                                                    <div class="invalid-feedback" id="invalidNombresCreate">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Nombre Corto</label>
                                                    <input type="text" name="nombre_corto" class="form-control"
                                                        id="nombre_corto_ic">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Telefono</label>
                                                    <input type="text" name="telefono" class="form-control"
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
                                            {{-- <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Fecha ingreso</label>
                                                    <input type="date" name="fecha_ingreso" class="form-control"
                                                        id="fecha_ingreso_ic">

                                                </div>
                                            </div> --}}
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
                                            {{-- <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Tipo de usuario</label>
                                                    <select name="tipo_usuarios_id" class="form-control"
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
                                                    <select name="tipo_ubigeo" class="form-control" id="tipo_ubigeo_ic">
                                                        <option value=""> -- Seleccione -- </option>
                                                        @foreach ($tipoUbigeos as $tipoUbigeo)
                                                            <option value="{{ $tipoUbigeo->id }}">
                                                                {{ $tipoUbigeo->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div> --}}
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
                                                    <input type="file" name="foto" class="form-control"
                                                        id="foto_ic">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Cv</label>
                                                    <input type="file" name="cv" class="form-control"
                                                        id="cv_ic">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Url facebook</label>
                                                    <input type="text" name="url_facebook" class="form-control"
                                                        id="url_facebook_ic">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Url 1</label>
                                                    <input type="text" name="url_1" class="form-control"
                                                        id="url_1_ic">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Url 2</label>
                                                    <input type="text" name="url_2" class="form-control"
                                                        id="url_2_ic">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Tarea</label>
                                                    <input type="text" name="nro_mesa" class="form-control"
                                                        id="nro_mesa_ic">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">PPD</label>
                                                    <input type="text" name="ppd" class="form-control"
                                                        id="ppd_ic">
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">
                                                        Referencias
                                                    </label>
                                                    <textarea class="form-control ckeditor" name="referencias" id="referencias_ic"></textarea>


                                                </div>
                                            </div> --}}
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
                                            {{--  <div class="col-md-12">
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
                                            </div> --}}
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
                        aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Editar</h5>
                                    <span aria-hidden="true" class="close c-p close-modall" data-dismiss="modal"
                                        aria-label="Close">&times;</span>
                                </div>
                                <div class="modal-body">
                                    <form action="" id="editForm">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Nombres y Apellidos</label>
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
                                            {{-- <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Fecha ingreso</label>
                                                    <input type="date" name="fecha_ingreso" class="form-control"
                                                        id="fecha_ingreso_ie">
                                                </div>
                                            </div> --}}
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
                                                            <option value="{{ $vinculo->id }}">
                                                                {{ $vinculo->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                            {{-- <div class="col-md-4">
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
                                            </div> --}}
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
                                                    <label class="form-label">Tarea</label>
                                                    <input type="text" name="nro_mesa" class="form-control"
                                                        id="nro_mesa_ie">

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">PPD</label>
                                                    <input type="text" name="ppd" class="form-control"
                                                        id="ppd_ie">

                                                </div>
                                            </div>
                                            {{--  <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">
                                                        Referencias
                                                    </label>
                                                    <textarea class="form-control ckeditor" name="referencias" id="referencias_ie"></textarea>


                                                </div>
                                            </div> --}}
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
                                            {{--          <div class="col-md-12">
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
                                            </div> --}}
                                        </div>
                                        <div class="w-100 d-flex justify-content-end">
                                            <button class="btn btn-primary" type="submit">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    <div class="modal fade" id="rolesModal" tabindex="-1" role="dialog"
                        aria-labelledby="rolesModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
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
                    <div class="modal-dialog modal-lg" role="document">
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
                                            <embed src="" id="cvPdf" alt="" width="100%"
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
                <div class="modal fade" id="importarModal" tabindex="-1" role="dialog"
                    aria-labelledby="importarModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="importarModalLabel">Importar personal</h5>
                                <span aria-hidden="true" class="close c-p close-modall" data-dismiss="modal"
                                    aria-label="Close">&times;</span>
                            </div>
                            <div class="modal-body">
                                <form id="formImportData" action="" method="POST">
                                    <div class="form-group">
                                        <a href="{{ asset('importar.xlsx') }}" target="_blank"
                                            download="plantilla importar.xlsx" class="btn btn-success"> <i
                                                class="fa fa-download"></i> Descargar plantilla</a>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Seleccione archivo</label>
                                        <input type="file" name="archivo_excel" id="archivo_excel"
                                            class="form-control"
                                            accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                    </div>
                                    <div class="form-group">
                                        <div class="w-100 d-flex justify-content-end my-2">
                                            <button type="submit" id="button_upload_excel" class="btn btn-danger"> <i
                                                    class="fa fa-save"></i>
                                                Guardar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="importarModalElecciones" tabindex="-1" role="dialog"
                    aria-labelledby="importarModalEleccionesLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="importarModalEleccionesLabel">Importar data de elecciones</h5>
                                <span aria-hidden="true" class="close c-p close-modall" data-dismiss="modal"
                                    aria-label="Close">&times;</span>
                            </div>
                            <div class="modal-body">
                                <form id="formImportDataElecciones" action="" method="POST">
                                    <div class="form-group">
                                        <a href="{{ asset('importar_elecciones.xlsx') }}" target="_blank"
                                            download="plantilla importar.xlsx" class="btn btn-success"> <i
                                                class="fa fa-download"></i> Descargar plantilla</a>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Seleccione archivo</label>
                                        <input type="file" name="archivo_excel" id="archivo_excel_elecciones"
                                            class="form-control"
                                            accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                    </div>
                                    <div class="form-group">
                                        <div class="w-100 d-flex justify-content-end my-2">
                                            <button type="submit" id="button_upload_excel_elecciones"
                                                class="btn btn-danger"> <i class="fa fa-save"></i>
                                                Guardar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="eleccionesModal" tabindex="-1" role="dialog"
                    aria-labelledby="eleccionesModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="eleccionesModalLabel">Elecciones</h5>
                                <span aria-hidden="true" class="close c-p close-modall" data-dismiss="modal"
                                    aria-label="Close">&times;</span>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex flex-wrap" id="content_elecciones">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">

                    <div class="card-header bg-secondary">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="text-white">Personal web</h5>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end my-2">
                                <button class="btn btn-primary btn-xs mx-2" id="crear"><i
                                        class="fa fa-plus-circle"></i>
                                    Crear</button>
                                <button class="btn btn-success btn-xs mx-2" id="importFromExcel"><i
                                        class="fa fa-file-excel"></i>
                                    Importar personal</button>
                                <button class="btn btn-success btn-xs mx-2" id="importFromExcelElecciones"><i
                                        class="fa fa-file-excel"></i>
                                    Importar elecciones</button>
                                <button class="btn btn-success btn-xs" id="exportToExcel"><i
                                        class="fa fa-file-excel"></i>
                                    Excel</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="" class="form-label text-white">
                                        Departamento
                                    </label>
                                    <select name="departamento" class="form-control form-control-sm"
                                        id="departamento_filter">
                                        <option value=""> -- Todos -- </option>
                                        @foreach ($departamentos as $departamento)
                                            <option value="{{ $departamento->id }}">
                                                {{ $departamento->departamento }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label text-white">Provincia</label>
                                    <select name="provincia" class="form-control form-control-sm" id="provincia_filter">
                                        <option value=""> -- Todos -- </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label text-white">Distrito</label>
                                    <select name="distrito" class="form-control form-control-sm" id="distrito_filter">
                                        <option value=""> -- Todos -- </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive mb-4">

                        <table class="table table-flush" id="datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th>Accion</th>
                                    <th> id</th>
                                    <th> Nombres y Apellidos</th>
                                    <th>Función</th>
                                    <th> Estado</th>
                                    <th> Tarea </th>
                                    <th></th>
                                    <th> PPD</th>
                                    <th> Perfil</th>
                                    <th> Foto</th>
                                    <th> Cv</th>
                                    <th>Evaluacion</th>{{-- 
                                    <th> URL_facebook</th>
                                    <th> URL_1</th>
                                    <th> URL_1</th> --}}
                                    <th> Nombre Corto</th>
                                    <th> Telefono</th>{{-- 
                                    <th> Referencias</th> --}}



                                    <th>Vinculo</th>


                                    <th> Dni</th>


                                    <th> Clave</th>

                                    {{-- <th> Fec.Ingreso</th> --}}


                                    <th> Correo</th>

                                    {{-- 
                                    <th> Sugerencias</th> --}}

                                    {{-- <th>Tipo de Usuario</th> --}}


                                    <th> Asignar Usuarios</th>


                                    {{-- <th> Observaciones</th> --}}

                                    {{-- <th> Tipo Ubigeo</th> --}}




                                    <th> Departamento</th>


                                    <th> Provincia</th>


                                    <th> Distrito</th>

                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>

                            </thead>

                        </table>
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
        var permisos_table = [];
        var columns_datatables = [];
        var columns_datatables_default = [{
                data: "id",
                name: "id",
                render: function(data) {
                    return ` <i class="fa fa-edit c-p" objectid="${data}" onclick="handleEdit(this)"></i>`
                }
            },
            {
                data: "created_at",
                sercheable: false,
                orderable: false,
            },
            {
                data: "nombres",
                render: function(data) {
                    return data ? data : "";
                }
            }, {
                data: "funcion.nombre",
                render: function(data) {
                    return data ? data : "";
                },
                orderable: false
            }, {
                data: "_estado.nombre",
                render: function(data) {
                    return data ? data : "";
                },
                orderable: false
            },
            {
                data: "nro_mesa",
                render: function(data) {
                    return data ? data : "";
                }
            },
            {
                data: "nro_mesa",
                render: function(data, type, row) {
                    return "";
                    console.log(row);
                    if (data) {
                        return `<button  idvalue="${data}"  class='btn ${row['votos']>0 ?'btn-success':'btn-warning'}' onclick="modalElecciones(this)" >Ir a votar</button>`
                    }
                    return "<button class='btn btn-danger' disabled>Sin mesa</button>"
                },
                orderable: false
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
            /*  {
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
             }, */
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
            /* {
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
            }, */

            {
                data: "vinculo.nombre",
                render: function(data) {
                    return data ? data : "";
                },
                orderable: false,
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
            /* 
                        {
                            data: "fecha_ingreso",
                            render: function(data) {

                                return data ? moment(data).format('DD/MM/YY') : moment().format(
                                    'DD/MM/YY');
                            }
                        }, */
            {
                data: "correo",
                render: function(data) {
                    return data ? data : "";
                }
            },
            /* {
                data: "sugerencias",
                render: function(data) {

                    let html = "";
                    if (data) {
                        let parser = new DOMParser();
                        let doc = parser.parseFromString(data, 'text/html');
                        html = doc.body.firstChild.data;
                    } else {
                        html = "";
                    }

                    return `${html}`;
                }
            }, */
            /* {
                data: "tipo_usuario.nivel",
                searchable: false,
                render: function(data) {
                    return data ? data : "";
                }
            }, */
            {
                data: "asignar_usuarios",
                render: function(data) {
                    return data ? data : "";
                }
            },
            /*  {
                 data: "observaciones",
                 render: function(data) {

                     let html = "";
                     if (data) {
                         let parser = new DOMParser();
                         let doc = parser.parseFromString(data, 'text/html');
                         html = doc.body.firstChild.data;
                     } else {
                         html = "";
                     }

                     return `${html}`;
                 }
             }, */
            /* 
                        {
                            data: "tipos_ubigeo.nombre",
                            render: function(data) {
                                return data ? data : "";
                            }
                        }, */

            {
                data: "_departamento.departamento",
                render: function(data) {
                    return data ? data : "";
                },
                orderable: false,
            },
            {
                data: "_provincia.provincia",
                render: function(data) {
                    return data ? data : "";
                },
                orderable: false,
            },
            {
                data: "_distrito.distrito",
                render: function(data) {
                    return data ? data : "";
                },
                orderable: false,
            }

        ];


        $(document).ready(function() {
            $("#importFromExcel").on("click", function(e) {
                $("#importarModal").modal("show");
            })
            $("#importFromExcelElecciones").on("click", function(e) {
                $("#importarModalElecciones").modal("show");
            })
            $("#formImportData").on("submit", async function(e) {
                e.preventDefault();
                if ($("#archivo_excel")) {
                    if ($("#archivo_excel")[0]) {
                        if ($("#archivo_excel")[0].files[0]) {
                            const formData = new FormData();
                            formData.append('file_excel', $("#archivo_excel")[0].files[0]);
                            const resp = await fetch(`/personal_web/importData`, {
                                method: 'post',
                                body: formData,
                                headers: {
                                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                        "content"
                                    ),
                                }
                            })
                            let dataresp = await resp.json();
                            if (dataresp.success) {
                                Swal.fire("Success", "Importado correctamente", "success");
                                $("#importarModal").modal("hide");
                                customtable.ajax.reload();
                            } else {
                                console.log(dataresp);
                                Swal.fire("Error", "Error al importar", "error");
                            }
                        }
                    }
                }

            })
            $("#formImportDataElecciones").on("submit", async function(e) {
                e.preventDefault();
                if ($("#archivo_excel_elecciones")) {
                    if ($("#archivo_excel_elecciones")[0]) {
                        if ($("#archivo_excel_elecciones")[0].files[0]) {
                            const formData = new FormData();
                            formData.append('file_excel', $("#archivo_excel_elecciones")[0].files[0]);
                            const resp = await fetch(`/personal_web/importDataElecciones`, {
                                method: 'post',
                                body: formData,
                                headers: {
                                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                        "content"
                                    ),
                                }
                            })
                            let dataresp = await resp.json();
                            if (dataresp.success) {
                                Swal.fire("Success", "Importado correctamente", "success");
                                $("#importarModalElecciones").modal("hide");
                                customtable.ajax.reload();
                            } else {
                                console.log(dataresp);
                                Swal.fire("Error", "Error al importar", "error");
                            }
                        }
                    }
                }

            })
            $("#button_upload_excel").on("click", function(e) {
                console.log(e);
            })
            const handlePermisos = async function() {
                return [];
            };
            handlePermisos().then((data) => {

                columns_datatables = columns_datatables_default;
                renderDatatable();

            });

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
                $("#importarModal").modal("hide");
                $("#eleccionesModal").modal("hide");
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
            $("#departamento_filter").on("change", function(e) {
                let value = e.target.value;
                let lengthtable = columns_datatables.length;
                let valuef = value ? '^' + value + '$' : ''
                customtable
                    .column(lengthtable - 3)
                    .search(valuef, true, false)
                    .draw();
                $("#distrito_filter").empty();
                $("#provincia_filter").empty();
                $("#provincia_filter").append("<option value=''>--Todos--</option>");
                customtable
                    .column(lengthtable - 2)
                    .search("")
                    .draw();
                $("#distrito_filter").append("<option value=''>--Todos--</option>");

                customtable
                    .column(lengthtable - 1)
                    .search("")
                    .draw();

                if (value) {
                    const getProvincias = async (departamento) => {
                        const res = await fetch(`/api/provincias/${departamento}`);
                        const data = await res.json();
                        if (data) {
                            $("#provincia_filter").empty();
                            let content = "";
                            data.forEach((data) => {
                                content +=
                                    `<option value="${data.id}">${data.provincia}</option>`
                            })
                            $("#provincia_filter").append(
                                "<option value=''>--Todos--</option>");
                            $("#provincia_filter").append(content);
                        }
                    }
                    getProvincias(value);
                }
            })
            $("#provincia_filter").on("change", function(e) {
                let value = e.target.value;

                let valuef = value ? '^' + value + '$' : ''
                let lengthtable = columns_datatables.length;
                customtable
                    .column(lengthtable - 2)
                    .search(valuef, true, false)
                    .draw();
                $("#distrito_filter").empty();
                $("#distrito_filter").html("<option value=''>--Todos--</option>");
                customtable
                    .column(lengthtable - 1)
                    .search("")
                    .draw();
                if (value) {
                    const getDistritos = async (departamento, provincia) => {
                        const res = await fetch(`/api/distritos/${departamento}/${provincia}`);
                        const data = await res.json();
                        if (data) {
                            $("#distrito_filter").empty();
                            let content = "";
                            data.forEach((data) => {
                                content +=
                                    `<option value="${data.id}">${data.distrito}</option>`
                            })
                            $("#distrito_filter").append(
                                "<option value=''>--Todos--</option>");
                            $("#distrito_filter").append(content);
                        }
                    }
                    getDistritos($("#departamento_filter").val(), value);
                }
            })
            $("#distrito_filter").on("change", function(e) {
                let value = e.target.value;
                let valuef = value ? '^' + value + '$' : ''
                let lengthtable = columns_datatables.length;
                customtable
                    .column(lengthtable - 1)
                    .search(valuef, true, false)
                    .draw();

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
                    try {
                        formData.append('perfil', CKEDITOR.instances['perfil_ic'].getData());
                    } catch (e) {}
                    try {
                        formData.append('evaluacion', CKEDITOR.instances['evaluacion_ic'].getData());
                    } catch (e) {}
                    try {
                        formData.append('observaciones', CKEDITOR.instances['observaciones_ic'].getData());
                    } catch (e) {}
                    try {
                        formData.append('sugerencias', CKEDITOR.instances['sugerencias_ic'].getData());
                    } catch (e) {}
                    try {
                        formData.append('referencias', CKEDITOR.instances['referencias_ic'].getData());
                    } catch (e) {}

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
                    try {
                        objtValues['perfil'] = CKEDITOR.instances['perfil_ie'].getData();
                    } catch (e) {}
                    try {
                        objtValues['evaluacion'] = CKEDITOR.instances['evaluacion_ie'].getData();
                    } catch (e) {}
                    try {
                        objtValues['observaciones'] = CKEDITOR.instances['observaciones_ie'].getData();
                    } catch (e) {}
                    try {
                        objtValues['sugerencias'] = CKEDITOR.instances['sugerencias_ie'].getData();
                    } catch (e) {}
                    try {
                        objtValues['referencias'] = CKEDITOR.instances['referencias_ie'].getData();
                    } catch (e) {}


                    $.ajax({
                        url: `/api/personal_web/${objtValues.id}`,
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
            const renderDatatable = function() {
                columns_datatables.push({
                    data: "personal.departamento",
                    render: function(data) {
                        return "";
                    },
                    visible: false
                });
                columns_datatables.push({
                    data: "personal.provincia",
                    render: function(data) {
                        return "";
                    },
                    visible: false
                });
                columns_datatables.push({
                    data: "personal.distrito",
                    render: function(data) {
                        return "";
                    },
                    visible: false
                });
                customtable = $("#datatable").DataTable({
                    "serverSide": true,
                    "ajax": {
                        "url": "/api/personal/pagination_web",
                        "type": "POST",
                        "dataSrc": function(data) {

                            datos = data.data;
                            return data.data;
                        }
                    },
                    "columns": columns_datatables,

                    "processing": true,
                    "pagingType": "numbers",
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json"
                    }

                });
                customtable.on('draw', function(ev) {
                    let i = 1;
                    if (customtable.context[0]) {
                        i += customtable.context[0]._iDisplayStart;
                    }
                    customtable.cells(null, 1, {
                        search: 'applied',
                        order: 'applied',
                    }).every(function(cell) {
                        this.data(i++);
                    });
                }).draw();
            }
            $("#exportToExcel").on("click", function() {
                if (typeof XLSX == 'undefined') XLSX = require('xlsx');
                var ws = XLSX.utils.table_to_sheet(document.getElementById('datatable'));
                var wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, "SheetJS");
                XLSX.writeFile(wb, "reporte.xlsx");
            });
        });
        async function modalElecciones(ev) {
            let value = $(ev).attr("idvalue");
            let response = await fetch("/get_elecciones_vigentes");
            let dataresponse = await response.json();
            if (dataresponse.status) {
                let buttons = "";
                dataresponse.data.forEach((elecion) => {
                    buttons +=
                        `<a class="btn btn-primary mx-2 my-2" href="/elecciones_voto/${elecion.id}/Manual?${value}" target="_blank">${elecion.nombre}</a>`;
                });
                $("#content_elecciones").empty();
                $("#content_elecciones").append(buttons);
                $("#eleccionesModal").modal("show");
            }
            console.log(dataresponse);
        }

        const handleEditCv = function(e) {
            let id = $(e).attr("objectid");
            let object = datos.find(x => x.id == id);
            $("#id_ie").val(id);
            $("#cvPdf").attr("src", `/storage/${object.cv}`);
            $("#cvModal").modal("show");
        }
        const handleEditImagen = function(e) {
            let id = $(e).attr("objectid");
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
                    try {
                        CKEDITOR.instances['perfil_ie'].setData(html);
                    } catch (e) {}
                }
                if (item.evaluacion) {
                    let doc2 = parser.parseFromString(item.evaluacion, 'text/html');
                    html2 = doc2.body.firstChild.data;
                    try {
                        CKEDITOR.instances['evaluacion_ie'].setData(html2);
                    } catch (e) {}
                }
                if (item.observaciones && item.sugerencias) {
                    let doc3 = parser.parseFromString(item.observaciones, 'text/html');
                    html3 = doc3.body.firstChild.data;
                    try {
                        CKEDITOR.instances['observaciones_ie'].setData(html3);
                    } catch (e) {}

                }
                if (item.sugerencias) {

                    let doc4 = parser.parseFromString(item.sugerencias, 'text/html');
                    html4 = doc4.body.firstChild.data;
                    try {
                        CKEDITOR.instances['sugerencias_ie'].setData(html4);
                    } catch (e) {}
                }
                if (item.referencias) {
                    let doc5 = parser.parseFromString(item.referencias, 'text/html');
                    let html5 = doc5.body.firstChild.data;
                    try {
                        CKEDITOR.instances['referencias_ie'].setData(html5);
                    } catch (e) {}
                }
                $("#url_facebook_ie").val(item.url_facebook);
                $("#url_1_ie").val(item.url_1);
                $("#funcion_id_ie").val(item.funcion_id);
                $("#url_2_ie").val(item.url_2);
                $("#nombreCorto_ie").val(item.nombreCorto);
                $("#telefono_ie").val(item.telefono);
                $("#nro_mesa_ie").val(item.nro_mesa);
                $("#estado_ie").val(item.estado);
                $("#vinculo_id_ie").val(item.vinculo_id);
                $("#dni_ie").val(item.dni);
                $("#clave_ie").val(item.clave);
                let fecha_ingreso = moment(item.fecha_ingreso).format('DD/MM/YY');
                $("#fecha_ingreso_ie").val(fecha_ingreso);
                $("#correo_ie").val(item.correo);
                $("#tipo_usuarios_id_ie").val(item.tipo_usuarios_id);
                $("#tipo_ubigeo_id_ie").val(item.tipo_ubigeo_id);
                if (item.departamento) {
                    $("#departamento_ie").val(item.departamento);
                    let value = item.departamento;
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
                                if (item.provincia) {

                                    $("#provincia_ie").val(item.provincia);
                                }
                            }
                        }
                        getProvincias(value);
                    }
                }
                if (item.provincia) {

                    let value = item.provincia;
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
                                if (item.distrito) {

                                    $("#distrito_ie").val(item.distrito);
                                }
                            }
                        }

                        getDistritos(item.departamento, value);
                    }
                }

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
