    @extends('principal')

    @section('contenido')
    <div class="container">
        
        <div class="x_title">
            
            <h2>Registro De Nuevo Horario</h2>
            <div class="clearfix"></div>
        </div>
        <hr>
        <div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary" >
            <div class="card-header">
                <h3 class="card-title">Registro de horarios</h3>
            </div>
            <div class="card-body row">
                <!-- Formulario -->
                <div class="col-md-3">
                    <form id="RegistroHorario" method="POST">
                        @csrf
                        <!-- Fila de Nombre, Ubicación y Capacidad -->
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Doctor</label>
                                <select name="doctor" class="form-control" required>
                                    <option></option>
                                    <?php foreach ($doctores as $value1) { ?>
                                        <option value="<?php echo $value1->id ?>"><?php echo $value1->nombres . ' ' . $value1->apellidos ?> - <?php echo $value1->especialidad ?></option>
                                    <?php } ?>
                                </select>
                                @error('doctor')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12 form-group">
                                <label>Consultorio</label>
                                <select name="consultorio_id" id="consultorio_select" class="form-control" required>
                                    <option value="">Seleccionar Consultorio</option>
                                    <?php foreach ($consultorios as $value1) { ?>
                                        <option value="<?php echo $value1->id ?>"><?php echo $value1->nombre ?> - <?php echo $value1->ubicacion ?></option>
                                    <?php } ?>
                                </select>
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
                            </div>
                        </div>

                        <!-- Segunda fila -->
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>Dia</label>
                                <select name="dia" id="dia" class="form-control">
                                    <option value="LUNES">LUNES</option>
                                    <option value="MARTES">MARTES</option>
                                    <option value="MIERCOLES">MIERCOLES</option>
                                    <option value="JUEVES">JUEVES</option>
                                    <option value="VIERNES">VIERNES</option>
                                    <option value="SABADO">SABADO</option>
                                    <option value="DOMINGO">DOMINGO</option>
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Hora inicio</label>
                                <input type="time" name="hora_inicio" class="form-control">
                                @error('ubicacion')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12 form-group">
                                <label>Hora Final</label>
                                <input type="time" name="hora_fin" class="form-control">
                                @error('capacidad')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- Botón de Envío -->
                         <div class="row">
                            <div class="col-md-12 form-group">
                                <button type="submit" id="boton" class="btn btn-primary">Registrar</button>
                                <a href="/listaHorarios" class="btn btn-secondary">Cancelar</a>
                            </div>
                         </div>
                    </form>
                </div>

                <!-- Calendario -->
                <div class="col-md-9">
                    <div id="consultorio_info">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>

    <script>
    $("#RegistroHorario").submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: '/RegistroHorarioForm', 
            type: 'POST',
            data: $("form").serialize(),
            success:function(response){
                // Si la respuesta tiene mensaje de éxito, mostramos la alerta
                if(response.success) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Horario registrado correctamente',
                        showConfirmButton: false,
                        timer: 4500
                    }).then(function() {
                        window.location = "/listaHorarios"; // Redirige a la lista de horarios
                    });
                } else {
                    // Si hay un error, mostramos la alerta de error
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 4500
                    });
                }
            }
        });
    });
</script>



    

 @endsection


