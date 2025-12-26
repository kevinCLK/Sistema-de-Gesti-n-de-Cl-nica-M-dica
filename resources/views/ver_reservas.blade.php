@extends('principal')
@section('contenido')

<div class="page-title">
    <div class="title_left">
        <h2>LISTA DE RESERVAS</h2>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>RESERVAS REGISTRADAS</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <hr>

                <table class="table" id="example1">
                    <thead>
                        <thead>
                            <tr>
                                <th>Nro</th>
                                <th>Doctor</th>
                                <th> Especialidad</th>
                                <th>Fecha de reserva</th>
                                <th>Hora de reserva</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                    <tbody>
                        <?php $contador = 1; ?>
                        @foreach($eventos as $evento)
                            <tr>
                                <td>{{ $contador++ }}</td>
                                <td>{{ $evento->doctor->nombres . " " . $evento->doctor->apellidos }}</td>
                                <td>{{ $evento->doctor->especialidad }}</td>
                                <td>{{ \Carbon\Carbon::parse($evento->inicio)->format('Y-m-d') }}</td>
                                <td>{{ \Carbon\Carbon::parse($evento->inicio)->format('H:i') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false">
                                            ACCION
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"
                                                    onclick="editarEvento('<?php    echo $evento->id; ?>')">editar</a></li>
                                            <li><a class="dropdown-item" href="#">eliminar</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
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
                },{
                    extend: 'csv'
                },{
                    extend: 'excel'
                },{
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
function editarEvento(id){
  $("#editarModal").modal('show')
  $.post('/editarEvento', {id}, function(data) {
    $("#ver_form").html(data)
  });
}
</script>
@endsection