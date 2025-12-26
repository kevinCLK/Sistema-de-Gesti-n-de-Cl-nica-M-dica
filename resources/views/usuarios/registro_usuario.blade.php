@extends('principal')

@section('contenido')

<div class="container">
    <hr>
    <div class="x_title">
        <h2>REGISTRO DE USUARIOS</h2>
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

                    <form id="registroUsuario" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Nombre</label>
                                <input type="text" name="name" class="form-control" placeholder="Nombre completo" required>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Correo Electrónico</label>
                                <input type="email" name="email" class="form-control" placeholder="correo@ejemplo.com" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Contraseña</label>
                                <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Confirmar Contraseña</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar contraseña" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$("#registroUsuario").submit(function(event) {
  event.preventDefault();
  $.ajax({
    url: '/registroUsuario',
    type: 'POST',
    data: $("form").serialize(),
    success:function(){
      window.location = "";
    }
  });
});
</script>

@endsection
