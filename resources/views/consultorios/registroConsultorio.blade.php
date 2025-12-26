@extends('principal')

@section('contenido')
<div class="container">
    <hr>
    <div class="x_title">
        <h2>Registro de Consultorio</h2>
        <div class="clearfix"></div>
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-primary" style="border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="card-header text-center bg-primary text-white">
                    <strong>Formulario de Registro de Consultorio</strong>
                </div>
                <div class="card-body">

                    <form id="RegistroConsultorio" method="POST">
                        @csrf

                        <!-- Fila de Nombre, Ubicación y Capacidad -->
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Nombre del Consultorio</label>
                                <input type="text" name="nombre" class="form-control" placeholder="Nombre completo">
                                @error('nombre')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Ubicación</label>
                                <input type="text" name="ubicacion" class="form-control" placeholder="Ubicación">
                                @error('ubicacion')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Capacidad</label>
                                <input type="text" name="capacidad" class="form-control" placeholder="Capacidad" maxlength="10">
                                @error('capacidad')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Segunda fila: Teléfono y Especialidad -->
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Número de Teléfono</label>
                                <input type="text" name="telefono" class="form-control" placeholder="Número de teléfono">
                                @error('telefono')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Especialidad</label>
                                <input type="text" name="especialidad" class="form-control" placeholder="Especialidad" required>
                                @error('especialidad')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Estado</label>
                                <input type="text" name="estado" class="form-control" placeholder="Estado">
                                @error('estado')
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
$("#RegistroConsultorio").submit(function(event) {
  event.preventDefault();
  $.ajax({
    url: '/RegistroConsultorio',
    type: 'POST',
    data: $("form").serialize(),
    success:function(){
      window.location="";
    }
  })
}); 
</script>

@endsection
