@extends('principal')

@section('contenido')
<div class="container">
    <hr>
    <div class="x_title">
        <h2>Registro configuraciones</h2>
        <div class="clearfix"></div>
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-primary" style="border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="card-header text-center bg-primary text-white">
                    <strong>Formulario de Registro</strong>
                </div>
                <div class="card-body">

                    <form id="RegistroConfig" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Fila de Nombre, Ubicación y Capacidad -->
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Nombre de la clinica</label>
                                <input type="text" name="nombre" class="form-control" placeholder="ingrese...">
                                @error('nombre')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Direccion</label>
                                <input type="text" name="direccion" class="form-control" placeholder="ingrese...">
                                @error('Direccion')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 form-group">
                                <label>telefono</label>
                                <input type="text" name="telefono" class="form-control" placeholder="ingrese"
                                    maxlength="10">
                                @error('capacidad')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Segunda fila: Teléfono y Especialidad -->
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Correo</label>
                                <input type="text" name="correo" class="form-control" placeholder="ingrese...">
                                @error('telefono')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Logotipo</label>
                                <input type="file" id="file" name="logo" id="logo" class="form-control">
                                <center><output id="list"></output></center>

                                <script>
                                    function archivo(evt) {
                                        var files = evt.target.files; // FileList object

                                        // Obtenemos la imagen del campo "file".
                                        for (var i = 0, f; f = files[i]; i++) {
                                            // Solo admitimos imágenes.
                                            if (!f.type.match('image.*')) {
                                                continue;
                                            }
                                            var reader = new FileReader();
                                            reader.onload = (function (theFile) {
                                                return function (e) {
                                                    // Insertamos la imagen
                                                    document.getElementById('list').innerHTML = [
                                                        '<img class="thumb thumbnail" src="', e.target.result,
                                                        '" width="100%" title="', escape(theFile.name), '"/>'
                                                    ].join('');
                                                };
                                            })(f);

                                            // Leemos el archivo como una URL
                                            reader.readAsDataURL(f);
                                        }
                                    }

                                    document.getElementById('file').addEventListener('change', archivo, false);
                                </script>

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
    $("#RegistroConfig").submit(function (event) {
        event.preventDefault();

        // Crear un objeto FormData para manejar el envío de archivos
        var formData = new FormData(this);

        $.ajax({
            url: '/RegistroConfig',
            type: 'POST',
            data: formData,
            processData: false, // Necesario para evitar que jQuery procese los datos
            contentType: false, // Necesario para enviar datos como multipart/form-data
            success: function (response) {
                alert('Configuración registrada correctamente.');
                window.location = ""; // Redirigir si es necesario
            },
            error: function (xhr) {
                console.log(xhr.responseJSON); // Para depuración
                alert('Error al registrar la configuración.');
            }
        });
    });

</script>

@endsection