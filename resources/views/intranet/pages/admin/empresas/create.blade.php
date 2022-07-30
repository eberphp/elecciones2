@extends('intranet.layouts.layout')

@section('style')
    
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="row mb-5">
            <div class="col-12">
                <div class="multisteps-form mb-5">
                    <!--progress bar-->
                    <div class="row">
                        <div class="col-12 col-lg-8 mx-auto my-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="multisteps-form__progress">
                                        <button class="multisteps-form__progress-btn js-active" type="button" title="User Info">
                                            <span>Representante Legal</span>
                                        </button>
                                        <button class="multisteps-form__progress-btn" type="button" title="Address">Usuario</button>
                                        <!--<button class="multisteps-form__progress-btn" type="button" title="Socials">Socials</button>-->
                                        <button class="multisteps-form__progress-btn" type="button" title="Profile">Empresa</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--form panels-->
                    <div class="row">
                        <div class="col-12 col-lg-8 m-auto">
                            <form class="multisteps-form__form mb-8" action="{{ route('empresas.store')}}" method="POST">
                                @csrf
                                <!--single form panel-->
                                <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
                                    <h5 class="font-weight-bolder mb-0">Representante Legal</h5>
                                    <p class="mb-0 text-sm">Datos del Representante Legal</p>
                                    <div class="multisteps-form__content">
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <label>Nombres</label>
                                                <input class="multisteps-form__input form-control" type="text" name="nombres" required/>
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <label>Apellidos</label>
                                                <input class="multisteps-form__input form-control" type="text" name="apellidos" required/>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <label>Telefono</label>
                                                <input class="multisteps-form__input form-control" type="text" name="telefono" required/>
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <label>Nombre Corto</label>
                                                <input class="multisteps-form__input form-control" type="text" name="nombreCorto" required/>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <label>Edad</label>
                                                <input class="multisteps-form__input form-control" type="number" name="edad" required/>
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <label>Fecha Nacimiento</label>
                                                <input class="form-control datetimepicker" type="text" name="fechaNacimiento" data-input required/>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <label>Profesion</label>
                                                <input class="multisteps-form__input form-control" type="text" name="profesion" required/>
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <label>Cargo</label>
                                                <input class="multisteps-form__input form-control" type="text" name="cargo" required/>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <label>Documento de Identidad</label>
                                                <input class="multisteps-form__input form-control" type="text" name="docIdentidad" required/>
                                            </div>
                                        </div>
                                        <div class="button-row d-flex mt-4">
                                            <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" title="Next">Siguiente</button>
                                        </div>
                                    </div>
                                </div>
                                <!--single form panel-->
                                <div class="card multisteps-form__panel p-3 border-radius-xl bg-white" data-animation="FadeIn">
                                    <h5 class="font-weight-bolder">Usuario</h5>
                                    <p class="mb-0 text-sm">Datos del Usuario</p>
                                    <div class="multisteps-form__content">
                                        <div class="row mt-3">
                                            <div class="col">
                                                <label>Usuario</label>
                                                <input class="multisteps-form__input form-control" type="text" name="usuario" required/>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col">
                                                <label>Clave</label>
                                                <input class="multisteps-form__input form-control" type="password" name="password" required/>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col">
                                                <label>Confirmar Clave</label>
                                                <input class="multisteps-form__input form-control" type="password" name="passwordConfirm" required/>
                                            </div>
                                        </div>
                                        <!--<div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <label>City</label>
                                                <input class="multisteps-form__input form-control" type="text" placeholder="eg. Tokyo" />
                                            </div>
                                            <div class="col-6 col-sm-3 mt-3 mt-sm-0">
                                                <label>State</label>
                                                <select class="multisteps-form__select form-control">
                                                    <option selected="selected">...</option>
                                                    <option value="1">State 1</option>
                                                    <option value="2">State 2</option>
                                                </select>
                                            </div>
                                            <div class="col-6 col-sm-3 mt-3 mt-sm-0">
                                                <label>Zip</label>
                                                <input class="multisteps-form__input form-control" type="text" placeholder="7 letters" />
                                            </div>
                                        </div>-->
                                        <div class="button-row d-flex mt-4">
                                            <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button" title="Prev">Atras</button>
                                            <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" title="Next">Siguiente</button>
                                        </div>
                                    </div>
                                </div>
                                <!--single form panel-->
                                <!--<div class="card multisteps-form__panel p-3 border-radius-xl bg-white" data-animation="FadeIn">
                                    <h5 class="font-weight-bolder">Socials</h5>
                                    <div class="multisteps-form__content">
                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <label>Twitter Handle</label>
                                                <input class="multisteps-form__input form-control" type="text" placeholder="@argon" />
                                            </div>
                                            <div class="col-12 mt-3">
                                                <label>Facebook Account</label>
                                                <input class="multisteps-form__input form-control" type="text" placeholder="https://.../" />
                                            </div>
                                            <div class="col-12 mt-3">
                                                <label>Instagram Account</label>
                                                <input class="multisteps-form__input form-control" type="text" placeholder="https://.../" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="button-row d-flex mt-4 col-12">
                                                <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button" title="Prev">Prev</button>
                                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="button" title="Next">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                                <!--single form panel-->
                                <div class="card multisteps-form__panel p-3 border-radius-xl bg-white h-100" data-animation="FadeIn">
                                    <h5 class="font-weight-bolder">Empresa</h5>
                                    <p class="mb-0 text-sm">Datos del la Empresa</p>
                                    <div class="multisteps-form__content mt-3">
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <label>Empresa</label>
                                                <input class="multisteps-form__input form-control" type="text" name="empresa" required/>
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <label>RUC</label>
                                                <input class="multisteps-form__input form-control" type="text" name="ruc" required/>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-12 col-sm-6">
                                                <label>Codigo</label>
                                                <input class="multisteps-form__input form-control" type="text" name="codigo" required/>
                                            </div>
                                            <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                <label>Lugar</label>
                                                <input class="multisteps-form__input form-control" type="text" name="lugar" required/>
                                            </div>
                                        </div>
                                        <div class="button-row d-flex mt-4">
                                            <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button" title="Prev">Atras</button>
                                            <button class="btn bg-gradient-dark ms-auto mb-0" type="submit" title="Send">Crear</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer pt-3  ">
        
    </footer>
@endsection

@section('script')
<script src="{{ asset('admin/assets/js/plugins/multistep-form.js')}}"></script>
<script src="{{ asset('admin/assets/js/plugins/choices.min.js')}}"></script>
<script src="{{ asset('admin/assets/js/plugins/quill.min.js')}}"></script>
<script src="{{ asset('admin/assets/js/plugins/flatpickr.min.js')}}"></script>
<script>
    if (document.getElementById('editor')) {
        var quill = new Quill('#editor', {
            theme: 'snow' // Specify theme in configuration
        });
    }

    if (document.getElementById('choices-multiple-remove-button')) {
        var element = document.getElementById('choices-multiple-remove-button');
        const example = new Choices(element, {
            removeItemButton: true
        });

        example.setChoices(
            [{
                value: 'One',
                label: 'Label One',
                disabled: true
            },
            {
                value: 'Two',
                label: 'Label Two',
                selected: true
            },
            {
                value: 'Three',
                label: 'Label Three'
            },
            ],
            'value',
            'label',
            false,
        );
    }

    if (document.querySelector('.datetimepicker')) {
        flatpickr('.datetimepicker', {
            allowInput: true
        }); // flatpickr
    }

    Dropzone.autoDiscover = false;
    var drop = document.getElementById('dropzone')
    var myDropzone = new Dropzone(drop, {
        url: "/file/post",
        addRemoveLinks: true

    });
</script>
@endsection