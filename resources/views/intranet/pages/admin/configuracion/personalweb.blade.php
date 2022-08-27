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
    $permisos = [];
    if ($personal) {
        foreach ($personal->asignaciones as $asignacion) {
            $permisos[] = $asignacion->permiso->nombre;
        }
    }
    ?>

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
                                            @if (in_array('Nombres y apellidos', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Nombres</label>
                                                        <input type="hidden" name="user_id"
                                                            value="{{ auth()->user()->id }}">
                                                        <input type="text" name="nombres" class="form-control"
                                                            id="nombres_ic">
                                                        <div class="invalid-feedback" id="invalidNombresCreate">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('Nombre corto', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Nombre Corto</label>
                                                        <input type="text" name="nombre_corto" class="form-control"
                                                            id="nombre_corto_ic">

                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('Teléfono', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Telefono</label>
                                                        <input type="text" name="telefono" class="form-control"
                                                            id="telefono_corto_ic">

                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('DNI', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Dni</label>
                                                        <input type="text" required name="dni" class="form-control"
                                                            id="dni_ic">

                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('Correo', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Correo</label>
                                                        <input type="text" required name="correo" class="form-control"
                                                            id="correo_ic">

                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('Clave', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Clave</label>
                                                        <input type="text" required name="clave" class="form-control"
                                                            id="clave_ic">

                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('Fecha ingreso', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Fecha ingreso</label>
                                                        <input type="date" name="fecha_ingreso" class="form-control"
                                                            id="fecha_ingreso_ic">

                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('Cargo 2', $permisos) || !$personal)
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
                                            @endif
                                            @if (in_array('Vínculo', $permisos) || !$personal)
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
                                            @endif
                                            @if (in_array('Tipo usuario', $permisos) || !$personal)
                                                <div class="col-md-4">
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
                                            @endif
                                            @if (in_array('Tipo ubigeo', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Tipo ubigeo</label>
                                                        <select name="tipo_ubigeo" class="form-control"
                                                            id="tipo_ubigeo_ic">
                                                            <option value=""> -- Seleccione -- </option>
                                                            @foreach ($tipoUbigeos as $tipoUbigeo)
                                                                <option value="{{ $tipoUbigeo->id }}">
                                                                    {{ $tipoUbigeo->nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('Cargo 2', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Funcion</label>
                                                        <select name="funcion_id" class="form-control"
                                                            id="funcion_id_ic">
                                                            <option value=""> -- Seleccione -- </option>
                                                            @foreach ($funciones as $funcion)
                                                                <option value="{{ $funcion->id }}">
                                                                    {{ $funcion->nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif

                                            @if (in_array('Estado', $permisos) || !$personal)
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
                                            @endif
                                            @if (in_array('Departamento', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Departamento</label>
                                                        <select name="departamento" class="form-control"
                                                            id="departamento">
                                                            <option value=""> -- Seleccione -- </option>
                                                            @foreach ($departamentos as $departamento)
                                                                <option value="{{ $departamento->id }}">
                                                                    {{ $departamento->departamento }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('Provincia', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Provincia</label>
                                                        <select name="provincia" class="form-control" id="provincia">
                                                            <option value=""> -- Seleccione -- </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('Distrito', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Distrito</label>
                                                        <select name="distrito" class="form-control" id="distrito">
                                                            <option value=""> -- Seleccione -- </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('Foto', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Foto</label>
                                                        <input type="file" name="foto" class="form-control"
                                                            id="foto_ic">

                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('CV', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Cv</label>
                                                        <input type="file" name="cv" class="form-control"
                                                            id="cv_ic">

                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('Facebook', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Url facebook</label>
                                                        <input type="text" name="url_facebook" class="form-control"
                                                            id="url_facebook_ic">

                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('WhatsApp', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Url 1</label>
                                                        <input type="text" name="url_1" class="form-control"
                                                            id="url_1_ic">

                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('Instagram', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Url 2</label>
                                                        <input type="text" name="url_2" class="form-control"
                                                            id="url_2_ic">

                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Tarea</label>
                                                    <input type="text" name="nro_mesa" class="form-control"
                                                        id="nro_mesa_ic">

                                                </div>
                                            </div>
                                            @if (in_array('PPD', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">PPD</label>
                                                        <input type="text" name="ppd" class="form-control"
                                                            id="ppd_ic">
                                                    </div>
                                                </div>
                                            @endif

                                            @if (in_array('Referencias', $permisos) || !$personal)
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            Referencias
                                                        </label>
                                                        <textarea class="form-control ckeditor" name="referencias" id="referencias_ic"></textarea>


                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('Perfil', $permisos) || !$personal)
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            Perfil
                                                        </label>
                                                        <textarea class="form-control ckeditor" name="perfil" id="perfil_ic"></textarea>


                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('Evaluación', $permisos) || !$personal)
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            Evaluacion
                                                        </label>
                                                        <textarea class="form-control ckeditor" name="evaluacion" id="evaluacion_ic"></textarea>


                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('Observaciones', $permisos) || !$personal)
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            Observaciones
                                                        </label>
                                                        <textarea class="form-control ckeditor" name="observaciones" id="observaciones_ic"></textarea>


                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('Sugerencias', $permisos) || !$personal)
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            Sugerencias
                                                        </label>
                                                        <textarea class="form-control ckeditor" name="sugerencias" id="sugerencias_ic"></textarea>
                                                    </div>
                                                </div>
                                            @endif
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
                        <div class="modal-dialog modal-lg modal-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Editar</h5>
                                    <span aria-hidden="true" class="close c-p close-modall" data-dismiss="modal"
                                        aria-label="Close">&times;</span>
                                </div>
                                <div class="modal-body">
                                    <form action="" id="editForm">
                                        <div class="row">
                                            @if (in_array('Nombres y apellidos', $permisos) || !$personal)
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
                                            @endif
                                            @if (in_array('Nombre corto', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Nombre Corto</label>
                                                        <input type="text" name="nombre_corto" class="form-control"
                                                            id="nombreCorto_ie">

                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('Teléfono', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Telefono</label>
                                                        <input type="text" name="telefono" class="form-control"
                                                            id="telefono_ie">

                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('DNI', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Dni</label>
                                                        <input type="text" required name="dni"
                                                            class="form-control" id="dni_ie">

                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('Correo', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Correo</label>
                                                        <input type="text" required name="correo"
                                                            class="form-control" id="correo_ie">

                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Clave</label>
                                                    <input type="text" required name="clave" class="form-control"
                                                        id="clave_ie">
                                                </div>
                                            </div>

                                            @if (in_array('Fecha ingreso', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Fecha ingreso</label>
                                                        <input type="date" name="fecha_ingreso" class="form-control"
                                                            id="fecha_ingreso_ie">
                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('Cargo 2', $permisos) || !$personal)
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
                                            @endif
                                            @if (in_array('Vínculo', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Vinculo</label>
                                                        <select name="vinculo_id" class="form-control"
                                                            id="vinculo_id_ie">

                                                            <option value=""> -- Seleccione -- </option>
                                                            @foreach ($vinculos as $vinculo)
                                                                <option value="{{ $vinculo->id }}">
                                                                    {{ $vinculo->nombre }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('Tipo usuario', $permisos) || !$personal)
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
                                            @endif
                                            @if (in_array('Tipo ubigeo', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Tipo ubigeo</label>
                                                        <select name="tipo_ubigeo" class="form-control"
                                                            id="tipo_ubigeo_ie">
                                                            <option value=""> -- Seleccione -- </option>
                                                            @foreach ($tipoUbigeos as $tipoUbigeo)
                                                                <option value="{{ $tipoUbigeo->id }}">
                                                                    {{ $tipoUbigeo->nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif

                                            @if (in_array('Función', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Funcion</label>
                                                        <select name="funcion_id" class="form-control"
                                                            id="funcion_id_ie">
                                                            <option value=""> -- Seleccione -- </option>
                                                            @foreach ($funciones as $funcion)
                                                                <option value="{{ $funcion->id }}">
                                                                    {{ $funcion->nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('Estado', $permisos) || !$personal)
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
                                            @endif
                                            @if (in_array('Departamento', $permisos) || !$personal)
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
                                            @endif
                                            @if (in_array('Provincia', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Provincia</label>
                                                        <select name="provincia" class="form-control" id="provincia_ie">
                                                            <option value=""> -- Seleccione -- </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('Distrito', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Distrito</label>
                                                        <select name="distrito" class="form-control" id="distrito_ie">
                                                            <option value=""> -- Seleccione -- </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('Facebook', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Url facebook</label>
                                                        <input type="text" name="url_facebook" class="form-control"
                                                            id="url_facebook_ie">

                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('WhatsApp', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Url 1</label>
                                                        <input type="text" name="url_1" class="form-control"
                                                            id="url_1_ie">

                                                    </div>
                                                </div>
                                            @endif

                                            @if (in_array('Instagram', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Url 2</label>
                                                        <input type="text" name="url_2" class="form-control"
                                                            id="url_2_ie">

                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Tarea</label>
                                                    <input type="text" name="nro_mesa" class="form-control"
                                                        id="nro_mesa_ie">

                                                </div>
                                            </div>
                                            @if (in_array('PPD', $permisos) || !$personal)
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">PPD</label>
                                                        <input type="text" name="ppd" class="form-control"
                                                            id="ppd_ie">

                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('Referencias', $permisos) || !$personal)
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            Referencias
                                                        </label>
                                                        <textarea class="form-control ckeditor" name="referencias" id="referencias_ie"></textarea>


                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('Perfil', $permisos) || !$personal)
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            Perfil
                                                        </label>
                                                        <textarea class="form-control ckeditor" name="perfil" id="perfil_ie"></textarea>


                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('Evaluación', $permisos) || !$personal)
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            Evaluacion
                                                        </label>
                                                        <textarea class="form-control ckeditor" name="evaluacion" id="evaluacion_ie"></textarea>


                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('Observaciones', $permisos) || !$personal)
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            Observaciones
                                                        </label>
                                                        <textarea class="form-control ckeditor" name="observaciones" id="observaciones_ie"></textarea>


                                                    </div>
                                                </div>
                                            @endif
                                            @if (in_array('Sugerencias', $permisos) || !$personal)
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">
                                                            Sugerencias
                                                        </label>
                                                        <textarea class="form-control ckeditor" name="sugerencias" id="sugerencias_ie"></textarea>
                                                    </div>
                                                </div>
                                            @endif
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
                <div class="card">

                    <div class="card-header bg-secondary">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="text-white">Personal</h5>
                                @if (auth()->user()->personal)
                                    <input type="hidden" name="user_autenticated"
                                        value="{{ auth()->user()->personal->id }}" id="user_autenticated">
                                @endif
                            </div>
                            <div class="col-md-6 d-flex justify-content-end my-2">
                              
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
                                @if ($personal)
                                    <tr>
                                        <th>Accion</th>
                                        @if (in_array('Id', $permisos))
                                            <th> id</th>
                                        @endif
                                        @if (in_array('Nombres y apellidos', $permisos))
                                            <th> Nombres y Apellidos</th>
                                        @endif
                                        @if (in_array('Estado', $permisos))
                                            <th> Estado</th>
                                        @endif


                                        @if (in_array('Perfil', $permisos))
                                            <th> Perfil</th>
                                        @endif
                                        @if (in_array('Foto', $permisos))
                                            <th> Foto</th>
                                        @endif
                                        @if (in_array('CV', $permisos))
                                            <th> Cv</th>
                                        @endif
                                        @if (in_array('Evaluación', $permisos))
                                            <th>Evaluacion</th>
                                        @endif
                                        @if (in_array('PPD', $permisos))
                                            <th> PPD</th>
                                        @endif
                                        @if (in_array('Facebook', $permisos))
                                            <th> URL_facebook</th>
                                        @endif
                                        @if (in_array('WhatsApp', $permisos))
                                            <th> URL_1</th>
                                        @endif
                                        @if (in_array('Instagram', $permisos))
                                            <th> URL_1</th>
                                        @endif
                                        @if (in_array('Cargo 2', $permisos))
                                            <th>Función</th>
                                        @endif
                                        @if (in_array('Nombre corto', $permisos))
                                            <th> Nombre Corto</th>
                                        @endif
                                        @if (in_array('Teléfono', $permisos))
                                            <th> Telefono</th>
                                        @endif
                                        @if (in_array('Referencias', $permisos))
                                            <th> Referencias</th>
                                        @endif

                                        @if (in_array('Vínculo', $permisos))
                                            <th>Vinculo</th>
                                        @endif
                                        @if (in_array('DNI', $permisos))
                                            <th> Dni</th>
                                        @endif
                                        @if (in_array('Clave', $permisos))
                                            <th> Clave</th>
                                        @endif
                                        @if (in_array('Fecha ingreso', $permisos))
                                            <th> Fec.Ingreso</th>
                                        @endif
                                        @if (in_array('Correo', $permisos))
                                            <th> Correo</th>
                                        @endif
                                        @if (in_array('Sugerencias', $permisos))
                                            <th> Sugerencias</th>
                                        @endif
                                        @if (in_array('Tipo usuario', $permisos))
                                            <th>Tipo de Usuario</th>
                                        @endif
                                        @if (in_array('Asignar usuarios', $permisos))
                                            <th> Asignar Usuarios</th>
                                        @endif
                                        @if (in_array('Observaciones', $permisos))
                                            <th> Observaciones</th>
                                        @endif
                                        @if (in_array('Tipo ubigeo', $permisos))
                                            <th> Tipo Ubigeo</th>
                                        @endif
                                        @if (in_array('Roles', $permisos))
                                            <th> Roles</th>
                                        @endif
                                        @if (in_array('Departamento', $permisos))
                                            <th> Departamento</th>
                                        @endif
                                        @if (in_array('Provincia', $permisos))
                                            <th> Provincia</th>
                                        @endif
                                        @if (in_array('Distrito', $permisos))
                                            <th> Distrito</th>
                                        @endif
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                @else
                                    <tr>
                                        <th>Accion</th>
                                        <th> id</th>
                                        <th> Nombres y Apellidos</th>


                                        <th> Estado</th>
                                        <th> Perfil</th>
                                        <th> Foto</th>
                                        <th> Cv</th>
                                        <th>Evaluacion</th>
                                        <th> PPD</th>
                                        <th> URL_facebook</th>
                                        <th> URL_1</th>
                                        <th> URL_1</th>
                                        <th>Función</th>
                                        <th> Nombre Corto</th>
                                        <th> Telefono</th>
                                        <th> Referencias</th>
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
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                @endif
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
        var columns_reference = [{
                name: "Personal",
                level: 1,
                value: {}
            },
            {
                name: "Id",
                level: 2,
                value: {
                    data: "id"
                }
            },
            {
                name: "Nombres y apellidos",
                level: 2,
                value: {
                    data: "nombres",
                    render: function(data) {
                        return data ? data : "";
                    }
                },
            },
            {
                name: "Estado",
                level: 2,
                value: {
                    data: "_estado.nombre",
                    render: function(data) {
                        return data ? data : "";
                    }
                },

            },

            {
                name: "Perfil",
                level: 2,
                value: {
                    data: "perfil",
                    render: function(data, row, type) {
                        return `<span objectid="${type.id}"  onclick="handleViewProfile(this)" class="btn btn-primary btn-sm" >Perfil</span>`;
                    }

                },
            },
            {
                name: "Foto",
                level: 2,
                value: {
                    data: "foto",
                    render: function(data, row, type) {
                        return `<span objectid="${type.id}"  onclick="handleEditImagen(this)" class="btn btn-primary btn-sm" >Foto</span>`;
                    }
                },
            },
            {
                name: "CV",
                level: 2,
                value: {
                    data: "cv",
                    render: function(data, row, type) {
                        return `<span objectid="${type.id}"  onclick="handleEditCv(this)" class="btn btn-primary btn-sm" >CV</span>`;
                    }
                },
            },
            {
                name: "Evaluación",
                level: 2,
                value: {
                    data: "evaluacion",
                    render: function(data, row, type) {
                        return `<span objectid="${type.id}"  onclick="handleViewEvaluacion(this)" class="btn btn-primary btn-sm" >Evaluacion</span>`;
                    }
                },
            }, {
                name: "PPD",
                level: 2,
                value: {
                    data: "ppd",
                    render: function(data) {
                        return data ? data : "";
                    }
                },
            },
            {
                name: "Facebook",
                level: 2,
                value: {
                    data: "url_facebook",
                    render: function(data) {
                        return `<a href="${data}" target="_blank">${data}</a>`
                    }
                },

            },
            {
                name: "WhatsApp",
                level: 2,
                value: {
                    data: "url_1",
                    render: function(data) {

                        return `<a href="${data}" target="_blank">${data}</a>`
                    }
                },

            },
            {
                name: "Instagram",
                level: 2,
                value: {
                    data: "url_2",
                    render: function(data) {

                        return `<a href="${data}" target="_blank">${data}</a>`
                    }
                }
            },
            {
                name: "Cargo 2",
                level: 2,
                value: {
                    data: "funcion.nombre",
                    render: function(data) {
                        return data ? data : "";
                    }
                },
            },
            {
                name: "Nombre corto",
                level: 2,
                value: {
                    data: "nombreCorto",
                    render: function(data) {
                        return data ? data : "";
                    }
                },
            },
            {
                name: "Teléfono",
                level: 2,
                value: {
                    data: "telefono",
                    render: function(data) {
                        return data ? data : "";
                    }
                },
            },
            {
                name: "Referencias",
                level: 2,
                value: {
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
                }

            },
            {
                name: "Vínculo",
                level: 2,
                value: {
                    data: "vinculo.nombre",
                    render: function(data) {
                        return data ? data : "";
                    }
                },

            },
            {
                name: "DNI",
                level: 2,
                value: {
                    data: "dni",
                    render: function(data) {
                        return data ? data : "";
                    }
                },
            },
            {
                name: "Fecha ingreso",
                level: 2,
                value: {
                    data: "fecha_ingreso",
                    render: function(data) {

                        return data ? moment(data).format('DD/MM/YY') : moment().format(
                            'DD/MM/YY');
                    }
                }

            },
            {
                name: "Correo",
                level: 2,
                value: {
                    data: "correo",
                    render: function(data) {
                        return data ? data : "";
                    }
                }

            },
            {
                name: "Observaciones",
                level: 2,
                value: {
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

            },
            {
                name: "Departamento",
                level: 2,
                value: {
                    data: "_departamento.departamento",
                    render: function(data) {
                        return data ? data : "";
                    }
                },

            },
            {
                name: "Provincia",
                level: 2,
                value: {
                    data: "_provincia.provincia",
                    render: function(data) {
                        return data ? data : "";
                    }
                },

            },
            {
                name: "Distrito",
                level: 2,
                value: {
                    data: "_distrito.distrito",
                    render: function(data) {
                        return data ? data : "";
                    }
                },
            }
        ];
        var columns_datatables_default = [{
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
            }, {
                data: "_estado.nombre",
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
                data: "ppd",
                render: function(data) {
                    return data ? data : "";
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
                searchable: false,
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
                    return `<span objectid="${type.id}" onclick="handleRoles(this)" class="btn btn-primary btn-sm">Asignar roles</span>`;
                }
            },
            {
                data: "_departamento.departamento",
                render: function(data) {
                    return data ? data : "";
                }
            },
            {
                data: "_provincia.provincia",
                render: function(data) {
                    return data ? data : "";
                }
            },
            {
                data: "_distrito.distrito",
                render: function(data) {
                    return data ? data : "";
                }
            }

        ];
        $(document).ready(function() {
            const handlePermisos = async function() {
                const id = $("#user_autenticated").val();
                if (id) {
                    const item = datos.find((item) => item.id == id);
                    let response = await fetch(`/api/personal/obtenerRoles/${id}`);
                    let data = await response.json();
                    return data;
                } else {
                    return [];
                }
            };
            handlePermisos().then((data) => {
                const id = $("#user_autenticated").val();
                if (!id) {
                    columns_datatables = columns_datatables_default;
                    renderDatatable();
                } else {
                    data.forEach(data => {
                        permisos_table.push({
                            name: data.permiso.nombre,
                            level: data.permiso.nivel
                        });
                    })
                    let tablecolumns = [];
                    columns_reference.forEach(column => {
                        if (permisos_table.find(item => item.name == column.name)) {
                            tablecolumns.push(column.value);
                        }
                    })
                    columns_datatables = [];
                    columns_datatables_default.forEach((item, index) => {
                        if (index == 0) {
                            columns_datatables.push(item);
                        } else {
                            if (tablecolumns.find((item2) => item2.data == item.data)) {
                                columns_datatables.push(item);
                            }
                        }
                    })
                    console.log(columns_datatables);
                    console.log(columns_datatables_default);
                    renderDatatable();
                }
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
                let lengthtable=columns_datatables.length;
                let valuef=value ? '^' + value + '$' : ''
                customtable
                    .column(lengthtable-3)
                    .search(valuef,true,false)
                    .draw();
                $("#distrito_filter").empty();
                $("#provincia_filter").empty();
                $("#provincia_filter").append("<option value=''>--Todos--</option>");
                customtable
                    .column(lengthtable-2)
                    .search("")
                    .draw();
                $("#distrito_filter").append("<option value=''>--Todos--</option>");

                customtable
                    .column(lengthtable-1)
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
                
                let valuef=value ? '^' + value + '$' : ''
                let lengthtable=columns_datatables.length;
                customtable
                    .column(lengthtable-2)
                    .search(valuef,true,false)
                    .draw();
                $("#distrito_filter").empty();
                $("#distrito_filter").html("<option value=''>--Todos--</option>");
                customtable
                    .column(lengthtable-1)
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
                let valuef=value ? '^' + value + '$' : ''
                let lengthtable=columns_datatables.length;
                customtable
                    .column(lengthtable-1)
                    .search(valuef,true,false)
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
                    try {
                        formData.append('perfil', CKEDITOR.instances['perfil_ic'].getData());
                        formData.append('evaluacion', CKEDITOR.instances['evaluacion_ic'].getData());
                        formData.append('observaciones', CKEDITOR.instances['observaciones_ic'].getData());
                        formData.append('sugerencias', CKEDITOR.instances['sugerencias_ic'].getData());
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
            const renderDatatable = function() {
                columns_datatables.push({
                    data: "departamento",
                    render: function(data) {
                        return "";
                    },
                    visible: false
                });
                columns_datatables.push({
                    data: "provincia",
                    render: function(data) {
                        return "";
                    },
                    visible: false
                });
                columns_datatables.push({
                    data: "distrito",
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
                            console.log(data);
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
            }
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
                    console.log("provincia existe");

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
