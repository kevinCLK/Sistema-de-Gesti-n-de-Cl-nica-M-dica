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
            <h2>HORARIOS REGISTRADOS</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

          <a href="/RegistroHorario" class="btn btn-primary">NUEVO REGISTRO</a>
          <a href="{{ route('generarReporteHorarios') }}" class="btn btn-success">Generar Reporte</a> 
              <hr>
            <table class="table" id="example1">
              <thead>
                <tr>
                  <th>#</th>
                  <th>DOCTOR</th>
                  <th>ESPECIALIDAD</th>
                  <th>CONSULTORIO</th>
                  <th>DIA DE ATENCION</th>
                  <th>HORA INICIO</th>
                  <th>HORA FIN</th>
                  <th>ACCIONES</th>
                </tr>
              </thead>
              <tbody>
                  <?php



                    $con=1; foreach ($horario as $value) { ?>
                      <tr>
                      <th><?php echo $con++; ?></th>    
                      <th><?php echo $value->doctor->nombres.' '.$value->doctor->apellidos?></th>
                      <td><?php echo $value->doctor->especialidad?></td>
                      <th><?php echo $value->consultorio->nombre.' Ubicacion '.$value->consultorio->ubicacion?></th>
                       <td><?php echo $value->dia?></td>
                       <td><?php echo $value->hora_inicio?></td>
                      <td><?php echo $value->hora_fin?></td>
                      <td>
                      <div class="btn-group">
                          <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            ACCION
                          </button>
                          <ul class="dropdown-menu">  
                            <li><a class="dropdown-item" href="#" onclick="editarHorario('<?php echo $value->id; ?>')">editar</a></li>
                            <li><a class="dropdown-item" href="#" onclick="eliminarhorario('<?php echo $value->id; ?>')">eliminar</a></li>
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
                  "info": "",
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
    <br>

    <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">CALENDARIO DE DOCTORES</h3>
                    </div>
                    <div class="card-body">
                      <div class="row">
                       <div class=" form-group">
                                <label>Consultorio</label>
                                <select name="consultorio" id="consultorio_select" class="form-control" required>
                                    
                                    <?php foreach ($consultorios as $value1) { ?>
                                        <option value="<?php echo $value1->id ?>"><?php echo $value1->nombre.' '.$value1->ubicacion ?></option>
                                    <?php } ?>
                                </select>
                        </div>
                      </div>
                      <script>
                              $('#consultorio_select').on('change', function (){
                                  var consultorio_id = $('#consultorio_select').val();
                                  var url = "{{route('horarios.cargar_datos_consultorios',':id')}}";
                                  url = url.replace(':id',consultorio_id);

                                  if(consultorio_id){
                                      $.ajax({
                                          url: url,
                                          type: 'GET',
                                          success: function (data) {
                                              $('#consultorio_info').html(data);
                                          },
                                          error: function () {
                                              alert('Error al obtener los datos del consultorio java');
                                          }
                                      });
                                  }else{
                                      $('#consultorio_info').html('');
                                  }
                              });
                          </script>
                          <div id="consultorio_info">
                          </div>
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

  function editarHorario(id){
    $("#editarModal").modal('show')
    $.post('/editarHorario', {id}, function(data) {
      $("#ver_form").html(data)
    });
  }

  function eliminarhorario(id){
  Swal.fire({
    title: '¿Estás seguro de eliminar este horario?',
    text: 'Esta acción no se puede deshacer',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí, eliminar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      $.post('/eliminarhorario', {id}, function() {
        window.location="";
      });
    }
  });
}


  </script>
  @endsection