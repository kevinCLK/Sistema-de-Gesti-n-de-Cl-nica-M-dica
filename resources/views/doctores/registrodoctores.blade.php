@extends('principal')

@section('contenido')
<div class="container">
    <hr>
    <div class="x_title">
        <h2>Registro Doctores</h2>
        <div class="clearfix"></div>
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-primary" style="border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="card-header text-center bg-primary text-white">
                    <strong>Formulario de Registro de Doctores</strong>
                </div>
                <div class="card-body">

                    <form id="RegistroDoctor" method="POST">
                        @csrf

                        <!-- Fila de Nombre, Ubicación y Capacidad -->
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Nombre Doctor</label>
                                <input type="text" name="nombre" class="form-control" placeholder="Nombre completo">
                                @error('nombre')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Apellidos</label>
                                <input type="text" name="Apellidos" class="form-control" placeholder="Apellidos">
                                @error('ubicacion')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 form-group">
                                <label>telefono</label>
                                <input type="text" name="telefono" class="form-control" placeholder="telefono"
                                    maxlength="10">
                                @error('capacidad')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Segunda fila: Teléfono y Especialidad -->
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Licencia medica</label>
                                <input type="text" name="Licencia_medica" class="form-control"
                                    placeholder="Licencia medica">
                                @error('telefono')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Especialidad</label>
                                <input type="text" name="especialidad" class="form-control" placeholder="Especialidad"
                                    required>
                                @error('especialidad')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Email</label>
                                <input type="text" name="Email" class="form-control" placeholder="correo electronico">
                                @error('Email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Contraseña</label>
                                <input type="password" name="Contraseña" class="form-control" placeholder="contraseña"
                                    required>
                                @error('Contraseña')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Botón de Envío -->
                        <div class="text-center mt-4">
                            <button type="submit" id="boton" class="btn btn-primary">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $("#RegistroDoctor").submit(function (event) {
        event.preventDefault();  // Evita que el formulario se envíe de forma convencional
        $.ajax({
            url: '/RegistroDoctorform',  // URL a la que se envía el formulario
            type: 'POST',  // Método HTTP
            data: $(this).serialize(),  // Serializa los datos del formulario
            success: function (response) {
                console.log(response);  // Verifica lo que el servidor responde
                // Alerta de éxito
                swal.fire({
                    title: "Éxito!",
                    text: "El doctor ha sido registrado correctamente.",
                    icon: "success", 
                    confirmButtonText: "Aceptar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = "/listaDoctores";
                    }
                });

            },
            error: function (xhr, status, error) {
                // Mostrar alerta de error
                swal({
                    title: "Error!",
                    text: "Hubo un problema al registrar al doctor. Inténtalo de nuevo.",
                    icon: "error",  // Cambié `type` por `icon`
                    confirmButtonText: "Aceptar"
                });
            }
        });
    });
</script>


@endsection