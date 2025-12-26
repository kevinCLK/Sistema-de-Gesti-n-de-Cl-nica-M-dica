@extends('principal')
  @section('contenido')

  <div class="">

    <div class="page-title">
      <div class="title_left">
      </div>
    </div>
    <div class="clearfix">
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>LISTA DE CONFIGURACIONES</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

          <a href="/regconfig" class="btn btn-primary">NUEVO REGISTRO</a>

              <hr>
            <table class="table" id="example1">
              <thead>
                <tr>
                  <th>#</th>
                  <th>NOMBRE CLINICA</th>
                  <th>DIRECCION</th>
                  <th>TELEFONO</th>
                  <th>CORREO</th>
                  <th>LOGO</th>
                  <th>ACCIONES</th>
                </tr>
              </thead>
              <tbody>
                  <?php $con=1; foreach ($configuraciones as $value) { ?>
                      <tr>
                      <th><?php echo $con++; ?></th>
                      <th><?php echo $value->nombre?></th>
                      <td><?php echo $value->direccion ?></td>

                      <td><?php echo $value->telefono?></td>
                      <td><?php echo $value->correo?></td>
                      <td>
                        @if ($value->logo)
                            <img src="{{ asset('storage/' . $value->logo) }}" alt="Logo" style="width: 100px; height: auto;">
                        @else
                            <span>No disponible</span>
                        @endif
                    </td>
                      <td>
                      <div class="btn-group">
                          <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            ACCION
                          </button>
                          <ul class="dropdown-menu">  
                            <li><a class="dropdown-item" href="#" onclick="editarPaciente('<?php echo $value->id; ?>')">editar</a></li>
                            <li><a class="dropdown-item" href="#">ver</a></li>
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
                  "info": "Mostrando START a END de TOTAL consultorios",
                  "infoEmpty": "Mostrando 0 a 0 de 0 consultorios",
                  "infoFiltered": "(Filtrado de MAX total consultorios)",
                  "infoPostFix": "",
                  "thousands": ",",
                  "lengthMenu": "Mostrar MENU consultorios",
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

  function editarPaciente(id){
    $("#editarModal").modal('show')
    $.post('/editarPaciente', {id}, function(data) {
      $("#ver_form").html(data)
    });
  }


  </script>
  @endsection