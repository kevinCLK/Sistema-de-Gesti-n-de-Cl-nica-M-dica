<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo asset('admin') ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo asset('admin') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo asset('admin') ?>/dist/css/adminlte.min.css?v=3.2.0">
    <style>
        .register-page {
            width: 600px;
            margin: 50px auto;
        }
        .btn-cancel {
            background-color: #6c757d;
            color: white;
        }
    </style>
</head>
<body class="register-page">
<div class="register-box">
    <div class="register-logo">
        <a href="#"><b>Registro</b> de Usuario</a>
    </div>
    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Registrar un nuevo usuario</p>
            <form method="post" id="formRegistroUsuario">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre Completo</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" id="name" class="form-control" name="name" placeholder="Nombre completo" value="{{ old('name') }}" required>
                    </div>
                </div>
                <!-- Email -->
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" id="email" class="form-control" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required>
                    </div>
                </div>
                <!-- Contraseña -->
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" id="password" class="form-control" name="password" placeholder="Contraseña" required>
                    </div>
                </div>
                <!-- Confirmar Contraseña -->
                <div class="form-group">
                    <label for="password_confirmation">Confirmar Contraseña</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="Confirmar contraseña" required>
                    </div>
                </div>
                <!-- Botones -->
                <div class="row">
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                    </div>
                    <div class="col-6">
                        <a href="/login"  class="btn btn-block btn-cancel">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?php echo asset('admin') ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo asset('admin') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo asset('admin') ?>/dist/js/adminlte.min.js?v=3.2.0"></script>


</body>

<script>

    $("#formRegistroUsuario").submit(function(event) {
    event.preventDefault();
    $.ajax({
        url: '/formRegistroUsuario',
        type: 'POST',
        data: $("form").serialize(),
        success:function(){
        window.location="";
        }
    })
    }); 
</script>


</html>
