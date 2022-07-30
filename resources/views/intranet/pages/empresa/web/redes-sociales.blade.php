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
                        <div class="col-6"><h5 class="mb-0">Redes Sociales</h5></div>
                        <div class="col-6">
                            <!--<button type="button" class="btn btn-success" style="float: right" data-bs-toggle="modal" data-bs-target="#exampleModal">Nuevo</button>-->
                        </div>
                    </div>

                    <p class="text-sm mb-0">
                        <!--Cambio de contraseña-->
                    </p>
                </div>
                <div style="padding-left: 10%;padding-right:10%;padding-top:3%;padding-bottom:5%;">
                    <form action="{{ route('redes.update', $redes->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label for="">Facebook</label>
                                <input type="text" name="facebook" class="multisteps-form__input form-control" value="{{$redes->facebook}}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label for="">Twitter</label>
                                <input type="text" name="twitter" class="multisteps-form__input form-control" value="{{$redes->twitter}}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label for="">Instagram</label>
                                <input type="text" name="instagram" class="multisteps-form__input form-control" value="{{$redes->instagram}}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label for="">LinkedIn</label>
                                <input type="text" name="linkedin" class="multisteps-form__input form-control" value="{{$redes->linkedin}}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label for="">Whatsapp</label>
                                <input type="text" name="whatsapp" class="multisteps-form__input form-control" value="{{$redes->whatsapp}}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 col-sm-6">
                                <label for="">Color de Fondo</label>
                                <input class="form-control" type="color" value="{{$redes->colorFondo}}" id="example-color-input" name="colorFondo">
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
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
@endsection