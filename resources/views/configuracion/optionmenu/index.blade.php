<?php use App\Http\Controllers\MenuController; ?>
@extends('layouts.admin')
@section('contenido')
    <div class="row ">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        <b>Listado | {{ $componentName }}</b>
                    </h4>
                    {{-- @can('crear-categoria') --}}
                    <a class="btn btn-success" href="" data-target="#modal-add" data-toggle="modal">
                        <i class="fas fa-plus-circle" style="color: #cef5e1; margin-right: 10px"></i>Agregar
                    </a>
                    {{-- @endcan --}}
                </div>
                {{-- @include('common.searchbox') --}}
                <div class="card-body">
                    <div class="table-responsive" id="table_refresh">
                        <table id="datatable" class="table table striped mt-1">
                            <thead class="text-white" style="background: #406ccc">
                                <tr>
                                    <th>#N°</th>
                                    <th class="table-th text-white">COD.MENU</th>
                                    <th class="table-th text-white">COD. OPTION</th>
                                    <th class="table-th text-white">DESCRIPCIÓN</th>
                                    <th class="table-th text-white">ESTADO</th>
                                    <th class="table-th text-white" style="text-align: center">ACCIONES</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php ($cont=1)
                                @foreach ($opmenu as $d)
                                    <tr>
                                        <td>
                                            <h6>{{$cont++}}</h6>
                                        </td>
                                        <td>
                                            <h6>{{ $d->codMenu }}</h6>
                                        </td>
                                        <td>
                                            <h6>{{ $d->codOption }}</h6>
                                        </td>
                                        <td>
                                            <h6>{{ $d->description }}</h6>
                                        </td>
                                        <td>
                                            <h6>{{ $d->flag_estatus }}</h6>
                                        </td>

                                        <td align="center">
                                            {{-- @can('editar-categoria') --}}
                                            <a class="btn btn-sm text-white" style="background: #406ccc"
                                                    href="{{ route('optionmenu.edit', $d->idOption) }}">
                                                    <i class="far fa-edit"
                                                        title="EDITAR  {{ $d->codOption }}"></i>
                                                </a>
                                            {{-- @endcan --}}
                                        </td>
                                        <td class="text-center">
                                            {{-- @can('borrar-categoria') --}}
                                            {{-- @if (MenuController::validate_destroy($d->idMenu)) --}}
                                            <form action="{{ route('optionmenu.destroy', $d->idOption) }}"
                                                style="margin-bottom: 0px" method="POST">
                                                {!! csrf_field() !!}
                                                {!! method_field('DELETE') !!}
                                                <button class="btn btn-danger borrar btn-sm"
                                                    title="ELIMINAR OPTION.MENU {{ $d->idOption }}"
                                                    data-nombre="{{ $d->codOption }}"><i class="fas fa-trash"
                                                        aria-hidden="true"></i></button>
                                            </form>
                                            {{-- @endif --}}
                                            {{-- @endcan --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- {{ $category->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
        @include('configuracion.optionmenu.create')

    </div>

    @push('scripts')
        <script>
            var table = $('#datatable').DataTable({
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                // "pageLength": 2  "page": 1,
                "pages": 6,
                "start": 10,
                "end": 20,
                "length": 10,
                "recordsTotal": 57,
                "recordsDisplay": 57,
                "serverSide": false


            });
            // $('#datatable').on('click', '.remove', function() {
            //     var table = $('#datatable').DataTable();
            //     table
            //         .row($(this).parents('tr'))
            //         .remove()
            //         .draw();
            // });
        </script>
        @if (count($errors) > 0)
            <script>
                $(document).ready(function() {
                    Snackbar.show({
                        text: 'Registre de forma correcta los campos.',
                        actionText: 'CERRAR',
                        pos: 'bottom-right',
                        duration: 5000
                    });
                    $('#modal-add').modal('show');
                });
            </script>
        @endif

        @if (Session::has('success'))
            <script type="text/javascript">
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    onOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
                Toast.fire({
                    icon: 'success',
                    html: '<h4>' + 'Operación completada' + '</h4>' + '<span>' + '{{ Session::get('success') }}' +
                        '</span>' + '<br>' +
                        '<span style="color: #49A761;"><b>' + ' correctamente.' + '</b></span>',
                    customClass: 'swal-pop',
                })
            </script>
        @elseif(Session::has('error'))
            <script type="text/javascript">
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    onOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
                Toast.fire({
                    icon: 'error',
                    html: '<h4>Ocurrio un error</h4>' + '<span>' + '{{ Session::get('error') }}' + '</span>',
                    customClass: 'swal-pop',
                })
            </script>
        @endif

        {{-- <script src="{{asset('createView/categoria.js')}}"></script> --}}
        <script>
            document.getElementById("imageCategoria").onchange = function(e) {
                // Creamos el objeto de la clase FileReader
                let reader = new FileReader();

                // Leemos el archivo subido y se lo pasamos a nuestro fileReader
                reader.readAsDataURL(e.target.files[0]);

                // Le decimos que cuando este listo ejecute el código interno
                reader.onload = function() {
                    let preview = document.getElementById('img'),
                        image = document.createElement('img');

                    image.src = reader.result;

                    preview.innerHTML = '';
                    preview.append(image);
                };
            }
        </script>
    @endpush
@endsection
