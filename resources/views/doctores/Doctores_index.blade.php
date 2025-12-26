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
            <h2>LISTA DE DOCTORES</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
          <a href="{{ route('generarReporteDoctores') }}" class="btn btn-success">Generar Reporte</a> 

          <a href="/RegistroDoctor" class="btn btn-primary">NUEVO REGISTRO</a>

              <hr>
            <table class="table" id="example1">
              <thead>
                <tr>
                  <th>#</th>
                  <th>NOMBRES</th>
                  <th>APELLIDOS</th>
                  <th>TELEFONO</th>
                  <th>LICENCIA MEDICA</th>
                  <th>ESPECIALIDAD</th>
                  <th>ACCIONES</th>
                </tr>
              </thead>
              <tbody>
                  <?php $con=1; foreach ($doctores as $value) { ?>
                      <tr>
                      <th><?php echo $con++; ?></th>
                      <th><?php echo $value->nombres?></th>
                      <td><?php echo $value->apellidos ?></td>

                      <td><?php echo $value->telefono?></td>
                      <td><?php echo $value->licencia_medica?></td>
                      <td><?php echo $value->especialidad?></td>
                      <td>
                      <div class="btn-group">
                          <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            ACCION
                          </button>
                          <ul class="dropdown-menu">  
                            <li><a class="dropdown-item" href="#" onclick="editarDoctor('<?php echo $value->id; ?>')">editar</a></li>
                            <li><a class="dropdown-item" href="#" onclick="eliminarDoctor('<?php echo $value->id; ?>')">eliminar</a></li>
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

  function editarDoctor(id){
    $("#editarModal").modal('show')
    $.post('/editarDoctor', {id}, function(data) {
      $("#ver_form").html(data)
    });
  }
  function eliminarDoctor(id){
  Swal.fire({
    title: '¿Estás seguro de eliminar este doctor?',
    text: 'Esta acción no se puede deshacer',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí, eliminar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      $.post('/eliminarDoctor', {id}, function() {
        window.location="";
      });
    }
  });
}

  </script>

  @endsection