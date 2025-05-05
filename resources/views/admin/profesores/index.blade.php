@extends('adminlte::page')

@section('title', 'Dashboard')
@section('css')
    <!-- DataTables core CSS --> <!-- DataTables Buttons extension CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css"> --}}
    {{-- Add here extra stylesheets --}}
    {{-- NOTA: DESEO TOMAR ESTOS ESTILOS PARA LOS BOTONES DE LA TABLA, MAS NO HE PODIDO --}}
    {{-- <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}"> --}}
@stop
@section('content_header')
    <h1>Listado de profesores</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Profesores registrados</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.profesores.create') }}" class="btn btn-primary">Registrar
                            {{-- <i class="fa-solid fa-plus"></i> --}}
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if ($info = Session::get('info'))
                        <div class="alert alert-success"><strong>{{ $info }}</strong></div>
                    @endif
                    <table id="profesores" class="table table-striped table-bordered table-hover table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th>Nro</th>
                                <th>Nombres y Apellidos</th>
                                <th>Telefono</th>
                                {{-- <th>Especialidad</th> --}}
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach ($profesores as $profesor)
                                <tr>
                                    <td scope="row">{{ $contador++ }}</td>
                                    <td scope="row">{{ $profesor->nombres . ' ' . $profesor->apellidos }}</td>
                                    <td scope="row">{{ $profesor->telefono }}</td>
                                    {{-- <td scope="row">{{ $profesor->especialidad }}</td> --}}
                                    <td scope="row">
                                        <div class="btn-group" role="group" aria-label="basic example">
                                            <a href="{{ route('admin.profesores.show', $profesor->id) }}"
                                                class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('admin.profesores.edit', $profesor->id) }}"
                                                class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                            <form id="delete-form-{{ $profesor->id }}"
                                                action="{{ route('admin.profesores.destroy', $profesor->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger"
                                                    onclick="confirmDelete({{ $profesor->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    
    
    

    <!-- Buttons JS -->
    
    
    
    
    
    
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, se envía el formulario.
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
        new DataTable('#profesores', {
            "language": {
                "decimal": "",
                "emptyTable": "No hay datos disponibles en la tabla",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ profesores",
                "infoEmpty": "Mostrando 0 a 0 de 0 profesores",
                "infoFiltered": "(filtrado de _MAX_ profesores totales)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ profesores",
                "loadingRecords": "Cargando...",
                "processing": "",
                "search": "Buscar:",
                "zeroRecords": "No se encontraron registros coincidentes",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
                "aria": {
                    "orderable": "Ordenar por esta columna",
                    "orderableReverse": "Invertir el orden de esta columna"
                }
            },
            initComplete: function() {
                // Apply custom styles after initialization
                $('.dt-button').css({
                    'background-color': '#4a4a4a',
                    'color': 'white',
                    'border': 'none',
                    'border-radius': '4px',
                    'padding': '8px 12px',
                    'margin': '0 5px',
                    'font-size': '14px'
                });
            },
            responsive: true,
            autoWidth: false, //no le vi la funcionalidad
            dom: 'Bfrtip', // Añade el contenedor de botones
            buttons: [{
                extend: 'collection',
                text: 'Reportes',
                orientation: 'landscape',
                buttons: [{
                        text: 'Copiar',
                        extend: 'copy'
                    },
                    {
                        // text: '<i class="bi bi-file-pdf-fill"></i>',//NO SE ESTA VISUALIZANDO ICONO DE  BOOTSTRAP 4
                        extend: 'pdf'
                    }, {
                        extend: 'csv'
                    }, {
                        extend: 'excel'
                    }, {
                        text: 'Imprimir',
                        extend: 'print'
                    }
                ]
            }, ],

        });
        @if (session('info') && session('icono'))
            Swal.fire({
                title: "{{ session('info') }}",
                text: "{{ session('info') }}",
                icon: "{{ session('icono') }}"
            });
        @endif
    </script>
@stop
