@extends('intranet.layouts.layout')

@section('style')
    
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6"><h5 class="mb-0">Crear Publicacion</h5></div>
                        <div class="col-6">
                            <!--<button type="button" class="btn btn-success" style="float: right" data-bs-toggle="modal" data-bs-target="#exampleModal">Nuevo</button>-->
                        </div>
                    </div>

                    <p class="text-sm mb-0">
                        <!--Cambio de contraseña-->
                    </p>
                </div>
                <div style="padding-left: 10%;padding-right:10%;padding-top:3%;padding-bottom:5%;">
                    <form action="{{ route('publicaciones.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label for="">ID</label>
                                <?php $publicaciones = App\Models\Publicacion::where('idUsuario', auth()->user()->id)->get(); ?>
                                <input type="text" name="id" class="multisteps-form__input form-control" value="{{ count($publicaciones) + 1}}" disabled>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label for="">Nombre</label>
                                <input type="text" name="nombre" class="multisteps-form__input form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label for="">Orden</label>
                                <input type="number" name="orden" class="multisteps-form__input form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label for="">URL</label>
                                <input type="text" name="url" class="multisteps-form__input form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label for="">Texto</label>
                                <textarea class=" multisteps-form__input form-control ckeditor" name="texto" id="editor1" rows="10" cols="58"></textarea>
                                
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <?php $configuraciones = App\Models\Configuracion::all(); ?>
                                <label for="">Configuracion </label>
                                <select name="idConfiguracion" id="" class="multisteps-form__input form-control">
                                    @foreach ($configuraciones as $configuracion)
                                    <option value="{{$configuracion->id}}">{{$configuracion->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label for="">Modelo de Bloque </label>
                                <br>
                                <select name="modelo" id="" placeholder="Modelo de Bloque" class="multisteps-form__input form-control">
                                    <option value="Bloque 1">Bloque 1</option>
                                    <option value="Bloque 2">Bloque 2</option>
                                    <option value="Bloque 3">Bloque 3</option>
                                    <option value="Bloque 4">Bloque 4</option>
                                    <option value="Bloque 5">Bloque 5</option>
                                    <option value="Bloque 6">Bloque 6</option>
                                </select>
                            </div>
                            
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label for="">Seleccione Imagen/Video </label>
                                <select name="selecciona" id="" class="multisteps-form__input form-control">
                                    <option value="Imagen">Imagen</option>
                                    <option value="Video">Video</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label for="">Imagen</label><br>
                                <!--<form action="/file-upload" class="form-control dropzone" id="dropzone">
                                    <div class="fallback">-->
                                        <input name="imagen" type="file"  />
                                    <!--</div>
                                </form>-->
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label for="">Link de Video</label>
                                <input type="text" name="video" class="multisteps-form__input form-control">
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <button class="btn btn-success" style="margin-top: 10%;width:100%">Crear</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
{{--<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>--}}
<script src="{{ asset('admin/assets/js/plugins/dropzone.min.js') }}"></script>
<script src="//cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>

@endsection