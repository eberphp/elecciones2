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
                        <div class="col-6"><h5 class="mb-0">Datos de la Empresa</h5></div>
                        <div class="col-6">
                            <!--<button type="button" class="btn btn-success" style="float: right" data-bs-toggle="modal" data-bs-target="#exampleModal">Nuevo</button>-->
                        </div>
                    </div>

                    <p class="text-sm mb-0">
                        <!--Cambio de contraseña-->
                    </p>
                </div>
                <div style="padding-left: 10%;padding-right:10%;padding-top:3%;padding-bottom:5%;">
                    <form action="{{ route('datos.update', $datos->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label for="">Nombre</label>
                                <input type="text" name="nombre" class="multisteps-form__input form-control" value="{{$datos->nombre}}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label for="">Favicon</label>
                                {{--<input type="text" name="favicon" class="multisteps-form__input form-control" value="{{$datos->favicon}}">--}}
                                <input type="file" name="favicon" class="multisteps-form__input form-control">
                                <img src="{{ asset('img/favicon/'.$datos->favicon)}}" alt="" style="height: 60px;width: auto;margin-top: 2%;">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label for="">Banner Principal</label>
                                {{--<input type="text" name="bannerPrincipal" class="multisteps-form__input form-control" value="{{$datos->bannerPrincipal}}">--}}
                                <input type="file" name="bannerPrincipal" class="multisteps-form__input form-control">
                                <img src="{{ asset('img/bannerPrincipal/'.$datos->bannerPrincipal)}}" alt="" style="height: 60px;width: auto;margin-top: 2%;">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label for="">Telefono 1</label>
                                <input type="text" name="telefono1" class="multisteps-form__input form-control" value="{{$datos->telefono1}}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label for="">Telefono 2</label>
                                <input type="text" name="telefono2" class="multisteps-form__input form-control" value="{{$datos->telefono2}}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label for="">Correo</label>
                                <input type="text" name="correo" class="multisteps-form__input form-control" value="{{$datos->correo}}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label for="">Pié de Página</label>
                                <textarea class=" multisteps-form__input form-control ckeditor" name="piePagina" id="editor1" rows="10" cols="58">{{$datos->piePagina}}</textarea>
                                
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label for="">Termino y Condiciones</label>
                                <textarea class=" multisteps-form__input form-control ckeditor" name="terminoCondiciones" id="editor1" rows="10" cols="58">{{$datos->terminoCondiciones}}</textarea>
                                
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label for="">Derechos</label>
                                <input type="text" name="derechos" class="multisteps-form__input form-control" value="{{$datos->derechos}}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <button class="btn btn-success" style="margin-top: 10%;width:100%">Actualizar</button>
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
<script src="//cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>
@endsection