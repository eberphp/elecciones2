@extends('intranet.layouts.layout')

@section('content')
    <div class="container-fluid py-4">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="mb-0">GESTIÓN DE EMPRESAS</h5>
                            </div>
                            <div class="col-6" style="text-align: right">
                                <a href="{{ route('empresas.create') }}" class="btn btn-success">Nuevo</a>
                                <a href="javascript:void(0)" class="btn btn-primary actualizar-git">Actualizar proyectos</a>
                                <a href="#" class="btn btn-info">Exportar</a>
                                <!--<button type="button" class="btn btn-success" style="float: right" data-bs-toggle="modal" data-bs-target="#exampleModal">Nuevo</button>-->
                            </div>
                        </div>


                        <p class="text-sm mb-0">

                        </p>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-flush" id="datatable-search">
                            <thead class="thead-light">
                                <tr>
                                    <th>Acciones</th>
                                    <th>Código</th>
                                    <th>Dominio</th>
                                    <th>Proyecto Empresa</th>
                                    <th>Representante Legal</th>
                                    <th>Telefono</th>
                                    <th>Nombre Corto</th>
                                    <th>Usuario</th>
                                    <th>Clave</th>
                                    <th>Doc. Ident.</th>
                                    <th>Edad</th>
                                    <th>F. Nacimiento</th>
                                    <th>Profesion</th>
                                    <th>Cargo</th>
                                    <th>Lugar</th>
                                    <th>Empresa / RUC</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $usuario)
                                    @if ($usuario->perfil->tipo == 'empresa')
                                        <tr>
                                            <td class="text-sm font-weight-normal">
                                                <a href="{{ route('empresas.edit', $usuario->perfil->id)}}" class="btn btn-success"> Editar </a>
                                                <a href="{{ route('empresas.destroy', $usuario->perfil->id)}}" class="btn btn-danger"> Eliminar </a>
                                            </td>
                                            <td class="text-sm font-weight-normal">{{ $usuario->perfil->codigo }}</td>
                                            <td class="text-sm font-weight-normal">
                                                {{ $usuario->perfil->datos_empresa->dominio }}</td>
                                            <td class="text-sm font-weight-normal">
                                                @if ($usuario->proyecto_creado == true)
                                                    <span class="badge badge-success">Proyecto Creado</span>
                                                @elseif ($usuario->proyecto_creado == 'no crear')
                                                    -
                                                @else
                                                    <a href="javascript:void(0)" class="btn btn-sm btn-warning edit"
                                                        data-id="{{ $usuario->perfil->datos_empresa->id }}">Crear
                                                        Proyecto</a>
                                                @endif
                                            </td>
                                            <td class="text-sm font-weight-normal">{{ $usuario->perfil->nombres }}</td>
                                            <td class="text-sm font-weight-normal">{{ $usuario->perfil->telefono }}</td>
                                            <td class="text-sm font-weight-normal">{{ $usuario->perfil->nombreCorto }}</td>
                                            <td class="text-sm font-weight-normal">{{ $usuario->email }}</td>
                                            <td class="text-sm font-weight-normal">{{ $usuario->clave }}</td>
                                            <td class="text-sm font-weight-normal">{{ $usuario->perfil->docIdentidad }}</td>
                                            <td class="text-sm font-weight-normal">{{ $usuario->perfil->edad }}</td>
                                            <td class="text-sm font-weight-normal">{{ $usuario->perfil->fechaNacimiento }}
                                            </td>
                                            <td class="text-sm font-weight-normal">{{ $usuario->perfil->profesion }}</td>
                                            <td class="text-sm font-weight-normal">{{ $usuario->perfil->cargo }}</td>
                                            <td class="text-sm font-weight-normal">{{ $usuario->perfil->lugar }}</td>
                                            <td class="text-sm font-weight-normal">{{ $usuario->perfil->empresa }} /
                                                {{ $usuario->perfil->ruc }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4" style="display: none;">
            <div class="col-12">
                <div class="card">
                    <!-- Card header -->

                    <div class="table-responsive">
                        <table class="table table-flush" id="datatable-basic">

                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="newModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog"
            aria-labelledby="newModalLabel" aria-hidden="true">
            <div class="modal-dialog-full-width modal-dialog momodel modal-fluid" role="document">
                <div class="modal-content-bjar">
                    <div class="modal-body" id="dynamic-content">
                        <img src="https://acegif.com/wp-content/uploads/loading-23.gif" class="img-fluid" alt="" />
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="actualizar-git" tabindex="-1" role="dialog" aria-labelledby="newModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newModalLabel">Lista de Proyectos Actualizados</h5>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group" id="content-text">

                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary cerrar-modal" data-dismiss="modal">Cerrar</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('admin/assets/js/plugins/multistep-form.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/datatables.js') }}"></script>

    <script>
        const dataTableBasic = new simpleDatatables.DataTable("#datatable-basic", {
            searchable: false,
            fixedHeight: true
        });

        const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
            searchable: true,
            fixedHeight: true
        });
    </script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }

        $('body').on('click', '.edit', function() {
            var id = $(this).data('id');
            $('#newModal').modal('show');
            //console.log(id);

            $.ajax({
                method: "GET",
                url: "/nueva/crear-empresa/" + id,
            }).always(function() {
                setTimeout(function() {
                    $('#newModal').modal('hide')
                    location.reload();
                }, 8000);


            });
        });

        $('body').on('click', '.actualizar-git', async function() {
            $('#newModal').modal('show');

            await $.ajax({
                method: "GET",
                url: "/actualizar/git/proyectos-empresas",
            }).done(function(data) {
                document.getElementById('content-text').innerHTML = '';

                $(data).each(function(key, value) {
                    $("#content-text").append('<li class="list-group-item"> <a href="http://' +
                        'www.en.levelte.com' + '" target="_blank" >' + value + '</a></li>');
                });
                $('#newModal').modal('hide')
                $('#actualizar-git').modal('show');
            }).fail(function(e) {
                $('#newModal').modal('hide')
                console.error(e);
                alert("Algo salió mal");
            }).always(function() {
                $('#newModal').modal('hide')
            });
        });

        $('body').on('click', '.cerrar-modal', function() {
            $('#actualizar-git').modal('hide')
        });
    </script>
@endsection
<style>
    .modal-content-bjar {
        position: relative !important;
        display: flex !important;
        flex-direction: column !important;
        width: 100% !important;
        pointer-events: auto !important;
        background-clip: padding-box !important;
        border: none !important !important;
        border-radius: 0.75rem !important;
        background: transparent !important;
        outline: 0;
        background-color: transparent !important;
    }

    .modal-dialog-full-width {
        width: 100% !important;
        height: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        max-width: none !important;

    }

    .modal-content-full-width {
        height: auto !important;
        min-height: 100% !important;
        border-radius: 0 !important;
        background-color: #ececec !important
    }

    .modal-header-full-width {
        border-bottom: 1px solid #9ea2a2 !important;
    }

    .modal-footer-full-width {
        border-top: 1px solid #9ea2a2 !important;
    }
</style>
