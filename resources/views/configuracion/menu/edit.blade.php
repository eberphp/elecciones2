@extends('layouts.admin')
@section('contenido')
    {!! Form::open(['url' => route('menu.update', $menu->idMenu), 'method' => 'PUT', 'autocomplete' => 'off', 'files' => true]) !!}
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="modal-title title_header font-weight-bold" id="exampleModalLongTitle">
                        Editar |
                        {{ $componentName }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Cod. Menu</label>
                                        <div class="input-group a mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><span class="fas fa-barcode fa-2x-x"></span>
                                            </div>
                                            <input type="hidden" name="idMenu" id=""
                                                value="{{ $menu->idMenu }}">
                                            <input type="text"
                                                class="form-control fi {{ $errors->has('codMenu') ? 'is-invalid' : '' }}"
                                                name="codMenu" placeholder=""
                                                @if (empty(old('codMenu'))) value="{{ $menu->codMenu }}"
                                             @else
                                                                             value="{{ old('codMenu') }}" @endif>
                                        </div>
                                        @if ($errors->has('codMenu'))
                                            <div>
                                                <span class="text-danger">{{ $errors->first('codMenu') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label>Seleccione estado</label>
                                    <div class="input-group a mb-3">

                                        <div class="input-group-prepend">

                                            <span class="input-group-text"><i class="fa fa-angle-double-right"></i></span>
                                        </div>
                                        <select class="form-control fi selectpicker" name="flag_estatus" id="idMenu"
                                            data-live-search="true" required>
                                            <option value="" selected hidden>Seleccione</option>
                                            @foreach ($estados as $item)
                                                @if ($item ==  $menu->flag_estatus)
                                                    <option value="{{ $item }}" selected>{{ $item }}
                                                    </option>
                                                @else
                                                    <option value="{{ $item }}">{{ $item }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Ingrese descripción<span class="text-danger"></span></label>
                                        <div class="input-group a mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><span class="fas fa-pen fa-2x-x"></span><span
                                                        class=""></span></span>
                                            </div>
                                            <textarea name="description" id="" cols="50" rows="5" class="form-control fi">
@if (empty(old('description')))
{{ $menu->description }}@else{{ old('description') }}
@endif
</textarea>
                                        </div>
                                        @if ($errors->has('description'))
                                            <div>
                                                <span class="text-danger">{{ $errors->first('description') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <div style="margin: 0px auto 0px auto">
                            <div style="margin: 0px auto 0px auto">
                                <a href="{{ route('menu.index') }}" type="button" class="btn btn-danger ">Cancelar</a>
                                <button type="submit" class="btn btn-dark text-white">Modificar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{ Form::close() }}
@endsection
