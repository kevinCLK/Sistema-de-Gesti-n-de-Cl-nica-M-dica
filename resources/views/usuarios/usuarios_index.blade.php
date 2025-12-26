@extends('principal')

@section('contenido')

<div class="page-title">
    <div class="title_left">
        <h2>LISTA DE USUARIOS</h2>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Usuarios Registrados</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <a href="/registroUsuario" class="btn btn-primary">Nuevo Registro</a>


                <hr>
                <table class="table" id="example1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Fecha de Registro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $con = 1;
foreach ($usuarios as $usuario) { ?>
                        <tr>
                            <td><?php    echo $con++; ?></td>
                            <td><?php    echo $usuario->name; ?></td>
                            <td><?php    echo $usuario->email; ?></td>
                            <td><?php    echo $usuario->created_at; ?></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false">
                                        Acción
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"
                                                onclick="editaruser('<?php    echo $usuario->id; ?>')">Editar</a>
                                        </li>
                                        <li><a class="dropdown-item" href="#"
                                                onclick="eliminarUser('<?php    echo $usuario->id; ?>')">eliminar</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <script>
                    $(function () {
                        $("#example1").DataTable({
                            "pageLength": 10,
                            "language": {
                                "emptyTable": "No hay información",
                                "info": "Mostrando START a END de TOTAL Usuarios",
                                "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
                                "infoFiltered": "(Filtrado de MAX total Usuarios)",
                                "infoPostFix": "",
                                "thousands": ",",
                                "lengthMenu": "Mostrar MENU Usuarios",
                                "loadingRecords": "Cargando...",
                                "processing": "Procesando...",
                                "search": "Buscador:",
                                "zeroRecords": "Sin resultados encontrados",
                                "paginate": {
                                    "first": "Primero",
                                    "last": "Ultimo",
                                    "next": "Siguiente",
                                    "previous": "Anterior"
                                }
                            },
                            "responsive": true, "lengthChange": true, "autoWidth": false,
                            buttons: [{
                                extend: 'collection',
                                text: 'Reportes',
                                orientation: 'landscape',
                                buttons: [{
                                    text: 'Copiar',
                                    extend: 'copy',
                                }, {
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
                            },
                            {
                                extend: 'colvis',
                                text: 'Visor de columnas',
                                collectionLayout: 'fixed three-column'
                            }
                            ],
                        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                    });
                </script>
            </div>
        </div>
    </div>
</div>
</div>


<div id="editarModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <!-- Modal contenido-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">MODIFICAR REGISTRO</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body " id="ver_form">


            </div>
        </div>
    </div>
</div>

<script>

    function editaruser(id) {
        $("#editarModal").modal('show')
        $.post('/editaruser', { id }, function (data) {
            $("#ver_form").html(data)
        });
    }
    function eliminarUser(id) {
        Swal.fire({
            title: '¿Estás seguro de eliminar este usuario?',
            text: 'Esta acción no se puede deshacer',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('/eliminarUser', { id }, function () {
                    window.location = "";
                });
            }
        });
    }
</script>

@endsection