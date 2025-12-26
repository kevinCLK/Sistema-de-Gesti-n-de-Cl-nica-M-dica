@extends('principal')

@section('contenido')
<div class="container">
    <hr>
    <div class="x_title">
        <h2>REGISTRO DE PACIENTES</h2>
        <div class="clearfix"></div>
    </div>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-primary" style="border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="card-header text-center bg-primary text-white"><strong>Formulario de Registro de Usuario</strong></div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form id="NuevoRegistroPaciente" method="POST">
                        @csrf

                        <!-- Fila de Nombre y Apellidos -->
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Nombre</label>
                                <input type="text" name="nombre" class="form-control"  placeholder="Nombre completo">
                                @error('nombre')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Apellidos</label>
                                <input type="text" name="apellidos" class="form-control"  placeholder="Apellidos">
                                @error('apellidos')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 form-group">
                                <label>CI</label>
                                <input type="text" name="ci" class="form-control" placeholder="Solo números" maxlength="10">
                                @error('ci')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Segunda fila -->
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Número de Seguro</label>
                                <input type="text" name="num_seguro" class="form-control" placeholder="Número de seguro">
                                @error('num_seguro')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Fecha de Nacimiento</label>
                                <input type="date" name="fecha_nacimiento" class="form-control" required>
                                @error('fecha_nacimiento')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Género</label>
                                <select name="genero" class="form-control" required>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Otro">Otro</option>
                                </select>
                                @error('genero')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Contacto -->
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Celular</label>
                                <input type="tel" name="celular" class="form-control"  placeholder="10 dígitos">
                                @error('celular')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Correo Electrónico</label>
                                <input type="email" name="correo" class="form-control"  placeholder="correo@ejemplo.com">
                                @error('correo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Dirección y detalles adicionales -->
                        <div class="form-group">
                            <label>Dirección</label>
                            <input type="text" name="direccion" class="form-control"  placeholder="Dirección completa">
                        </div>

                        <!-- Grupo Sanguíneo, Alergias y Contacto de Emergencia -->
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label>Grupo Sanguíneo</label>
                                <select name="grupo_sanguineo" class="form-control" required>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Alergias</label>
                                <input type="text" name="alergias" class="form-control" placeholder="Especifique alergias">
                                @error('alergias')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Contacto de Emergencia</label>
                                <input type="text" name="contacto_emergencia" class="form-control" placeholder="Nombre y teléfono de contacto">
                                @error('contacto_emergencia')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Observaciones -->
                        <div class="form-group">
                            <label>Observaciones</label>
                            <textarea name="observaciones" class="form-control"  placeholder="Observaciones relevantes"></textarea>
                        </div>

                        <!-- Botón de Envío -->
                        <div class="text-left mt-4">
                            <button type="submit" id="boton"class="btn btn-primary">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$("#NuevoRegistroPaciente").submit(function(event) {
  event.preventDefault();
  $.ajax({
    url: '/NuevoRegistroPaciente',
    type: 'POST',
    data: $("form").serialize(),
    success:function(){
      window.location="";
    }
  })
}); 
</script>

@endsection
