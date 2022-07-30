{{-- <style>
    .imagen img {
        background: #f8eded;
        width: 100px;
        height: auto;
    }
</style> --}}
<div class="modal fade modal-slide-in-center" aria-hidden="true" role="dialog" tabindex="-1" id="modal-add">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title text-white" id="formModalLabel">Crear
                    {{ $componentName }}
                </h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['url' => 'configuracion/menu', 'method' => 'POST', 'autocomplete' => 'off', 'files' => 'true']) !!}
            {!! Form::token() !!}
            <div class="modal-body">
                <div class="form-group">
                    <label>Cod. Menu</label>
                    <div class="input-group a mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><span class="fas fa-barcode fa-2x-x"></span></span>
                        </div>
                        <input type="text" class="form-control fi" name="codMenu" placeholder="Ingrese cod. Menu"
                            autocomplete="off" value="{{ old('codMenu') }}">
                    </div>
                    {!! $errors->first('codMenu', '<span class="help-block text-danger"><b>:message </b></span>') !!}
                </div>


                <div class="form-group">
                    <label>Seleccione estado</label>
                    <div class="input-group a mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><span class="fa fa-angle-double-right fa-2x-x"></span></span>
                            
                           
                        </div>
                        <select class="form-control fi selectpicker" name="flag_estatus" id="idMenu"
                            data-live-search="true">
                            <option value=" " selected hidden>Seleccionar</option>
                            @foreach ($estados as $item)
                                @if (old('flag_estatus') == $item)
                                    <option value="{{ $item }}">
                                        {{ $item }}</option>
                                @else
                                    <option value="{{ $item }}">
                                        {{ $item }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    {!! $errors->first('flag_estatus', '<span class="help-block text-danger"><b>:message </b></span>') !!}
                </div>

                <div class="form-group">
                    <label>Descripción</label>
                    <div class="input-group a mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><span class="fas fa-pen fa-2x-x"></span></span>
                        </div>
                        <textarea name="description" Step=".01" placeholder="Ingrese descripción " id="" cols="52"
                            rows="5" class="form-control fi">{{ old('description') }}</textarea>
                    </div>
                    {!! $errors->first('description', '<span class="help-block text-danger"><b>:message </b></span>') !!}
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn text-dark" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-dark">Guardar</button>
            </div>
            {{ Form::Close() }}
        </div>
    </div>
</div>
