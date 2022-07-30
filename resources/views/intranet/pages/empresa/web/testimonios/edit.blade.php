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
                        <div class="col-6"><h5 class="mb-0">Editar Testimonio</h5></div>
                        <div class="col-6">
                            <!--<button type="button" class="btn btn-success" style="float: right" data-bs-toggle="modal" data-bs-target="#exampleModal">Nuevo</button>-->
                        </div>
                    </div>

                    <p class="text-sm mb-0">
                        <!--Cambio de contraseña-->
                    </p>
                </div>
                <div style="padding-left: 10%;padding-right:10%;padding-top:3%;padding-bottom:5%;">
                    <form action="{{ route('testimonios.update', $testimonio->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label for="">ID</label>
                                <?php $testimonios = App\Models\Testimonio::where('idUsuario', auth()->user()->id)->get(); ?>
                                <input type="text" name="id" class="multisteps-form__input form-control" value="{{ count($testimonios) +1 }}" disabled>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label for="">Nombre</label>
                                <input type="text" name="nombre" class="multisteps-form__input form-control" value="{{$testimonio->nombre}}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label for="">Orden</label>
                                <input type="number" name="orden" class="multisteps-form__input form-control" value="{{$testimonio->orden}}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label for="">URL</label>
                                <input type="text" name="url" class="multisteps-form__input form-control" value="{{$testimonio->url}}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label for="">Texto</label>
                                <textarea class=" multisteps-form__input form-control ckeditor" name="texto" id="editor1" rows="10" cols="58">{{$testimonio->texto}}</textarea>
                                
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label for="">Imagen</label>
                                <!--<form action="/file-upload" class="form-control dropzone" id="dropzone">
                                    <div class="fallback">-->
                                        <input name="imagen" type="file"  />
                                    <!--</div>
                                </form>-->
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <button class="btn btn-success" style="margin-top: 10%;width:100%">Guardar</button>
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